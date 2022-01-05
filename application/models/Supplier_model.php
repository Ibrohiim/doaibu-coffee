<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function insert($data)
    {
        $this->db->insert('supplier', $data);
    }
    public function update($id, $data, $table)
    {
        $this->db->where('id_supplier', $id);
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
        $query = $this->db->get("supplier");
        return $query->num_rows();
    }

    public function getsupplier()
    {
        $this->db->order_by('id_supplier', 'DESC');

        $query = $this->db->get("supplier", 1, 0);
        return $query->result();
    }

    public function getDataSupplier()
    {
        $this->db->select('*')
            ->from('supplier')
            ->order_by('id_supplier', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
}
