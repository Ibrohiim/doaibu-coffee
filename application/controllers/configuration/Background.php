<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Background extends CI_Controller
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
        $title  = 'Background Frontend';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $background = $this->config_m->getBackground();

        $this->form_validation->set_rules('name', 'Background Name', 'required');

        $data = array(
            'title'  => $title,
            'user'   => $user,
            'background' => $background,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'configuration/background/index', $data);
        } else {
            $name = $this->input->post('name');

            $upload_image = $_FILES['image']['name'];

            if ($upload_image = '') {
            } else {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '5048';
                $config['upload_path'] = './assets/img/configuration/background';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('image')) {
                    echo $this->upload->display_errors();
                } else {
                    $img = $this->upload->data();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/img/configuration/background/' . $img['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 1920;
                    $config['height'] = 239;
                    $config['new_image'] = './assets/img/configuration/background/' . $img['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $upload_image = $this->upload->data('file_name');
                }

                $data = array(
                    'name'          => $name,
                    'image'         => $upload_image,
                );
                $this->config_m->insert('background_settings', $data);
                $this->session->set_flashdata('message', 'Background successfully added!');
                redirect('configuration/background');
            }
        }
    }
}
