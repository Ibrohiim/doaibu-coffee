<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Table extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Table_model', 'table');
        if ($this->admin->is_role() != 1) {
            redirect('auth/blocked');
        }
    }
    public function index()
    {
        $title  = 'Customer Table';
        $user      = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $table  = $this->db->get('customer_table')->result_array();

        $table_code = $this->table->gettable();
        if ($table_code) {
            $code = $table_code[0]->table_code;
            $table_code = generate_code('TAB', $code);
        } else {
            $table_code = 'TAB001';
        }

        $this->form_validation->set_rules('table_code', 'Code', 'required');
        $this->form_validation->set_rules('table_name', 'Table Name', 'required');

        $data = array(
            'title'     => $title,
            'user'      => $user,
            'table'     => $table,
            'table_code' => $table_code,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'admin/customer-table/index', $data);
        } else {
            $data = [
                'table_code'    => escape($this->input->post('table_code')),
                'table_name'    => escape($this->input->post('table_name')),
                'status'        => escape('leave'),
            ];
            $this->table->insert($data);
            $this->session->set_flashdata('message', 'New table added!');
            redirect(base_url('admin/table'), 'refresh');
        }
    }
    public function edittable($id)
    {
        $title  = 'Customer Table';
        $subtitle  = 'Edit Customer Table';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $edittable = $this->table->getTableId($id);
        $table  = $this->db->get('customer_table')->result_array();

        $data = array(
            'title'     => $title,
            'subtitle'  => $subtitle,
            'user'      => $user,
            'edittable' => $edittable,
            'table'     => $table,
        );

        $this->template->load('templates/admin/templates', 'admin/customer-table/table-edit', $data);
    }
    public function savetable()
    {
        $id = $this->input->post('id');
        $data = [
            'table_name'    => escape($this->input->post('table_name')),
        ];
        $this->table->update($id, $data, 'customer_table');
        $this->session->set_flashdata('message', 'Table successfully Update!');
        redirect(base_url('admin/table/edittable/') . $id, 'refresh');
    }
    public function delete($id)
    {
        $where = array('id' => $id);
        $this->table->delete($where, 'customer_table');
        $this->session->set_flashdata('message', 'Table successfully Delete!');
        redirect(base_url('admin/table'), 'refresh');
    }
}
