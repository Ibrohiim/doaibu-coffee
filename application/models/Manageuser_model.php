<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manageuser_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
    }
    public function edit($where, $table)
    {
        return $this->db->get_where($table, $where);
    }
    public function update($id, $data, $table)
    {
        $this->db->where('id', $id);
        $this->db->update($table, $data);
    }
    public function delete($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table,);
    }

    public function getDatauser()
    {
        $query = "SELECt `user`.*, `user_role`.`role`
                FROM `user` JOIN `user_role`
                ON `user`.`role_id` = `user_role`.`id`";
        return $this->db->query($query)->result_array();
    }
    function is_role()
    {
        return $this->session->userdata('role_id');
    }

    public function update_role($id)
    {
        $data = [
            'role' => $this->input->post('role'),
        ];
        $this->db->where('id', $id);
        $this->db->update('user_role', $data);
    }

    public function managementuser()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('user')->result_array();
    }

    public function getUserAccess()
    {
        return $this->db->get('user_access_menu')->result_array();
    }

    public function getUserRole()
    {
        return $this->db->get('user_role')->result_array();
    }

    public function detailUser($id)
    {
        $this->db->select('user.*, user_role.role')
            ->join('user_role', 'user_role.id=user.role_id', 'left')
            ->where('user.id', $id)
            ->order_by('id', 'desc');
        $query = $this->db->get('user');
        return $query->row();
    }
}
