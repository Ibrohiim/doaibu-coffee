<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Slider extends CI_Controller
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
        $title  = 'Slider Settings';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $slider = $this->config_m->slider();

        $data = array(
            'title'  => $title,
            'user'   => $user,
            'slider' => $slider,
        );

        $this->template->load('templates/admin/templates', 'configuration/slider/index', $data);
    }
    public function addnewslider()
    {
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('caption', 'Caption', 'required');
        $this->form_validation->set_rules('link', 'Link', 'required');
        $this->form_validation->set_rules('text_link', 'Text Link', 'required');

        $data = array(
            'title'     => 'Slider Settings',
            'subtitle'  => 'Add New Slider',
            'user'   => $user,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'configuration/slider/slider-add', $data);
        } else {
            $name      = $this->input->post('name');
            $title     = $this->input->post('title');
            $caption   = $this->input->post('caption');
            $link      = $this->input->post('link');
            $text_link = $this->input->post('text_link');
            $is_active = $this->input->post('is_active');

            $upload_image = $_FILES['image']['name'];

            if ($upload_image = '') {
            } else {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['upload_path'] = './assets/img/configuration/slider';
                $config['max_size']     = '5048';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $upload_image = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }

                $data = [
                    'name'      => $name,
                    'title'     => $title,
                    'caption'   => $caption,
                    'image'     => $upload_image,
                    'link'      => $link,
                    'text_link' => $text_link,
                    'is_active' => $is_active,
                ];
                $this->config_m->insert('slider_settings', $data);
                $this->session->set_flashdata('message', 'Slider successfully added!');
                redirect(base_url('configuration/slider/addnewslider'), 'refresh');
            }
        }
    }
    public function editslider($id)
    {
        $user        = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $editslider = $this->config_m->detailSlider($id);

        $this->form_validation->set_rules('name', 'Slider Name', 'required');
        $this->form_validation->set_rules('title', 'Slider Title', 'required');
        $this->form_validation->set_rules('caption', 'Slider Caption', 'required');
        $this->form_validation->set_rules('link', 'Link', 'required');
        $this->form_validation->set_rules('text_link', 'Text Link', 'required');

        if ($this->form_validation->run()) {
            if (!empty($_FILES['image']['name'])) {

                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '5048';
                $config['upload_path'] = './assets/img/configuration/slider/';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('image')) {
                    echo $this->upload->display_errors();

                    $data = array(
                        'title'     => 'Slider Settings',
                        'subtitle'  => 'Edit Slider',
                        'user'      => $user,
                        'editslider' => $editslider,
                    );
                    $this->template->load('templates/admin/templates', 'configuration/slider/slider-edit', $data);
                } else {
                    $img = $this->upload->data();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/img/configuration/slider/' . $img['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 720;
                    $config['height'] = 720;
                    $config['new_image'] = './assets/img/configuration/slider/' . $img['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $upload_image = $this->upload->data('file_name');

                    if ($editslider->image != null) {
                        $file = './assets/img/configuration/slider/' . $editslider->image;
                        unlink($file);
                    }

                    $data = array(
                        'id_slider'     => $id,
                        'name'          => $this->input->post('name'),
                        'title'         => $this->input->post('title'),
                        'caption'       => $this->input->post('caption'),
                        'link'          => $this->input->post('link'),
                        'text_link'     => $this->input->post('text_link'),
                        'is_active'     => $this->input->post('is_active'),
                        'image'         => $upload_image,
                    );
                    $where = array(
                        'id_slider' => $id
                    );
                    $this->config_m->update($where, $data, 'slider_settings');
                    $this->session->set_flashdata('message', 'Slider successfully update!');
                    redirect('configuration/slider/editslider/' . $id);
                }
            } else {
                $data = array(
                    'id_slider'     => $id,
                    'name'          => $this->input->post('name'),
                    'title'         => $this->input->post('title'),
                    'caption'       => $this->input->post('caption'),
                    'link'          => $this->input->post('link'),
                    'text_link'     => $this->input->post('text_link'),
                    'is_active'     => $this->input->post('is_active'),
                );
                $where = array(
                    'id_slider' => $id
                );
                $this->config_m->update($where, $data, 'slider_settings');
                $this->session->set_flashdata('message', 'Slider successfully update!');
                redirect('configuration/slider/editslider/' . $id);
            }
        }
        $data = array(
            'title'     => 'Slider Settings',
            'subtitle'  => 'Edit Slider',
            'user'      => $user,
            'editslider' => $editslider,
        );
        $this->template->load('templates/admin/templates', 'configuration/slider/slider-edit', $data);
    }
    public function deleteslider($id)
    {
        $where = array('id_slider' => $id);
        $image = $this->db->get_where('slider_settings', array('id_slider' => $id))->row();
        $file = ('./assets/img/configuration/slider/' . $image->image);
        if (is_readable($file) && unlink($file)) {
            $this->config_m->delete($where, 'slider_settings');
            $this->session->set_flashdata('message', 'Slider Successfully Delete!');
        } else {
            $this->session->set_flashdata('message', 'Slider Failed to Delete!');
        }
        redirect(base_url('configuration/slider'), 'refresh');
    }
    public function publish($id)
    {
        $data = array(

            'is_active' => 1,
        );
        $where = array(
            'id_slider' => $id
        );

        $this->config_m->update($where, $data, 'slider_settings');
        $this->session->set_flashdata('changed', 'Your slider has been published!');
        redirect(base_url('configuration/slider'), 'refresh');
    }
    public function draft($id)
    {
        $data = array(

            'is_active' => 0,
        );
        $where = array(
            'id_slider' => $id
        );

        $this->config_m->update($where, $data, 'slider_settings');
        $this->session->set_flashdata('changed', 'Your slider has been drafted!');
        redirect(base_url('configuration/slider'), 'refresh');
    }
}
