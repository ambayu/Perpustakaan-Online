<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        is_logged_in();

    }
    public function index()
    {
        $data['title'] = 'Dashboard Admin';
        $data['user'] = $this->db->get_where('tbl_pengguna', ['username' =>
            $this->session->userdata('username'),
        ])->row_array();

        $this->load->view('template/user_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/top_bar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template/user_footer', $data);
    }
    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('tbl_pengguna', ['username' =>
            $this->session->userdata('username'),
        ])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required',
            [
                'required' => 'Nama role Belum Terisi',
            ]);
        if ($this->form_validation->run() == false) {

            $this->load->view('template/user_header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/top_bar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('template/user_footer', $data);
        } else {
            $this->db->insert('user_role', [
                'role' => $this->input->post('menu'),

            ]);
            $this->session->set_flashdata('message',
                '<div class="alert alert-success" role="alert">
            New role added!.
            </div>');
            redirect('admin/role');

        }

    }
    public function role_access($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('tbl_pengguna', ['username' =>
            $this->session->userdata('username'),
        ])->row_array();

        $data['role'] = $this->db->get_where('user_role', [

            'id' => $role_id,
        ])->row_array();
        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('template/user_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/top_bar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('template/user_footer', $data);

    }

    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'level' => $role_id,
            'menu_id' => $menu_id,
        ];
        $result = $this->db->get_where('tbl_acces_menu', $data);
        if ($result->num_rows() < 1) {
            $this->db->insert('tbl_acces_menu', $data);
        } else {
            $this->db->delete('tbl_acces_menu', $data);

        }

        $this->session->set_flashdata('message',
            '<div class="alert alert-success" role="alert">Access Changeds!.' . var_dump($data) . '
            </div>');

    }

}