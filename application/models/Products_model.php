<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products_model extends CI_Model
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
        $this->db->delete($table);
    }

    public function getCategory()
    {
        $this->db->select('*')
            ->from('categories')
            ->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function getCategoryId($id)
    {
        $response = false;
        $query = $this->db->get_where('categories', array('id' => $id));
        if ($query && $query->num_rows()) {
            $response = $query->result();
        }
        return $response;
    }

    public function productCode()
    {
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get("products", 1, 0);
        return $query->result();
    }

    public function getProduct()
    {
        $this->db->select('products.*, categories.category_name, categories.category_slug, COUNT(product_images.id_image) AS total_image');
        $this->db->join('categories', 'categories.id=products.id_category', 'left');
        $this->db->join('product_images', 'product_images.id_product=products.id', 'left');
        $this->db->group_by('products.id');
        $this->db->order_by('id', 'desc');
        return $this->db->get('products')->result_array();
    }

    public function detailProduct($id_product)
    {
        $this->db->select('*')
            ->from('products')
            ->where('id', $id_product)
            ->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    public function imageProduct($id_product)
    {
        $this->db->select('*')
            ->from('product_images')
            ->where('id_product', $id_product)
            ->order_by('id_image', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function detailImage($id_image)
    {
        $this->db->select('*')
            ->from('product_images')
            ->where('id_image', $id_image)
            ->order_by('id_image', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    public function navProduct()
    {
        $this->db->select('products.*, categories.category_name, categories.category_slug');
        $this->db->join('categories', 'categories.id=products.id_category', 'left');
        $this->db->group_by('products.id_category');
        $this->db->order_by('categories.sorting', 'ASC');
        return $this->db->get('products')->result();
    }

    public function productHome()
    {
        $this->db->select('products.*, categories.category_name, COUNT(product_images.id_image) AS total_image');
        $this->db->join('categories', 'categories.id=products.id_category', 'left');
        $this->db->join('product_images', 'product_images.id_product=products.id', 'left');
        $this->db->where('products.status_product', 'displayed');
        $this->db->group_by('products.id');
        $this->db->order_by('id', 'RANDOM');
        $this->db->limit(4);
        return $this->db->get('products')->result_array();
    }

    public function favoriteProduct($monthfavorite, $year)
    {
        $this->db->select('transaction.*, SUM(transaction.quantity) AS total_qty, products.product_name AS name, products.product_image AS image, products.current_discount AS discount, products.stock_product AS stock, products.bursttime')
            ->join('products', 'products.id=transaction.id_product')
            ->where('MONTH(transaction.transaction_date)', $monthfavorite)
            ->where('YEAR(transaction.transaction_date)', $year)
            ->group_by('transaction.id_product')
            ->order_by('total_qty', 'desc')
            ->limit(4);
        return $this->db->get('transaction')->result_array();
    }

    public function newProductHome()
    {
        $this->db->select('products.*, categories.category_name, COUNT(product_images.id_image) AS total_image');
        $this->db->join('categories', 'categories.id=products.id_category', 'left');
        $this->db->join('product_images', 'product_images.id_product=products.id', 'left');
        $this->db->where('products.status_product', 'displayed');
        $this->db->group_by('products.id');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(4);
        return $this->db->get('products')->result_array();
    }

    public function categoryHome()
    {
        $this->db->select('products.*, categories.category_name, categories.category_slug, COUNT(product_images.id_image) AS total_image');
        $this->db->join('categories', 'categories.id=products.id_category', 'left');
        $this->db->join('product_images', 'product_images.id_product=products.id', 'left');
        $this->db->group_by('products.id_category');
        $this->db->order_by('id', 'desc');
        return $this->db->get('products')->result();
    }

    public function productList()
    {
        $this->db->select('products.*, categories.category_name, COUNT(product_images.id_image) AS total_image');
        $this->db->join('categories', 'categories.id=products.id_category', 'left');
        $this->db->join('product_images', 'product_images.id_product=products.id', 'left');
        $this->db->where('products.status_product', 'displayed');
        $this->db->group_by('products.id');
        $this->db->order_by('id', 'desc');
        return $this->db->get('products')->result();
    }

    public function totalproduct()
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->from('products');
        $this->db->where('status_product', 'displayed');
        return $this->db->get()->row();
    }

    public function read($id_product)
    {
        $this->db->select('products.*, categories.category_name, COUNT(product_images.id_image) AS total_image');
        $this->db->join('categories', 'categories.id=products.id_category', 'left');
        $this->db->join('product_images', 'product_images.id_product=products.id', 'left');
        $this->db->where('products.status_product', 'displayed');
        $this->db->where('products.id', $id_product);
        $this->db->group_by('products.id');
        $this->db->order_by('id', 'desc');
        return $this->db->get('products')->row();
    }

    public function categoryList($id_category)
    {
        $this->db->select('products.*, categories.category_name, COUNT(product_images.id_image) AS total_image');
        $this->db->join('categories', 'categories.id=products.id_category', 'left');
        $this->db->join('product_images', 'product_images.id_product=products.id', 'left');
        $this->db->where('products.status_product', 'displayed');
        $this->db->where('products.id_category', $id_category);
        $this->db->group_by('products.id');
        $this->db->order_by('id', 'desc');
        return $this->db->get('products')->result();
    }

    public function productRelated($id_category)
    {
        $this->db->select('products.*, categories.category_name, COUNT(product_images.id_image) AS total_image');
        $this->db->join('categories', 'categories.id=products.id_category', 'left');
        $this->db->join('product_images', 'product_images.id_product=products.id', 'left');
        $this->db->where('products.status_product', 'displayed');
        $this->db->where('products.id_category', $id_category);
        $this->db->group_by('products.id');
        $this->db->order_by('id', 'desc');
        return $this->db->get('products')->result();
    }

    public function totalCategory($id_category)
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->from('products');
        $this->db->where('status_product', 'displayed');
        $this->db->where('id_category', $id_category);
        return $this->db->get()->row();
    }

    public function readCategory($category_slug)
    {
        $this->db->select('*')
            ->from('categories')
            ->where('category_slug', $category_slug)
            ->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    public function get_by_category($category_id)
    {
        $response = false;
        $query = $this->db->order_by('id', 'desc')->get_where('products', array('id_category' => $category_id, 'stock_product' => 'Ready-Stock'));
        if ($query && $query->num_rows()) {
            $response = $query->result_array();
        }
        return $response;
    }

    public function get_by_product($product_id)
    {
        $response = false;
        $query = $this->db->get_where('products', array('id' => $product_id));
        if ($query && $query->num_rows()) {
            $response = $query->result_array();
        }
        return $response;
    }

    public function detail_by_id($id)
    {
        $response = false;
        $this->db->where('products.id', $id);
        $this->db->join('categories', 'categories.id = products.id_category', 'left');
        $query = $this->db->get('products');
        if ($query && $query->num_rows()) {
            $response = $query->result_array();
        }
        return $response;
    }

    public function getOffers()
    {
        $this->db->select('products.*, categories.category_name, COUNT(product_images.id_image) AS total_image');
        $this->db->join('categories', 'categories.id=products.id_category', 'left');
        $this->db->join('product_images', 'product_images.id_product=products.id', 'left');
        $this->db->where('products.status_product', 'displayed');
        $this->db->where('products.current_discount !=0');
        $this->db->group_by('products.id');
        $this->db->order_by('id', 'desc');
        return $this->db->get('products')->result();
    }
}
