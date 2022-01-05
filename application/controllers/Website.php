<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Website extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Configuration_model', 'configuration');
    }
    public function faq()
    {
        $title  = 'FAQ Website';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data = array(
            'title'     => $title,
            'user'      => $user,
        );

        $this->template->load('templates/admin/templates', 'faq-website', $data);
    }
    public function about()
    {
        $title  = 'About Website';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $config = $this->configuration->getConfig();

        $data = array(
            'title'     => $title,
            'user'      => $user,
            'config'    => $config,
        );

        $this->template->load('templates/admin/templates', 'about-website', $data);
    }
}
