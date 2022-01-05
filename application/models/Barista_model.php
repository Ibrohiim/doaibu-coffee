<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barista_model extends CI_Model
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
    public function updateQueue($hour, $minute, $wProduct, $data, $table)
    {
        $this->db->where('HOUR(transaction_date)', $hour);
        $this->db->where('MINUTE(transaction_date)', $minute);
        $this->db->where($wProduct);
        $this->db->update($table, $data);
    }
    public function dailyTransaction($day, $month, $year)
    {
        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->join('invoice', 'invoice.transaction_code=transaction.transaction_code', 'left');
        $this->db->join('products', 'products.id=transaction.id_product', 'left');
        $this->db->where('DAY(invoice.transaction_date)', $day);
        $this->db->where('MONTH(invoice.transaction_date)', $month);
        $this->db->where('YEAR(invoice.transaction_date)', $year);
        return $this->db->get()->result();
    }
    public function LatestInvoice()
    {
        $this->db->select('invoice.*, customer_table.table_name');
        $this->db->join('customer_table', 'customer_table.table_code=invoice.table_number', 'left');
        $this->db->order_by('id_invoice', 'desc');
        $this->db->limit(10);
        return $this->db->get('invoice')->result_array();
    }
    public function RecentlyProduct()
    {
        $this->db->select('products.*, categories.category_name, COUNT(product_images.id_image) AS total_image');
        $this->db->join('categories', 'categories.id=products.id_category', 'left');
        $this->db->join('product_images', 'product_images.id_product=products.id', 'left');
        $this->db->where('products.status_product', 'displayed');
        $this->db->group_by('products.id');
        $this->db->order_by('id', 'desc');
        $this->db->limit(5);
        return $this->db->get('products')->result();
    }
    public function getInvoice()
    {
        $this->db->select('invoice.*, customer_table.table_name');
        $this->db->join('customer_table', 'customer_table.table_code=invoice.table_number', 'left');
        $this->db->where('payment_status', 'Complete');
        $this->db->order_by('transaction_date', 'asc');
        return $this->db->get('invoice')->result_array();
    }
    public function InvoiceByMLQ()
    {
        $this->db->select('transaction.*, invoice.order_status, invoice.table_number, products.product_name, products.bursttime, customer_table.table_name');
        $this->db->join('invoice', 'invoice.transaction_code=transaction.transaction_code');
        $this->db->join('customer_table', 'customer_table.table_code=invoice.table_number');
        $this->db->join('products', 'products.id=transaction.id_product');
        $this->db->where('invoice.payment_status', 'Complete');
        $this->db->where('invoice.order_status !=', 'Complete');
        return $this->db->get('transaction')->result_array();
    }
    public function Antrian()
    {
        $this->db->select('*, invoice.order_status, invoice.table_number, products.product_name, products.bursttime, customer_table.table_name, SUM(transaction.quantity) AS qty, GROUP_CONCAT(customer_table.table_name SEPARATOR ", ") AS table_name')
            ->from('transaction')
            ->join('invoice', 'invoice.transaction_code=transaction.transaction_code')
            ->join('customer_table', 'customer_table.table_code=invoice.table_number')
            ->join('products', 'products.id=transaction.id_product')
            ->where('invoice.payment_status', 'Complete')
            ->where('invoice.order_status !=', 'Complete')
            ->where('transaction.status_queue !=', 'Complete')
            ->group_by(array('transaction.id_product, HOUR(transaction.transaction_date), MINUTE(transaction.transaction_date)'))
            ->order_by('HOUR(transaction.transaction_date), MINUTE(transaction.transaction_date)', 'ASC')
            ->order_by('products.bursttime', 'ASC');
        return $this->db->get()->result_array();
    }
}
