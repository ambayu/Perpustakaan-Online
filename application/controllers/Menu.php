<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        if (!$this->session->userdata('username')) {
            redirect('auth');

        }

    }

    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('tbl_pengguna', ['username' =>
            $this->session->userdata('username'),
        ])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('template/user_header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/top_bar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('template/user_footer', $data);
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message',
                '<div class="alert alert-success" role="alert">
            New menu added!.
            </div>');
            redirect('menu');

        }

    }

    public function qedit()
    {
        $kode = $this->input->post('kode');
        $menu = $this->input->post('nama');
        if ($menu == "") {
            $this->session->set_flashdata('message',
                '<div class="alert alert-danger" role="alert">
            Data Belum Diisi!.
            </div>');
            redirect('menu');

        } else {
            $this->db->set('menu', $menu);
            $this->db->where('id', $kode);
            $this->db->update('user_menu');
            $this->session->set_flashdata('message',
                '<div class="alert alert-success" role="alert">
            Data Berhasil Disimpan!.
            </div>');
            redirect('menu');

        }

    }
    public function qdelete()
    {
        $menu = $this->uri->segment(3);

        $this->db->delete('user_menu', [
            'id' => $menu,
        ]);
        $this->session->set_flashdata('message',
            '<div class="alert alert-danger" role="alert">
            Data Berhasil Dihapus!.
            </div>');
        redirect('menu');

    }

    public function sqdelete()
    {
        $menu = $this->uri->segment(3);

        $this->db->delete('user_sub_menu', [
            'id' => $menu,
        ]);
        $this->session->set_flashdata('message',
            '<div class="alert alert-danger" role="alert">
            Data Berhasil Dihapus!.
            </div>');
        redirect('menu/sub_menu');

    }

    public function sqedit()
    {
        $id = $this->input->post('id');

        $menu = $this->input->post('menu_id');
        $title = $this->input->post('title');

        $url = $this->input->post('url');
        $icons = $this->input->post('icons');

        if ($id == "" or $menu == "" or $title == "" or $url == "" or $icons == "") {
            $this->session->set_flashdata('message',
                '<div class="alert alert-danger" role="alert">
            Data Belum Diisi!.
            </div>');
            redirect('menu/submenu');

        } else {
            $this->db->set('menu_id', $menu);
            $this->db->set('title', $title);
            $this->db->set('url', $url);
            $this->db->set('icons', $icons);

            $this->db->where('id', $id);
            $this->db->update('user_sub_menu');
            $this->session->set_flashdata('message',
                '<div class="alert alert-success" role="alert">
            Data Berhasil Disimpan!.
            </div>');
            redirect('menu/sub_menu');

        }

    }
    public function sub_menu()
    {
        $data['title'] = 'SubMenu Management';
        $data['user'] = $this->db->get_where('tbl_pengguna', ['username' =>
            $this->session->userdata('username'),
        ])->row_array();

        $this->load->model('Menu_model', 'menu');
        $data['Submenu'] = $this->menu->SubMenu();

        $this->form_validation->set_rules('menu_id', 'Menu_id', 'required',
            [
                'required' => 'Menu Belum Terisi',
            ]
        );

        $this->form_validation->set_rules('url', 'Url', 'required',
            [
                'required' => 'Url Belum Terisi',
            ]
        );
        $this->form_validation->set_rules('title', 'Title', 'required',
            [
                'required' => 'Title Belum Terisi',
            ]
        );
        $this->form_validation->set_rules('icons', 'Icons', 'required',
            [
                'required' => 'Title Belum Terisi',
            ]
        );

        $data['menu'] = $this->db->get('user_menu')->result_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('template/user_header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/top_bar', $data);
            $this->load->view('menu/sub_menu/index', $data);
            $this->load->view('template/user_footer', $data);

        } else {
            $this->db->insert('user_sub_menu', [
                'menu_id' => $this->input->post('menu_id'),
                'title' => $this->input->post('title'),
                'url' => $this->input->post('url'),
                'icons' => $this->input->post('icons'),

            ]);
            $this->session->set_flashdata('message',
                '<div class="alert alert-success" role="alert">
            New menu added!.
            </div>');
            redirect('menu/sub_menu');

        }

    }

    public function account()
    {
        $data['title'] = 'Account Management';
        $data['user'] = $this->db->get_where('tbl_pengguna', ['username' =>
            $this->session->userdata('username'),
        ])->row_array();

        $this->load->model('Menu_model', 'menu');
        $data['Submenu'] = $this->menu->Account();

        $data['akses'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('n_pass', 'Passworde', 'required|trim|min_length[3]|matches[ren_pass]', [
            'matches' => 'Password dont matches',
            'min_length' => 'Password too short',
        ]);
        $this->form_validation->set_rules('ren_pass', 'Passworde', 'required|trim|matches[n_pass]');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/user_header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/top_bar', $data);
            $this->load->view('menu/account/index', $data);
            $this->load->view('template/user_footer', $data);

        } else {
            $id = $this->input->post('id');
            $datas = password_hash($this->input->post('ren_pass'), PASSWORD_DEFAULT);
            $this->db->set('password', $datas);

            $this->db->where('id', $id);
            $this->db->update('tbl_pengguna');

            $this->session->set_flashdata('message',
                '<div class="alert alert-success" role="alert">
            New Password Berhasil Diubah!.
            </div>');
            redirect('menu/account');

        }

    }

    public function adelete()
    {
        $menu = $this->uri->segment(3);

        $this->db->delete('tbl_pengguna', [
            'id' => $menu,
        ]);
        $this->session->set_flashdata('message',
            '<div class="alert alert-danger" role="alert">
            Data Berhasil Dihapus!.
            </div>');
        redirect('menu/account');

    }
    public function achange()
    {
        $id = $this->input->post('id');
        $menu_id = $this->input->post('menu_id');
        $this->db->set('level', $menu_id);

        $this->db->where('id', $id);
        $this->db->update('tbl_pengguna');
        $this->session->set_flashdata('message',
            '<div class="alert alert-success" role="alert">
            Hak Akses Berhasil Diubah!.
            </div>');
        redirect('menu/account');

    }

}