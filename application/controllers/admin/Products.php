<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Products_model', 'products');
        if ($this->admin->is_role() != 1) {
            redirect('auth/blocked');
        }
    }
    public function index()
    {
        $title    = 'Menu List';
        $user     = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $product  = $this->products->getProduct();
        $category = $this->db->get('categories')->result_array();

        $data = array(
            'title'     => $title,
            'user'      => $user,
            'product'   => $product,
            'category'  => $category,
        );

        $this->template->load('templates/admin/templates', 'admin/manage-products/products', $data);
    }
    public function addnewproduct()
    {
        $title      = 'Menu List';
        $subtitle   = 'Add New Menu';
        $user       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $category   = $this->db->get('categories')->result_array();
        $product_code = $this->products->productCode();
        if ($product_code) {
            $code = $product_code[0]->product_code;
            $product_code = generate_code('DOI', $code);
        } else {
            $product_code = 'DOI001';
        }

        $this->form_validation->set_rules('id_category', 'Category', 'required');
        $this->form_validation->set_rules('product_code', 'Product Code', 'required|is_unique[products.product_code]', array('is_unique' => '%s The product code already exists, Create a new product code!'));
        $this->form_validation->set_rules('product_name', 'Product Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');

        $data = array(
            'title'         => $title,
            'subtitle'      => $subtitle,
            'user'          => $user,
            'category'      => $category,
            'product_code'  => $product_code,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'admin/manage-products/product-add', $data);
        } else {
            $id_category    = $this->input->post('id_category');
            $product_code   = $this->input->post('product_code');
            $product_name   = $this->input->post('product_name');
            $price          = $this->input->post('price');
            $stock_product  = $this->input->post('stock_product');
            $size           = $this->input->post('size');
            $current_discount = $this->input->post('current_discount');
            $bursttime      = $this->input->post('bursttime');
            $description    = $this->input->post('description');
            $status_product = $this->input->post('status_product');
            $created        = date('Y-m-d H:i:s');

            $upload_image = $_FILES['product_image']['name'];

            if ($upload_image = '') {
            } else {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['upload_path'] = './assets/img/product/';
                $config['max_size']     = '5048';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('product_image')) {
                    $img = $this->upload->data();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/img/product/' . $img['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 720;
                    $config['height'] = 720;
                    $config['new_image'] = './assets/img/product/' . $img['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $upload_image = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }

                $data = [
                    'id_category'   => $id_category,
                    'product_code'  => $product_code,
                    'product_name'  => $product_name,
                    'product_image' => $upload_image,
                    'price'         => $price,
                    'stock_product' => $stock_product,
                    'size'          => $size,
                    'current_discount' => $current_discount,
                    'bursttime'     => $bursttime,
                    'description'   => $description,
                    'status_product' => $status_product,
                    'created'       => $created,
                ];
                $this->products->insert('products', $data);
                $this->session->set_flashdata('message', 'Product successfully added!');
                redirect(base_url('admin/products/addnewproduct'), 'refresh');
            }
        }
    }
    public function editproduct($id)
    {
        $user        = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $editproduct = $this->products->detailProduct($id);
        $category    = $this->products->getCategory();

        $this->form_validation->set_rules('id_category', 'Category', 'required');
        $this->form_validation->set_rules('product_code', 'Product Code', 'required');
        $this->form_validation->set_rules('product_name', 'Product Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');

        if ($this->form_validation->run()) {
            if (!empty($_FILES['product_image']['name'])) {

                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '5048';
                $config['upload_path'] = './assets/img/product/';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('product_image')) {
                    echo $this->upload->display_errors();

                    $data = array(
                        'title'     => 'Menu List',
                        'subtitle'  => 'Edit Menu',
                        'user'      => $user,
                        'category'  => $category,
                        'editproduct' => $editproduct,
                    );
                    $this->template->load('templates/admin/templates', 'admin/manage-products/product-edit', $data);
                } else {
                    $img = $this->upload->data();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/img/product/' . $img['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 720;
                    $config['height'] = 720;
                    $config['new_image'] = './assets/img/product/' . $img['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $upload_image = $this->upload->data('file_name');

                    if ($editproduct->product_image != null) {
                        $file = './assets/img/product/' . $editproduct->product_image;
                        unlink($file);
                    }

                    $data = array(
                        'id'            => $id,
                        'id_category'   => $this->input->post('id_category'),
                        'product_code'  => $this->input->post('product_code'),
                        'product_name'  => $this->input->post('product_name'),
                        'product_image' => $upload_image,
                        'price'         => $this->input->post('price'),
                        'stock_product'  => $this->input->post('stock_product'),
                        'size'          => $this->input->post('size'),
                        'current_discount' => $this->input->post('current_discount'),
                        'description'   => $this->input->post('description'),
                        'status_product' => $this->input->post('status_product'),
                    );
                    $this->products->update($id, $data, 'products');
                    $this->session->set_flashdata('message', 'Product successfully update!');
                    redirect('admin/products/editproduct/' . $id);
                }
            } else {
                $data = array(
                    'id'            => $id,
                    'id_category'   => $this->input->post('id_category'),
                    'product_code'  => $this->input->post('product_code'),
                    'product_name'  => $this->input->post('product_name'),
                    'price'         => $this->input->post('price'),
                    'stock_product'  => $this->input->post('stock_product'),
                    'size'          => $this->input->post('size'),
                    'current_discount' => $this->input->post('current_discount'),
                    'description'   => $this->input->post('description'),
                    'status_product' => $this->input->post('status_product'),
                );
                $this->products->update($id, $data, 'products');
                $this->session->set_flashdata('message', 'Product successfully update!');
                redirect('admin/products/editproduct/' . $id);
            }
        }
        $data = array(
            'title'     => 'Menu List',
            'subtitle'  => 'Edit Menu',
            'user'      => $user,
            'category'  => $category,
            'editproduct' => $editproduct,
        );
        $this->template->load('templates/admin/templates', 'admin/manage-products/product-edit', $data);
    }
    public function readystock($id)
    {
        $data = array(
            'stock_product' => 'Ready-Stock',
        );

        $this->products->update($id, $data, 'products');
        $this->session->set_flashdata('changed', 'Product stock changed successfully!');
        redirect(base_url('admin/products'), 'refresh');
    }
    public function soldout($id)
    {
        $data = array(
            'stock_product' => 'Sold-Out',
        );

        $this->products->update($id, $data, 'products');
        $this->session->set_flashdata('changed', 'Product stock changed successfully!');
        redirect(base_url('admin/products'), 'refresh');
    }
    public function displayed($id)
    {
        $data = array(
            'status_product' => 'displayed',
        );

        $this->products->update($id, $data, 'products');
        $this->session->set_flashdata('changed', 'Product has been displayed!');
        redirect(base_url('admin/products'), 'refresh');
    }
    public function notdisplayed($id)
    {
        $data = array(
            'status_product' => 'not displayed',
        );

        $this->products->update($id, $data, 'products');
        $this->session->set_flashdata('changed', 'product not displayed!');
        redirect(base_url('admin/products'), 'refresh');
    }
    public function deleteproduct($id_product)
    {
        $img = $this->products->imageProduct($id_product);
        foreach ($img as $img) {
            unlink('./assets/img/product/thumbs/' . $img->image);
        }
        $where = array('id_product' => $id_product);
        $this->products->delete($where, 'product_images');
        $product = $this->products->detailProduct($id_product);
        unlink('./assets/img/product/' . $product->product_image);
        $data = array('id' => $id_product);
        $this->products->delete($data, 'products');
        $this->session->set_flashdata('message', 'Product Successfully Delete!');
        redirect(base_url('admin/products'), 'refresh');
    }
    public function categories()
    {
        $title = 'Menu Categories';
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $categories = $this->db->get('categories')->result_array();

        $this->form_validation->set_rules('category_name', 'Name Category', 'required|is_unique[categories.category_name]', array('is_unique' => '%s Existing category name, Create a new category!'));
        $this->form_validation->set_rules('sorting', 'Sorting', 'required');

        $data = array(
            'title'     => $title,
            'user'      => $user,
            'categories' => $categories,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'admin/manage-products/categories', $data);
        } else {
            $data = [
                'category_slug' => url_title($this->input->post('category_name'), 'dash', TRUE),
                'category_name' => escape($this->input->post('category_name')),
                'sorting'       => escape($this->input->post('sorting')),
                'created'       => escape(date('Y-m-d H:i:s')),
            ];
            $this->products->insert('categories', $data);
            $this->session->set_flashdata('message', 'New product categories added!');
            redirect(base_url('admin/products/categories'), 'refresh');
        }
    }
    public function editcategory($id)
    {
        $title  = 'Menu Categories';
        $subtitle = 'Edit Category';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $editcategory = $this->products->getCategoryId($id);
        $categories   = $this->db->get('categories')->result_array();

        $data = array(
            'title'     => $title,
            'subtitle'  => $subtitle,
            'user'      => $user,
            'editcategory' => $editcategory,
            'categories'   => $categories,
        );

        $this->template->load('templates/admin/templates', 'admin/manage-products/categories-edit', $data);
    }
    public function savecategory()
    {
        $id = $this->input->post('id');
        $data = [
            'category_slug' => url_title($this->input->post('category_name'), 'dash', TRUE),
            'category_name' => escape($this->input->post('category_name')),
            'sorting'       => escape($this->input->post('sorting')),
        ];
        $this->products->update($id, $data, 'categories');
        $this->session->set_flashdata('message', 'Category successfully Update!');
        redirect(base_url('admin/products/editcategory/') . $id, 'refresh');
    }
    public function deletecategory($id)
    {
        $where = array('id' => $id);
        $this->products->delete($where, 'categories');
        $this->session->set_flashdata('message', 'Category successfully Delete!');
        redirect(base_url('admin/products/categories'), 'refresh');
    }
    public function imageproduct($id_product)
    {
        $title   = 'Menu List';
        $subtitle = 'Menu Image';
        $user    = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $product = $this->products->detailProduct($id_product);
        $image   = $this->products->imageProduct($id_product);

        $this->form_validation->set_rules('image_name', 'Image Name', 'required');

        $data = array(
            'title'     => $title,
            'subtitle'  => $subtitle,
            'user'      => $user,
            'product'   => $product,
            'image'     => $image,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'admin/manage-products/product-image', $data);
        } else {
            $image_name   = $this->input->post('image_name');

            $upload_image = $_FILES['image']['name'];

            if ($upload_image = '') {
            } else {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '5048';
                $config['upload_path'] = './assets/img/product/thumbs';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('image')) {
                    echo $this->upload->display_errors();
                } else {
                    $img = $this->upload->data();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/img/product/thumbs/' . $img['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 720;
                    $config['height'] = 720;
                    $config['new_image'] = './assets/img/product/thumbs/' . $img['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $upload_image = $this->upload->data('file_name');
                }

                $data = array(
                    'id_product'    => $id_product,
                    'image'         => $upload_image,
                    'image_name'    => $image_name,
                );
                $this->products->insert('product_images', $data);
                $this->session->set_flashdata('message', 'Product image successfully added!');
                redirect('admin/products/imageproduct/' . $id_product);
            }
        }
    }
    public function deleteimage($id_product, $id_image)
    {
        $image = $this->products->detailImage($id_image);
        unlink('./assets/img/product/thumbs/' . $image->image);
        $where = array('id_image' => $id_image);
        $this->products->delete($where, 'product_images');
        $this->session->set_flashdata('message', 'Product image successfully deleted!');
        redirect('admin/products/imageproduct/' . $id_product);
    }
}
