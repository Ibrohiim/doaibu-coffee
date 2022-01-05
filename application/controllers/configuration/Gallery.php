<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Gallery extends CI_Controller
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
        $title  = 'Gallery Settings';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $gallery = $this->config_m->getGallery();

        $data = array(
            'title'     => $title,
            'user'      => $user,
            'gallery'   => $gallery,
        );

        $this->template->load('templates/admin/templates', 'configuration/gallery/index', $data);
    }
    public function addnewgallery()
    {
        $title      = 'Gallery Settings';
        $subtitle   = 'Add New Gallery';
        $user       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('captions', 'Captions', 'required');

        $data = array(
            'title'     => $title,
            'subtitle'  => $subtitle,
            'user'      => $user,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'configuration/gallery/gallery-add', $data);
        } else {
            $name      = $this->input->post('name');
            $captions  = $this->input->post('captions');
            $like      = $this->input->post('like');
            $status    = $this->input->post('status');

            $upload_image = $_FILES['image']['name'];

            if ($upload_image = '') {
            } else {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['upload_path'] = './assets/img/gallery';
                $config['max_size']     = '5048';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $img = $this->upload->data();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/img/gallery/' . $img['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 720;
                    $config['height'] = 720;
                    $config['new_image'] = './assets/img/gallery/' . $img['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $upload_image = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }

                $data = [
                    'name'      => $name,
                    'captions'  => $captions,
                    'image'     => $upload_image,
                    'likegallery' => $like,
                    'status'    => $status,
                ];
                $this->config_m->insert('gallery', $data);
                $this->session->set_flashdata('message', ' Image successfully added!');
                redirect(base_url('configuration/gallery/addnewgallery'), 'refresh');
            }
        }
    }
    public function edit($id)
    {
        $user        = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $editgallery = $this->config_m->detailGallery($id);

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('captions', 'Captions', 'required');

        if ($this->form_validation->run()) {
            if (!empty($_FILES['image']['name'])) {

                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '5048';
                $config['upload_path'] = './assets/img/gallery/';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('image')) {
                    echo $this->upload->display_errors();

                    $data = array(
                        'title'     => 'Gallery Settings',
                        'subtitle'  => 'Edit Gallery',
                        'user'      => $user,
                        'editgallery' => $editgallery,
                    );
                    $this->template->load('templates/admin/templates', 'configuration/gallery/gallery-edit', $data);
                } else {
                    $img = $this->upload->data();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/img/gallery/' . $img['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 720;
                    $config['height'] = 720;
                    $config['new_image'] = './assets/img/gallery/' . $img['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $upload_image = $this->upload->data('file_name');

                    if ($editgallery->image != null) {
                        $file = './assets/img/gallery/' . $editgallery->image;
                        unlink($file);
                    }

                    $data = array(
                        'id'            => $id,
                        'name'          => $this->input->post('name'),
                        'captions'      => $this->input->post('captions'),
                        'likegallery'   => $this->input->post('like'),
                        'status'        => $this->input->post('status'),
                        'image'         => $upload_image,
                    );
                    $where = array(
                        'id' => $id
                    );
                    $this->config_m->update($where, $data, 'gallery');
                    $this->session->set_flashdata('message', 'Image successfully update!');
                    redirect('configuration/gallery/edit/' . $id);
                }
            } else {
                $data = array(
                    'id'            => $id,
                    'name'          => $this->input->post('name'),
                    'captions'      => $this->input->post('captions'),
                    'likegallery'   => $this->input->post('like'),
                    'status'        => $this->input->post('status'),
                );
                $where = array(
                    'id' => $id
                );
                $this->config_m->update($where, $data, 'gallery');
                $this->session->set_flashdata('message', 'Image successfully update!');
                redirect('configuration/gallery/edit/' . $id);
            }
        }
        $data = array(
            'title'     => 'Gallery Settings',
            'subtitle'  => 'Edit Gallery',
            'user'      => $user,
            'editgallery' => $editgallery,
        );
        $this->template->load('templates/admin/templates', 'configuration/gallery/gallery-edit', $data);
    }
    public function delete($id)
    {
        $where = array('id' => $id);
        $image = $this->db->get_where('gallery', array('id' => $id))->row();
        $file = ('./assets/img/gallery/' . $image->image);
        if (is_readable($file) && unlink($file)) {
            $this->config_m->delete($where, 'gallery');
            $this->session->set_flashdata('message', 'Image Successfully Delete!');
        } else {
            $this->session->set_flashdata('message', 'Image Failed to Delete!');
        }
        redirect(base_url('configuration/gallery'), 'refresh');
    }
    public function displayed($id)
    {
        $data = array(
            'status' => 'displayed',
        );
        $where = array('id' => $id);

        $this->config_m->update($where, $data, 'gallery');
        $this->session->set_flashdata('changed', 'Image has been displayed!');
        redirect(base_url('configuration/gallery'), 'refresh');
    }
    public function notdisplayed($id)
    {
        $data = array(
            'status' => 'not displayed',
        );
        $where = array('id' => $id);

        $this->config_m->update($where, $data, 'gallery');
        $this->session->set_flashdata('changed', 'Image not displayed!');
        redirect(base_url('configuration/gallery'), 'refresh');
    }
}
