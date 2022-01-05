<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Service extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Configuration_model', 'config_m');
        if ($this->admin->is_role() != 1) {
            redirect('auth/blocked');
        }
    }
    public function index()
    {
        $title   = 'Service Settings';
        $user    = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $service = $this->config_m->getService();

        $data = array(
            'title'     => $title,
            'user'      => $user,
            'service'   => $service,
        );

        $this->template->load('templates/admin/templates', 'configuration/service/index', $data);
    }
    public function addnewservice()
    {
        $title      = 'Service Settings';
        $subtitle   = 'Add New Service';
        $user       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        $data = array(
            'title'     => $title,
            'subtitle'  => $subtitle,
            'user'      => $user,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'configuration/service/service-add', $data);
        } else {
            $title          = $this->input->post('title');
            $description    = $this->input->post('description');
            $status         = $this->input->post('status');

            $data = [
                'title'         => $title,
                'description'   => $description,
                'status'        => $status,
            ];
            $this->config_m->insert('service', $data);
            $this->session->set_flashdata('message', ' Service successfully added!');
            redirect(base_url('configuration/service/addnewservice'), 'refresh');
        }
    }
    public function edit($id)
    {
        $user        = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $editservice = $this->config_m->detailService($id);

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        $data = array(
            'title'     => 'Service Settings',
            'subtitle'  => 'Edit Service',
            'user'      => $user,
            'editservice' => $editservice,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'configuration/service/service-edit', $data);
        } else {

            $data = array(
                'id'            => $id,
                'title'         => $this->input->post('title'),
                'description'   => $this->input->post('description'),
                'status'        => $this->input->post('status'),
            );
            $where = array(
                'id' => $id
            );
            $this->config_m->update($where, $data, 'service');
            $this->session->set_flashdata('message', 'Service successfully update!');
            redirect('configuration/service/edit/' . $id);
        }
    }
    public function delete($id)
    {
        $where = array('id' => $id);
        $this->config_m->delete($where, 'service');
        $this->session->set_flashdata('message', 'Service Successfully Delete!');
        redirect(base_url('configuration/service'), 'refresh');
    }
    public function displayed($id)
    {
        $data = array(
            'status' => 'displayed',
        );
        $where = array('id' => $id);

        $this->config_m->update($where, $data, 'service');
        $this->session->set_flashdata('changed', 'Service has been displayed!');
        redirect(base_url('configuration/service'), 'refresh');
    }
    public function notdisplayed($id)
    {
        $data = array(
            'status' => 'not displayed',
        );
        $where = array('id' => $id);

        $this->config_m->update($where, $data, 'service');
        $this->session->set_flashdata('changed', 'Service not displayed!');
        redirect(base_url('configuration/service'), 'refresh');
    }
}
