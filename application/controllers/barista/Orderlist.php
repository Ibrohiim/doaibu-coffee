<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Orderlist extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Barista_model', 'barista');
        if ($this->admin->is_role() != 3) {
            redirect('auth/blocked');
        }
    }
    public function index()
    {
        $title  = 'Order List';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $invoice    = $this->barista->getInvoice();

        $data = array(
            'title'     => $title,
            'user'      => $user,
            'invoice'   => $invoice,
        );

        $this->template->load('templates/admin/templates', 'barista/order-list', $data);
    }
    public function setcomplete()
    {
        $code = $this->input->post('code');
        $data = array(
            'order_status' => 'Complete',
        );
        $where = array('transaction_code' => $code,);

        $this->barista->update($where, $data, 'invoice');

        echo json_encode($data);
    }
}
