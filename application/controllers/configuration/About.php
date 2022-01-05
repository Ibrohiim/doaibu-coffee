<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class About extends CI_Controller
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
        $title  = 'About Settings';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $about = $this->configuration->getAbout();

        $this->form_validation->set_rules('title', 'Title', 'required');

        if ($this->form_validation->run()) {
            if (!empty($_FILES['about_image']['name'])) {

                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '5048';
                $config['upload_path'] = './assets/img/configuration/';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('about_image')) {
                    echo $this->upload->display_errors();

                    $data = array(
                        'title'  => $title,
                        'user'   => $user,
                        'about' => $about,
                    );
                    $this->template->load('templates/admin/templates', 'configuration/about/index', $data);
                } else {
                    $img = $this->upload->data();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/img/configuration/' . $img['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 720;
                    $config['height'] = 866;
                    $config['new_image'] = './assets/img/configuration/' . $img['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $upload_image = $this->upload->data('file_name');

                    if ($about['image'] != null) {
                        $file = './assets/img/configuration/' . $about['image'];
                        unlink($file);
                    }

                    $data = array(
                        'id'            => $about['id'],
                        'title'         => $this->input->post('title'),
                        'image'         => $upload_image,
                        'description'   => $this->input->post('description'),
                        'quotes'        => $this->input->post('quotes'),
                        'author'        => $this->input->post('author'),
                    );
                    $this->db->update('about', $data);
                    $this->session->set_flashdata('message', 'About successfully update!');
                    redirect('configuration/about');
                }
            } else {
                $data = array(
                    'id'            => $about['id'],
                    'title'         => $this->input->post('title'),
                    'description'   => $this->input->post('description'),
                    'quotes'        => $this->input->post('quotes'),
                    'author'        => $this->input->post('author'),
                );
                $this->db->update('about', $data);
                $this->session->set_flashdata('message', 'About successfully update!');
                redirect('configuration/about');
            }
        }
        $data = array(
            'title'     => $title,
            'user'      => $user,
            'about'     => $about,
        );
        $this->template->load('templates/admin/templates', 'configuration/about/index', $data);
    }
}
