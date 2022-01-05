<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction_model extends CI_Model
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
        $this->db->where($id);
        $this->db->update($table, $data);
    }
    public function delete($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function getShow($code)
    {
        $query = $this->db->where('transaction_code', $code)->get('invoice');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
    public function cek_code($code)
    {
        $query = $this->db->where('transaction_code', $code)->get('invoice');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
    public function getInvoice($code)
    {
        $response = false;
        $this->db->select('invoice.*, SUM(transaction.quantity) AS total_qty, SUM(transaction.total_price) AS amount_paid,SUM(transaction.bursttime_product) AS total_bursttime, customer_table.table_name')
            ->join('transaction', 'transaction.transaction_code=invoice.transaction_code', 'left')
            ->join('customer_table', 'customer_table.table_code=invoice.table_number', 'left')
            ->where('invoice.transaction_code', $code)
            ->order_by('invoice.transaction_code', 'desc');
        $query = $this->db->get('invoice');
        if ($query && $query->num_rows()) {
            $response = $query->result_array();
        }
        return $response;
    }
    public function cek_invoice($code)
    {
        $query = $this->db->where('transaction_code', $code)->get('invoice');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
    public function getCart($code)
    {
        $this->db->select('transaction.*, products.product_code, products.product_name, products.current_discount');
        $this->db->join('products', 'products.id=transaction.id_product', 'left');
        $this->db->where('transaction.transaction_code', $code);
        $this->db->order_by('id_transaction', 'desc');
        return $this->db->get('transaction')->result();
    }
    public function get_categories($limit_offset = array())
    {
        if (!empty($limit_offset)) {
            $query = $this->db->get('categories', $limit_offset['limit'], $limit_offset['offset']);
        } else {
            $query = $this->db->get('categories');
        }
        return $query->result();
    }
    public function cekId($transaction_code, $product_id)
    {
        $this->db->select('transaction.*');
        $this->db->where('transaction_code', $transaction_code);
        $this->db->where('id_product', $product_id);
        return $this->db->get('transaction')->row();
    }
    public function getTransaction($code)
    {
        $response = false;
        $this->db->select('transaction.*, products.product_name, products.bursttime')
            ->join('products', 'products.id=transaction.id_product', 'left')
            ->where('transaction.transaction_code', $code)
            ->order_by('transaction.id_transaction', 'asc');
        $query = $this->db->get('transaction');
        if ($query && $query->num_rows()) {
            $response = $query->result_array();
        }
        return $response;
    }
    public function dataInvoice()
    {
        $this->db->select('invoice.*, customer_table.table_name');
        $this->db->join('customer_table', 'customer_table.table_code=invoice.table_number', 'left');
        $this->db->order_by('id_invoice', 'desc');
        return $this->db->get('invoice')->result_array();
    }
    public function shoppingInvoice($code)
    {
        $query = $this->db->where('transaction_code', $code)->get('invoice');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
    public function shoppingTransaction($code)
    {
        $this->db->select('transaction.*');
        $this->db->where('transaction.transaction_code', $code);
        $this->db->order_by('id_transaction', 'desc');
        return $this->db->get('transaction')->result();
    }
    public function shoppingTable()
    {
        $this->db->select('customer_table.*');
        $this->db->where('customer_table.status', 'leave');
        $this->db->group_by('customer_table.id');
        $this->db->order_by('id', 'asc');
        return $this->db->get('customer_table')->result_array();
    }
}
