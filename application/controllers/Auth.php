<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

    }
    public function index()
    {
        if ($this->session->userdata('username')) {
            redirect('user');
        }

        $this->form_validation->set_rules('name', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {

            $data['title'] = 'Login Page';
            $this->load->view('template/auth_header', $data);
            $this->load->view('auth/login2');
            $this->load->view('template/auth_footer');
        } else {
            $this->_login();
        }

    }
    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->set_flashdata('message', '
    <div class="alert alert-success" role="alert">
            You have been logged out!.
            </div>
    ');
        redirect('auth');
    }
    private function _login()
    {
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $user = $this->db->get_where('tbl_pengguna', ['username' => $name])->row_array();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'username' => $user['username'],
                    'level' => $user['level'],
                ];
                $this->session->set_userdata($data);
                if ($user['level'] == 1) {
                    redirect('admin');
                } else {
                    redirect('user');
                }

            } else {
                $this->session->set_flashdata('message',
                    '<div class="alert alert-danger" role="alert">
            Wrong Password!.
            </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message',
                '<div class="alert alert-danger" role="alert">
            Username is not registered!.
            </div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        $this->form_validation->set_rules('name', 'Nama', 'required|trim|is_unique[tbl_pengguna.username]', [
            'is_unique' => 'This username has already registred',
        ]
        );

        $this->form_validation->set_rules('password', 'Passworde', 'required|trim|min_length[3]|matches[re_password]', [
            'matches' => 'Password dont matches',
            'min_length' => 'Password too short',
        ]);
        $this->form_validation->set_rules('re_password', 'Passworde', 'required|trim|matches[password]');

        if ($this->form_validation->run() == false) {

            $data['title'] = 'E-EBOOK Registration';
            $this->load->view('template/auth_header', $data);
            $this->load->view('auth/registration2');
            $this->load->view('template/auth_footer');
        } else {

            $data = [
                'username' => htmlspecialchars($this->input->post('name', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'level' => 2,
            ];
            $this->session->set_flashdata('message',
                '<div class="alert alert-success" role="alert">
            Congratulation! your account has been  created. Please Login
            </div>');
            $this->db->insert('tbl_pengguna', $data);

            redirect('auth');
        }
    }
    public function bloked()
    {
        $this->load->view('auth/bloked');
    }

}