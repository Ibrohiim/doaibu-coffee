<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Ingredients extends CI_Controller
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
        $title      = 'Ingredients';
        $user       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $ingredients = $this->db->get('ingredients')->result_array();

        $data = array(
            'title' => $title,
            'user'  => $user,
            'ingredients' => $ingredients,
        );

        $this->template->load('templates/admin/templates', 'admin/ingredients/index', $data);
    }
    public function addnew()
    {
        $title      = 'Ingredients';
        $subtitle   = 'Add New Ingredients';
        $user       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $ingredients_code = $this->admin->getingredients();
        if ($ingredients_code) {
            $code = $ingredients_code[0]->code;
            $ingredients_code = generate_code('ING', $code);
        } else {
            $ingredients_code = 'ING001';
        }

        $this->form_validation->set_rules('code', 'Ingredient Code', 'required');
        $this->form_validation->set_rules('name', 'Ingredient Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('unit', 'Ingredient Unit', 'required');
        $this->form_validation->set_rules('stock', 'Ingredient Stock', 'required');

        $data = array(
            'title'     => $title,
            'subtitle'  => $subtitle,
            'user'      => $user,
            'code'      => $ingredients_code,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'admin/ingredients/ingredients-add', $data);
        } else {
            $data = [
                'code'          => escape($this->input->post('code')),
                'name'          => escape($this->input->post('name')),
                'description'   => escape($this->input->post('description')),
                'unit'          => escape($this->input->post('unit')),
                'stock'         => escape($this->input->post('stock')),
                'created'       => escape($this->input->post('created')),
            ];
            $this->admin->insert('ingredients', $data);
            $this->session->set_flashdata('message', 'New ingredient added!');
            redirect(base_url('admin/ingredients/addnew'), 'refresh');
        }
    }

    public function edit($id)
    {
        $title      = 'Ingredients';
        $subtitle   = 'Edit Ingredient';
        $user       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $where      = array('id' => $id);
        $edit       = $this->admin->detailIngredient($id);

        $this->form_validation->set_rules('code', 'Ingredient Code', 'required');
        $this->form_validation->set_rules('name', 'Ingredient Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('unit', 'Ingredient Unit', 'required');
        $this->form_validation->set_rules('stock', 'Ingredient Stock', 'required');

        $data = array(
            'title'     => $title,
            'subtitle'  => $subtitle,
            'user'      => $user,
            'edit'      => $edit,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'admin/ingredients/ingredients-edit', $data);
        } else {
            $data = [
                'code'          => escape($this->input->post('code')),
                'name'          => escape($this->input->post('name')),
                'description'   => escape($this->input->post('description')),
                'unit'          => escape($this->input->post('unit')),
                'stock'         => escape($this->input->post('stock')),
            ];
            $this->admin->update($where, $data, 'ingredients');
            $this->session->set_flashdata('message', 'Ingredient successfully update!');
            redirect(base_url('admin/ingredients/edit/' . $id), 'refresh');
        }
    }
    public function delete($id)
    {
        $where = array('id' => $id);
        $this->admin->delete($where, 'ingredients');
        $this->session->set_flashdata('message', 'Ingredient successfully Delete!');
        redirect(base_url('admin/ingredients'), 'refresh');
    }
}
