<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Orderqueues extends CI_Controller
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
        $title  = 'Order Queues';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $antrian    = $this->barista->Antrian();
        $mlq        = $this->barista->InvoiceByMLQ();

        $data = array(
            'title'     => $title,
            'user'      => $user,
            'antrian'   => $antrian,
            'mlq'       => $mlq,
        );

        $this->template->load('templates/admin/templates', 'barista/daftar-antrian', $data);
    }
    public function setprocess()
    {
        $hour = $this->input->post('hour');
        $minute = $this->input->post('minute');
        $product = $this->input->post('product');
        $data = array(
            'status_queue' => 'Process',
        );
        $wProduct = array('id_product' => $product);

        $this->barista->updateQueue($hour, $minute, $wProduct, $data, 'transaction');

        echo json_encode($data);
    }
    public function setcomplete()
    {
        $hour = $this->input->post('hour');
        $minute = $this->input->post('minute');
        $product = $this->input->post('product');
        $data = array(
            'status_queue' => 'Complete',
        );
        $wProduct = array('id_product' => $product);

        $this->barista->updateQueue($hour, $minute, $wProduct, $data, 'transaction');

        echo json_encode($data);
    }
}
