<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Table_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function insert($data)
    {
        $this->db->insert('customer_table', $data);
    }
    public function update($id, $data, $table)
    {
        $this->db->where('id', $id);
        $this->db->update($table, $data);
    }
    public function edit($where, $table)
    {
        return $this->db->get_where($table, $where);
    }
    public function delete($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table,);
    }

    public function count_total()
    {
        $query = $this->db->get("customer_table");
        return $query->num_rows();
    }

    public function gettable()
    {
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get("customer_table", 1, 0);
        return $query->result();
    }

    public function getDataTable()
    {
        $this->db->select('*')
            ->from('customer_table')
            ->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function getTableId($id)
    {
        $response = false;
        $query = $this->db->get_where('customer_table', array('id' => $id));
        if ($query && $query->num_rows()) {
            $response = $query->result();
        }
        return $response;
    }

    public function getTableCode($tablecode)
    {
        $this->db->select('*')
            ->from('customer_table')
            ->where('table_code', $tablecode)
            ->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
}
