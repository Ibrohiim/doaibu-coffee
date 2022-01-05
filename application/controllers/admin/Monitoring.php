<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Monitoring extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model', 'admin');
        if ($this->admin->is_role() != 1 && $this->admin->is_role() != 3) {
            redirect('auth/blocked');
        }
    }
    public function index()
    {
        $title  = 'Monitoring Cafe';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $custTable   = $this->db->get('customer_table')->result_array();

        $data = array(
            'title'      => $title,
            'user'       => $user,
            'custTable'  => $custTable,
        );

        $this->template->load('templates/admin/templates', 'admin/monitoring-cafe/index', $data);
    }
    public function setleave()
    {
        $id = $this->input->post('id');
        $data = array(
            'status' => 'leave',
        );
        $where = array('id' => $id);

        $this->admin->update($where, $data, 'customer_table');

        echo json_encode($data);
    }
    public function setactive()
    {
        $id = $this->input->post('id');
        $data = array(
            'status' => 'active',
        );
        $where = array('id' => $id);

        $this->admin->update($where, $data, 'customer_table');

        echo json_encode($data);
    }
}
