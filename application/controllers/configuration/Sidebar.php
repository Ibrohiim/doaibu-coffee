<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Sidebar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Configuration_model', 'config_m');
        if ($this->admin->is_role() != 1) {
            redirect('auth/blocked');
        }
    }
    public function index()
    {
        $title = 'Sidebar Menu';
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $menu = $this->db->get('sidebar_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        $this->form_validation->set_rules('sorting', 'Sorting', 'required');

        $data = array(
            'title' => $title,
            'user'  => $user,
            'menu'  => $menu,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'configuration/sidebar/index', $data);
        } else {
            $data = [
                'menu' => escape($this->input->post('menu')),
                'url_menu' => escape($this->input->post('url')),
                'icon' => escape($this->input->post('icon')),
                'sorting' => escape($this->input->post('sorting')),
                'submenu' => escape($this->input->post('submenu')),
            ];
            $this->config_m->insert('sidebar_menu', $data);
            $this->session->set_flashdata('message', 'New menu added!');
            redirect(base_url('configuration/sidebar'), 'refresh');
        }
    }
    public function editmenu($id)
    {
        $title      = 'Sidebar Menu';
        $subtitle   = 'Edit Menu';
        $user       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $editmenu   = $this->config_m->getMenuId($id);
        $menu       = $this->db->get('sidebar_menu')->result_array();

        $data = array(
            'title'    => $title,
            'subtitle' => $subtitle,
            'user'     => $user,
            'editmenu' => $editmenu,
            'menu'     => $menu,
        );

        $this->template->load('templates/admin/templates', 'configuration/sidebar/menu-edit', $data);
    }
    public function updatemenu()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('menu', 'Menu', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        $this->form_validation->set_rules('sorting', 'Sorting', 'required');

        if ($this->form_validation->run() == false) {
            $this->editmenu($id);
        } else {
            $data = [
                'menu'     => escape($this->input->post('menu')),
                'icon'     => escape($this->input->post('icon')),
                'url_menu' => escape($this->input->post('url')),
                'sorting'  => escape($this->input->post('sorting')),
                'submenu'  => escape($this->input->post('submenu')),
            ];
            $where = array(
                'id' => $id
            );
            $this->config_m->update($where, $data, 'sidebar_menu');
            $this->session->set_flashdata('message', 'Menu successfully Update!');
            redirect(base_url('configuration/sidebar/editmenu/') . $id, 'refresh');
        }
    }
    public function deletemenu($id)
    {
        $where = array('id' => $id);
        $this->config_m->delete($where, 'sidebar_menu');
        $this->session->set_flashdata('message', 'Menu successfully Delete!');
        redirect(base_url('configuration/sidebar'), 'refresh');
    }
    public function submenu()
    {
        $title = 'Sidebar SubMenu';
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $submenu = $this->config_m->getSubMenu();
        $menu = $this->db->get('sidebar_menu')->result_array();

        $data = array(
            'title'     => $title,
            'user'      => $user,
            'menu'      => $menu,
            'submenu'   => $submenu,
        );

        $this->template->load('templates/admin/templates', 'configuration/sidebar/submenu', $data);
    }
    public function addsubmenu()
    {
        $title    = 'Sidebar SubMenu';
        $subtitle = 'Add Submenu';
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $menu = $this->db->get('sidebar_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        $data = array(
            'title'     => $title,
            'subtitle'  => $subtitle,
            'user'      => $user,
            'menu'      => $menu,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'configuration/sidebar/submenu-add', $data);
        } else {
            $data = [
                'title'     => escape($this->input->post('title')),
                'menu_id'   => escape($this->input->post('menu_id')),
                'url'       => escape($this->input->post('url')),
                'icon'      => escape($this->input->post('icon')),
                'is_active' => escape($this->input->post('is_active')),
            ];
            $this->config_m->insert('sidebar_submenu', $data);
            $this->session->set_flashdata('message', 'New Sub Menu added!');
            redirect(base_url('configuration/sidebar/addsubmenu'), 'refresh');
        }
    }
    public function editsubmenu($id)
    {
        $title      = 'Sidebar SubMenu';
        $subtitle   = 'Edit Submenu';
        $user       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $editsubmenu = $this->config_m->edit_submenu($id);
        $menu       = $this->db->get('sidebar_menu')->result_array();

        $data = array(
            'title'       => $title,
            'subtitle'    => $subtitle,
            'user'        => $user,
            'menu'        => $menu,
            'editsubmenu' => $editsubmenu,
        );

        $this->template->load('templates/admin/templates', 'configuration/sidebar/submenu-edit', $data);
    }
    public function savesubmenu()
    {
        $id     = $this->input->post('id');
        $data   = [
            'title'     => escape($this->input->post('title')),
            'menu_id'   => escape($this->input->post('menu_id')),
            'url'       => escape($this->input->post('url')),
            'icon'      => escape($this->input->post('icon')),
            'is_active' => escape($this->input->post('is_active')),
        ];
        $where = array(
            'id' => $id
        );
        $this->config_m->update($where, $data, 'sidebar_submenu');
        $this->session->set_flashdata('message', 'Sub Menu successfully Update!');
        redirect(base_url('configuration/sidebar/editsubmenu/') . $id, 'refresh');
    }
    public function deletesubmenu($id)
    {
        $where = array('id' => $id);
        $this->config_m->delete($where, 'sidebar_submenu');
        $this->session->set_flashdata('message', 'Submenu successfully Delete!');
        redirect(base_url('configuration/sidebar/submenu'), 'refresh');
    }
    public function activesubmenu($id)
    {
        $data = array(
            'is_active' => 1,
        );
        $where = array(
            'id' => $id
        );
        $this->config_m->update($where, $data, 'sidebar_submenu');
        $this->session->set_flashdata('changed', 'Your Submenu has been actived!');
        redirect(base_url('configuration/sidebar/submenu'), 'refresh');
    }
    public function notactivesubmenu($id)
    {
        $data = array(
            'is_active' => 0,
        );
        $where = array(
            'id' => $id
        );
        $this->config_m->update($where, $data, 'sidebar_submenu');
        $this->session->set_flashdata('changed', 'Your Submenu not activated!');
        redirect(base_url('configuration/sidebar/submenu'), 'refresh');
    }
}
