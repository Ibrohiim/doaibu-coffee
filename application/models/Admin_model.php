<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function insert($table, $data)
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

    function is_role()
    {
        return $this->session->userdata('role_id');
    }

    public function getConfig()
    {
        return $this->db->get_where('configuration')->row_array();
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

    public function detailProduct()
    {
        $this->db->select('products.*, categories.category_name, COUNT(product_images.id_image) AS total_image');
        $this->db->join('categories', 'categories.id=products.id_category', 'left');
        $this->db->join('product_images', 'product_images.id_product=products.id', 'left');
        $this->db->where('products.status_product', 'displayed');
        $this->db->group_by('products.id');
        $this->db->order_by('id', 'desc');
        return $this->db->get('products')->result();
    }

    public function LatestInvoice()
    {
        $this->db->select('invoice.*, customer_table.table_name');
        $this->db->join('customer_table', 'customer_table.table_code=invoice.table_number', 'left');
        $this->db->order_by('id_invoice', 'desc');
        $this->db->limit(10);
        return $this->db->get('invoice')->result_array();
    }

    public function getTable()
    {
        $this->db->select('customer_table.*');
        $this->db->where('customer_table.status', 'leave');
        $this->db->group_by('customer_table.id');
        $this->db->order_by('id', 'asc');
        return $this->db->get('customer_table')->result_array();
    }

    public function getOffers()
    {
        return $this->db->get('offers')->result_array();
    }

    public function offersCode()
    {
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get("offers", 1, 0);
        return $query->result();
    }

    public function detailOffers($id)
    {
        $this->db->select('*')
            ->from('offers')
            ->where('id', $id)
            ->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    public function homepage_Offers($date)
    {
        $this->db->select('offers.*');
        $this->db->where('offers.status', 'activated');
        $this->db->where('offers.expired > ', $date);
        $this->db->group_by('offers.id');
        $this->db->order_by('id', 'asc');
        return $this->db->get('offers')->result_array();
    }

    public function getingredients()
    {
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get("ingredients", 1, 0);
        return $query->result();
    }

    public function detailIngredient($id)
    {
        $this->db->select('*')
            ->from('ingredients')
            ->where('id', $id)
            ->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    public function getDataIngredients()
    {
        $this->db->select('*')
            ->from('ingredients')
            ->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result();
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

    public function favoriteProduct($monthfavorite, $year)
    {
        $this->db->select('transaction.*, SUM(transaction.quantity) AS total_qty, products.product_name AS name, products.product_image AS image')
            ->join('products', 'products.id=transaction.id_product')
            ->where('MONTH(transaction.transaction_date)', $monthfavorite)
            ->where('YEAR(transaction.transaction_date)', $year)
            ->group_by('transaction.id_product')
            ->order_by('total_qty', 'desc')
            ->limit(4);
        return $this->db->get('transaction')->result_array();
    }
}
