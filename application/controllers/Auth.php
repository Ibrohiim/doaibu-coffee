<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        if ($this->session->userdata('email')) {
            $user  = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            if ($user['role_id'] == 1) {
                $this->session->set_flashdata('flashLogin', 'Welcome ' . $user['name']);
                redirect('user/admin');
            } elseif ($user['role_id'] == 2) {
                $this->session->set_flashdata('flashLogin', 'Welcome ' . $user['name']);
                redirect('user');
            } elseif ($user['role_id'] == 3) {
                $this->session->set_flashdata('flashLogin', 'Welcome ' . $user['name']);
                redirect('user/barista');
            } else {
                $this->session->set_flashdata('flashLogin', 'Welcome ' . $user['name']);
                redirect('user/owner');
            }
        }

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Doaibu | Log in';
            $this->load->view('templates/auth/header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth/footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        $this->session->set_flashdata('flashLogin', 'Welcome ' . $user['name']);
                        redirect('user/admin');
                    } elseif ($user['role_id'] == 2) {
                        $this->session->set_flashdata('flashLogin', 'Welcome ' . $user['name']);
                        redirect('user');
                    } elseif ($user['role_id'] == 3) {
                        $this->session->set_flashdata('flashLogin', 'Welcome ' . $user['name']);
                        redirect('user/barista');
                    } else {
                        $this->session->set_flashdata('flashLogin', 'Welcome ' . $user['name']);
                        redirect('user/owner');
                    }
                } else {
                    $this->session->set_flashdata('flashLogin', 'Wrong password!');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('flashLogin', ' This email has not been activated!');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('flashLogin', ' Email is not registered!');
            redirect('auth');
        }
    }

    public function register()
    {
        if ($this->session->userdata('email')) {
            $user  = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            if ($user['role_id'] == 1) {
                $this->session->set_flashdata('flashLogin', 'Welcome ' . $user['name']);
                redirect('user/admin');
            } elseif ($user['role_id'] == 2) {
                $this->session->set_flashdata('flashLogin', 'Welcome ' . $user['name']);
                redirect('user');
            } elseif ($user['role_id'] == 3) {
                $this->session->set_flashdata('flashLogin', 'Welcome ' . $user['name']);
                redirect('user/barista');
            } else {
                $this->session->set_flashdata('flashLogin', 'Welcome ' . $user['name']);
                redirect('user/owner');
            }
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Doaibu | Registration';
            $this->load->view('templates/auth/header', $data);
            $this->load->view('auth/register');
            $this->load->view('templates/auth/footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', 'true')),
                'email' => htmlspecialchars($this->input->post('email', 'true')),
                'image' => 'default.png',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('flashLogin', ' Congratulation! your account has been created. Please Login! </div>');
            redirect('auth');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('flashLogout', ' You have been logout!');
        redirect('auth');
    }
    public function blocked()
    {
        $data['title'] = '404 Error Page';

        $this->load->view('auth/blocked', $data);
    }
}
