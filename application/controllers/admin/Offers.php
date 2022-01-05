<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Offers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Admin_model', 'admin');
        if ($this->admin->is_role() != 1) {
            redirect('auth/blocked');
        }
    }
    public function index()
    {
        $title  = 'Special Offers';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data = array(
            'title'     => $title,
            'user'      => $user,
            'offers'    => $this->admin->getOffers(),
        );

        $this->template->load('templates/admin/templates', 'admin/special-offers/index', $data);
    }
    public function addnewoffers()
    {
        $title      = 'Special Offers';
        $subtitle   = 'Add New Offers';
        $user       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $offers_code = $this->admin->offersCode();
        if ($offers_code) {
            $code = $offers_code[0]->offers_code;
            $offers_code = generate_code('OFF', $code);
        } else {
            $offers_code = 'OFF001';
        }

        $this->form_validation->set_rules('name', 'Offers Name', 'required');
        $this->form_validation->set_rules('offers_code', 'Offers Code', 'required|is_unique[offers.offers_code]', array('is_unique' => '%s The offers code already exists, Create a new offers code!'));
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('information', 'Information', 'required');
        $this->form_validation->set_rules('expired', 'Expired', 'required');

        $data = array(
            'title'         => $title,
            'subtitle'      => $subtitle,
            'user'          => $user,
            'offers_code'   => $offers_code,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'admin/special-offers/offers-add', $data);
        } else {
            $offers_code    = $this->input->post('offers_code');
            $name           = $this->input->post('name');
            $description    = $this->input->post('description');
            $information    = $this->input->post('information');
            $expired        = $this->input->post('expired');
            $status         = $this->input->post('status');
            $created        = date('Y-m-d');

            $upload_image = $_FILES['image']['name'];

            if ($upload_image = '') {
            } else {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['upload_path'] = './assets/img/offers/';
                $config['max_size']     = '5048';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $img = $this->upload->data();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/img/offers/' . $img['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 720;
                    $config['height'] = 539;
                    $config['new_image'] = './assets/img/offers/' . $img['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $upload_image = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }

                $data = [
                    'offers_code'   => $offers_code,
                    'name'          => $name,
                    'image'         => $upload_image,
                    'information'   => $information,
                    'description'   => $description,
                    'expired'       => $expired,
                    'status'        => $status,
                    'created'       => $created,
                ];
                $this->admin->insert('offers', $data);
                $this->session->set_flashdata('message', 'Offers successfully added!');
                redirect(base_url('admin/offers/addnewoffers'), 'refresh');
            }
        }
    }
    public function edit($id)
    {
        $user       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $editoffers = $this->admin->detailOffers($id);

        $this->form_validation->set_rules('name', 'Offers Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('information', 'Information', 'required');
        $this->form_validation->set_rules('expired', 'Expired', 'required');

        if ($this->form_validation->run()) {
            if (!empty($_FILES['image']['name'])) {

                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '5048';
                $config['upload_path'] = './assets/img/offers/';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('image')) {
                    echo $this->upload->display_errors();

                    $data = array(
                        'title'     => 'Special Offers',
                        'subtitle'  => 'Edit Offers',
                        'user'      => $user,
                        'editoffers' => $editoffers,
                    );
                    $this->template->load('templates/admin/templates', 'admin/special-offers/offers-edit', $data);
                } else {
                    $img = $this->upload->data();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/img/offers/' . $img['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 720;
                    $config['height'] = 539;
                    $config['new_image'] = './assets/img/offers/' . $img['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $upload_image = $this->upload->data('file_name');

                    if ($editoffers->image != null) {
                        $file = './assets/img/offers/' . $editoffers->image;
                        unlink($file);
                    }

                    $data = array(
                        'id'            => $id,
                        'offers_code'   => $this->input->post('offers_code'),
                        'name'          => $this->input->post('name'),
                        'image'         => $upload_image,
                        'information'   => $this->input->post('information'),
                        'description'   => $this->input->post('description'),
                        'expired'       => $this->input->post('expired'),
                        'status'        => $this->input->post('status'),
                        'created'       => $this->input->post('created'),
                    );
                    $where = array(
                        'id' => $id,
                    );
                    $this->admin->update($where, $data, 'offers');
                    $this->session->set_flashdata('message', 'Offers successfully update!');
                    redirect('admin/offers/edit/' . $id);
                }
            } else {
                $data = array(
                    'id'            => $id,
                    'offers_code'   => $this->input->post('offers_code'),
                    'name'          => $this->input->post('name'),
                    'information'   => $this->input->post('information'),
                    'description'   => $this->input->post('description'),
                    'expired'       => $this->input->post('expired'),
                    'status'        => $this->input->post('status'),
                    'created'       => $this->input->post('created'),
                );
                $where = array(
                    'id' => $id,
                );
                $this->admin->update($where, $data, 'offers');
                $this->session->set_flashdata('message', 'Offers successfully update!');
                redirect('admin/offers/edit/' . $id);
            }
        }
        $data = array(
            'title'     => 'Special Offers',
            'subtitle'  => 'Edit Offers',
            'user'      => $user,
            'editoffers' => $editoffers,
        );
        $this->template->load('templates/admin/templates', 'admin/special-offers/offers-edit', $data);
    }
    public function activated($id)
    {
        $data = array(
            'status' => 'activated',
        );
        $where = array(
            'id' => $id,
        );

        $this->admin->update($where, $data, 'offers');
        $this->session->set_flashdata('changed', 'Offers has been activated!');
        redirect(base_url('admin/offers'), 'refresh');
    }
    public function deactivated($id)
    {
        $data = array(
            'status' => 'deactivated',
        );
        $where = array(
            'id' => $id,
        );

        $this->admin->update($where, $data, 'offers');
        $this->session->set_flashdata('changed', 'Offers has been deactivated!');
        redirect(base_url('admin/offers'), 'refresh');
    }
    public function delete($id)
    {
        $where = array('id' => $id);
        $image = $this->db->get_where('offers', array('id' => $id))->row();
        $file = ('./assets/img/offers/' . $image->image);
        if (is_readable($file) && unlink($file)) {
            $this->admin->delete($where, 'offers');
            $this->session->set_flashdata('message', 'Offers Successfully Delete!');
        } else {
            $this->session->set_flashdata('message', 'Offers Failed to Delete!');
        }
        redirect(base_url('admin/offers'), 'refresh');
    }
}
