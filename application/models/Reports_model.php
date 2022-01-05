<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reports_model extends CI_Model
{
    public function insert($data, $table)
    {
        $this->db->insert($table, $data);
    }
    public function update($where, $data, $table)
    {
        $this->db->where($where);
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

    public function dailyReports($date, $month, $year)
    {
        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->join('invoice', 'invoice.transaction_code=transaction.transaction_code', 'left');
        $this->db->join('products', 'products.id=transaction.id_product', 'left');
        $this->db->where('DAY(invoice.transaction_date)', $date);
        $this->db->where('MONTH(invoice.transaction_date)', $month);
        $this->db->where('YEAR(invoice.transaction_date)', $year);
        return $this->db->get()->result();
    }

    public function monthReports($month, $year)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('MONTH(transaction_date)', $month);
        $this->db->where('YEAR(transaction_date)', $year);
        $this->db->where('payment_status', 'Complete');
        return $this->db->get()->result();
    }

    public function yearReports($year)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('YEAR(transaction_date)', $year);
        $this->db->where('payment_status', 'Complete');
        return $this->db->get()->result();
    }
}
