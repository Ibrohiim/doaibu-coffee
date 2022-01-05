<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Config extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Configuration_model', 'configuration');
        if ($this->admin->is_role() != 1) {
            redirect('auth/blocked');
        }
    }
    public function index()
    {
        $title  = 'Configuration';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $config = $this->configuration->getConfig();

        $this->form_validation->set_rules('website_name', 'Website Name', 'required');

        $data = array(
            'title'  => $title,
            'user'   => $user,
            'config' => $config,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'configuration/config/config-web', $data);
        } else {
            $data = [
                'id_config'     => $data['configuration']->id_config,
                'website_name'  => $this->input->post('website_name'),
                'tagline'       => $this->input->post('tagline'),
                'website'       => $this->input->post('website'),
                'keywords'      => $this->input->post('keywords'),
                'metatext'      => $this->input->post('metatext'),
                'email'         => $this->input->post('email'),
                'telephone'     => $this->input->post('telephone'),
                'address'       => $this->input->post('address'),
                'facebook'      => $this->input->post('facebook'),
                'instagram'     => $this->input->post('instagram'),
                'description'   => $this->input->post('description'),
                'payment_account' => $this->input->post('payment_account'),
            ];
            $this->db->update('configuration', $data);
            $this->session->set_flashdata('message', 'The data has been updated!');
            redirect('configuration/config');
        }
    }
    public function configlogo()
    {
        $title  = 'Config Logo';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $config = $this->configuration->getConfig();

        $this->form_validation->set_rules('website_name', 'Website Name', 'required');

        $data = array(
            'title'  => $title,
            'user'   => $user,
            'config' => $config,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'configuration/config/config-logo', $data);
        } else {
            $website_name = $this->input->post('website_name');

            $icon = $_FILES['icon']['name'];
            if ($icon) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '5048';
                $config['upload_path'] = './assets/img/configuration/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('icon')) {
                    $old_image = $data['config']['icon'];
                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/img/configuration/' . $old_image);
                    }
                    $icon = $this->upload->data('file_name');
                    $this->db->set('icon', $icon);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $logo = $_FILES['logo']['name'];
            if ($logo) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '5048';
                $config['upload_path'] = './assets/img/configuration/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('logo')) {
                    $old_image = $data['config']['logo'];
                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/img/configuration/' . $old_image);
                    }
                    $logo = $this->upload->data('file_name');
                    $this->db->set('logo', $logo);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $data = array(
                'website_name' => $website_name,
            );
            $this->db->update('configuration', $data);
            $this->session->set_flashdata('message', 'The data has been updated!');
            redirect('configuration/config/configlogo');
        }
    }
}
