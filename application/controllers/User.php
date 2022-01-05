<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Barista_model', 'barista');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $title = 'My Profile';
        $user  = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run()) {
            if (!empty($_FILES['image']['name'])) {

                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '5048';
                $config['upload_path'] = './assets/img/profile/';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('image')) {
                    echo $this->upload->display_errors();

                    $data = array(
                        'title'     => $title,
                        'user'      => $user,
                    );
                    $this->template->load('templates/admin/templates', 'user/index', $data);
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

                    if ($user['image'] != null && $user['image'] != 'default-admin.png' && $user['image'] != 'default-barista.png' && $user['image'] != 'default-user.png') {
                        $file = './assets/img/profile/' . $user['image'];
                        unlink($file);
                    }

                    $data = array(
                        'name'          => $this->input->post('name'),
                        'image'         => $upload_image,
                    );
                    $where = array(
                        'email' => $user['email']
                    );
                    $this->admin->update($where, $data, 'user');
                    $this->session->set_flashdata('message', 'Your profile has been updated!');
                    redirect('user/user');
                }
            } else {
                $data = array(
                    'name'          => $this->input->post('name'),
                );
                $where = array(
                    'email' => $user['email']
                );
                $this->admin->update($where, $data, 'user');
                $this->session->set_flashdata('message', 'Your profile has been updated!');
                redirect('user/user');
            }
        }
        $data = array(
            'title'     => $title,
            'user'      => $user,
        );
        $this->template->load('templates/admin/templates', 'user/index', $data);
    }
    public function changepass()
    {
        $title = 'Change Password';
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[6]|matches[new_password1]');
        $data = array(
            'title' => $title,
            'user' => $user,
        );
        if ($this->form_validation->run() == false) {
            $this->template->load('templates/admin/templates', 'user/change-pass', $data);
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', 'Wrong Current Password!');
                redirect('user/user/changepass');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', 'New password cannot be the same as current password!');
                    redirect('user/user/changepass');
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', 'Password Changed!');
                    redirect('user/user/changepass');
                }
            }
        }
    }
    public function admin()
    {
        if ($this->admin->is_role() != 1) {
            redirect('auth/blocked');
        }

        $title  = 'Dashboard Admin';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $date   = date('Y-m-d');
        $day    = date('d');
        $month  = date('m');
        $year   = date('Y');
        $monthfavorite = date('m') - 1;

        // $FavoriteProduct = $this->admin->favoriteProduct($month, $year);

        $data = array(
            'title'     => $title,
            'subtitle'  => 'Daily Transaction',
            'user'      => $user,
            'date'      => date('Y-m-d'),
            'products'          => $this->admin->detailProduct(),
            'totalUser'         => $this->db->get('user')->num_rows(),
            'totalProducts'     => $this->db->get('products')->num_rows(),
            'totalCategories'   => $this->db->get('categories')->num_rows(),
            'totalTransactions' => $this->db->get_where('invoice', array('payment_status' => 'Complete', 'transaction_date' => $date))->num_rows(),
            'RecentlyProduct'   => $this->admin->RecentlyProduct(),
            'LatestInvoice'     => $this->admin->LatestInvoice(),
            'DailyTransaction'  => $this->admin->dailyTransaction($day, $month, $year),
            'FavoriteProduct'   => $this->admin->favoriteProduct($monthfavorite, $year)
        );

        $this->template->load('templates/admin/templates', 'dashboard', $data);
    }
    public function barista()
    {
        if ($this->admin->is_role() != 3) {
            redirect('auth/blocked');
        }

        $title  = 'Dashboard Barista';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $date   = date('Y-m-d');
        $day    = date('d');
        $month  = date('m');
        $year   = date('Y');

        $data = array(
            'title'             => $title,
            'subtitle'          => 'Daily Transaction',
            'user'              => $user,
            'products'          => $this->admin->detailProduct(),
            'totalProducts'     => $this->db->get('products')->num_rows(),
            'totalIngredients'  => $this->db->get('ingredients')->num_rows(),
            'totalTable'        => $this->db->get('customer_table')->num_rows(),
            'totalTransactions' => $this->db->get_where('invoice', array('payment_status' => 'Complete', 'transaction_date' => $date))->num_rows(),
            'RecentlyProduct'   => $this->barista->RecentlyProduct(),
            'LatestInvoice'     => $this->barista->LatestInvoice(),
            'DailyTransaction'  => $this->barista->dailyTransaction($day, $month, $year),
        );

        $this->template->load('templates/admin/templates', 'dashboard', $data);
    }
    public function owner()
    {
        if ($this->admin->is_role() != 4) {
            redirect('auth/blocked');
        }

        $title  = 'Dashboard Owner';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $date   = date('Y-m-d');
        $day    = date('d');
        $month  = date('m');
        $year   = date('Y');
        $monthfavorite = date('m') - 1;

        $data = array(
            'title'     => $title,
            'subtitle'  => 'Daily Transaction',
            'user'      => $user,
            'date'      => date('Y-m-d'),
            'products'          => $this->admin->detailProduct(),
            'totalProducts'     => $this->db->get('products')->num_rows(),
            'totalIngredients'  => $this->db->get('ingredients')->num_rows(),
            'totalTable'        => $this->db->get('customer_table')->num_rows(),
            'totalTransactions' => $this->db->get_where('invoice', array('payment_status' => 'Complete', 'transaction_date' => $date))->num_rows(),
            'RecentlyProduct'   => $this->admin->RecentlyProduct(),
            'LatestInvoice'     => $this->admin->LatestInvoice(),
            'DailyTransaction'  => $this->admin->dailyTransaction($day, $month, $year),
            'FavoriteProduct'   => $this->admin->favoriteProduct($monthfavorite, $year)
        );

        $this->template->load('templates/admin/templates', 'dashboard', $data);
    }
}
