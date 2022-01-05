<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Manageuser extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Manageuser_model', 'm_user');
        if ($this->admin->is_role() != 1) {
            redirect('auth/blocked');
        }
    }
    public function index()
    {
        $title  = 'Management Role';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $role   = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');

        $data = array(
            'title' => $title,
            'user'  => $user,
            'role'  => $role,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'admin/manage-user/manage-role', $data);
        } else {
            $data = [
                'role' => $this->input->post('role'),
            ];
            $this->db->insert('user_role', $data);
            $this->session->set_flashdata('message', 'New role added!');
            redirect('admin/manageuser');
        }
    }
    public function roleAccess($role_id)
    {
        $title      = 'Management Role';
        $subtitle   = 'Role Access';
        $user       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $role       = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $menu = $this->db->get('sidebar_menu')->result_array();

        $data = array(
            'title'     => $title,
            'subtitle'  => $subtitle,
            'user'      => $user,
            'role'      => $role,
            'menu'      => $menu,
        );

        $this->template->load('templates/admin/templates', 'admin/manage-user/roleaccess', $data);
    }
    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('changed', 'Access Changed!');
    }
    public function updaterole()
    {
        $id = $this->input->post('id');
        $this->m_user->update_role($id);

        $this->form_validation->set_rules('role', 'Role', 'required');

        $this->session->set_flashdata('message', 'Role successfully Update!');
        redirect('admin/manageuser');
    }
    public function deleterole($id)
    {
        $where = array('id' => $id);
        $this->m_user->delete($where, 'user_role');
        $this->session->set_flashdata('message', 'Role successfully Delete!');
        redirect('admin/manageuser');
    }
    public function manageuser()
    {
        $title  = 'Management User';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $manageuser = $this->m_user->getDatauser();
        $role = $this->db->get('user_role')->result_array();

        $data = array(
            'title'       => $title,
            'user'        => $user,
            'role'        => $role,
            'manageuser'  => $manageuser,
        );

        $this->template->load('templates/admin/templates', 'admin/manage-user/manage-user', $data);
    }
    public function addnewuser()
    {
        $title      = 'Management User';
        $subtitle   = 'Add New User';
        $user       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $role       = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('role_id', 'Role_id', 'required');

        $data = array(
            'title'     => $title,
            'subtitle'  => $subtitle,
            'user'      => $user,
            'role'      => $role,
        );

        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'admin/manage-user/manage-user-add', $data);
        } else {
            $data = array(
                'name'          => escape($this->input->post('name')),
                'email'         => escape($this->input->post('email')),
                'image'         => escape('default.png'),
                'password'      => escape(password_hash($this->input->post('password'), PASSWORD_DEFAULT)),
                'role_id'       => escape($this->input->post('role_id')),
                'created_at'    => escape(date('Y-m-d H:i:s')),
                'is_active'     => escape($this->input->post('is_active'))

            );
            $insert = $this->db->insert('user', $data);
            if ($insert) {
                $this->session->set_flashdata('message', 'New User added!');
                redirect(base_url('admin/manageuser/addnewuser'), 'refresh');
            } else {
                $this->session->set_flashdata('message', 'User failed to add!');
                redirect(base_url('admin/manageuser/addnewuser'), 'refresh');
            }
        }
    }
    public function edituser($id)
    {
        $title      = 'Management User';
        $subtitle   = 'Edit User';
        $user       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $edituser   = $this->m_user->detailUser($id);
        $role       = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('name', 'Username', 'required');
        $this->form_validation->set_rules('email', 'User Email', 'required');

        if ($this->form_validation->run()) {
            if (!empty($_FILES['userimage']['name'])) {

                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '5048';
                $config['upload_path'] = './assets/img/profile/';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('userimage')) {
                    echo $this->upload->display_errors();

                    $data = array(
                        'user'      => $user,
                        'title'     => $title,
                        'subtitle'  => $subtitle,
                        'edituser'  => $edituser,
                        'role'      => $role,
                    );
                    $this->template->load('templates/admin/templates', 'admin/manage-user/manage-user-edit', $data);
                } else {
                    $img = $this->upload->data();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/img/profile/' . $img['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 720;
                    $config['height'] = 720;
                    $config['new_image'] = './assets/img/profile/' . $img['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $upload_image = $this->upload->data('file_name');

                    if ($edituser->image != null) {
                        $file = './assets/img/profile/' . $edituser->image;
                        unlink($file);
                    }

                    $data = array(
                        'id'        => $id,
                        'name'      => escape($this->input->post('name')),
                        'email'     => escape($this->input->post('email')),
                        'role_id'   => escape($this->input->post('role')),
                        'is_active' => escape($this->input->post('status')),
                        'image'     => $upload_image,
                    );
                    $this->m_user->update($id, $data, 'user');
                    $this->session->set_flashdata('message', 'User successfully Update!');
                    redirect(base_url('admin/manageuser/edituser/' . $id), 'refresh');
                }
            } else {
                $data = array(
                    'id'        => $id,
                    'name'      => escape($this->input->post('name')),
                    'email'     => escape($this->input->post('email')),
                    'role_id'   => escape($this->input->post('role')),
                    'is_active' => escape($this->input->post('status')),
                );
                $this->m_user->update($id, $data, 'user');
                $this->session->set_flashdata('message', 'User successfully Update!');
                redirect(base_url('admin/manageuser/edituser/' . $id), 'refresh');
            }
        }

        $data = array(
            'user'      => $user,
            'title'     => $title,
            'subtitle'  => $subtitle,
            'edituser'  => $edituser,
            'role'      => $role,
        );

        $this->template->load('templates/admin/templates', 'admin/manage-user/manage-user-edit', $data);
    }
    public function activeuser($id)
    {
        $data = array(
            'is_active' => 1,
        );

        $this->m_user->update($id, $data, 'user');
        $this->session->set_flashdata('changed', 'User has been actived! ');
        redirect(base_url('admin/manageuser/manageuser'), 'refresh');
    }
    public function notactiveuser($id)
    {
        $data = array(
            'is_active' => 0,
        );

        $this->m_user->update($id, $data, 'user');
        $this->session->set_flashdata('changed', 'User not activated! ');
        redirect(base_url('admin/manageuser/manageuser'), 'refresh');
    }
    public function deleteuser($id)
    {
        $where = array('id' => $id);
        $this->m_user->delete($where, 'user');
        $this->session->set_flashdata('message', 'User successfully Delete!');
        redirect(base_url('admin/manageuser/manageuser'), 'refresh');
    }
}
