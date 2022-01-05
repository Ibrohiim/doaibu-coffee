<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Supplier extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Supplier_model', 'supplier');
        if ($this->admin->is_role() != 1) {
            redirect('auth/blocked');
        }
    }
    public function index()
    {
        $title      = 'Suppliers';
        $user       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $supplier   = $this->db->get('supplier')->result_array();

        $data = array(
            'title' => $title,
            'user'  => $user,
            'supplier' => $supplier,
        );

        $this->template->load('templates/admin/templates', 'admin/supplier/index', $data);
    }
    public function addnewsupplier()
    {
        $title      = 'Suppliers';
        $subtitle   = 'Add New Supplier';
        $user       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $supplier_code = $this->supplier->getsupplier();
        if ($supplier_code) {
            $code = $supplier_code[0]->supplier_code;
            $supplier_code = generate_code('SUP', $code);
        } else {
            $supplier_code = 'SUP001';
        }

        $this->form_validation->set_rules('supplier_code', 'Code', 'required');
        $this->form_validation->set_rules('supplier_name', 'Supplier Name', 'required');
        $this->form_validation->set_rules('supplier_phone', 'Supplier Phone', 'required');
        $this->form_validation->set_rules('supplier_address', 'Supplier Address', 'required');

        $data = array(
            'title'     => $title,
            'subtitle'  => $subtitle,
            'user'      => $user,
            'supplier_code' => $supplier_code,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'admin/supplier/supplier-add', $data);
        } else {
            $data = [
                'supplier_code'     => escape($this->input->post('supplier_code')),
                'supplier_name'     => escape($this->input->post('supplier_name')),
                'supplier_phone'    => escape($this->input->post('supplier_phone')),
                'supplier_address'  => escape($this->input->post('supplier_address')),
                'description'       => escape($this->input->post('description')),
            ];
            $this->supplier->insert($data);
            $this->session->set_flashdata('message', 'New supplier added!');
            redirect(base_url('admin/supplier/addnewsupplier'), 'refresh');
        }
    }

    public function editsupplier($id)
    {
        $title      = 'Suppliers';
        $subtitle   = 'Edit Supplier';
        $user       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $where      = array('id_supplier' => $id);
        $editsupplier = $this->supplier->edit($where, 'supplier')->result();

        $this->form_validation->set_rules('supplier_code', 'Supplier Code', 'required');
        $this->form_validation->set_rules('supplier_name', 'Supplier Name', 'required');
        $this->form_validation->set_rules('supplier_phone', 'Supplier Phone', 'required');
        $this->form_validation->set_rules('supplier_address', 'Supplier Address', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        $data = array(
            'title'     => $title,
            'subtitle'  => $subtitle,
            'user'      => $user,
            'editsupplier' => $editsupplier,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'admin/supplier/supplier-edit', $data);
        } else {
            $data = [
                'supplier_code'     => escape($this->input->post('supplier_code')),
                'supplier_name'     => escape($this->input->post('supplier_name')),
                'supplier_phone'    => escape($this->input->post('supplier_phone')),
                'supplier_address'  => escape($this->input->post('supplier_address')),
                'description'       => escape($this->input->post('description')),
            ];
            $this->supplier->update($id, $data, 'supplier');
            $this->session->set_flashdata('message', 'Supplier successfully update!');
            redirect(base_url('admin/supplier/editsupplier/' . $id), 'refresh');
        }
    }
    public function delete($id)
    {
        $where = array('id_supplier' => $id);
        $this->supplier->delete($where, 'supplier');
        $this->session->set_flashdata('message', 'Supplier successfully Delete!');
        redirect(base_url('admin/supplier'), 'refresh');
    }
}
