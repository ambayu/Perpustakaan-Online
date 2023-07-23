<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('tbl_pengguna', ['username' =>
            $this->session->userdata('username'),
        ])->row_array();

        $this->db->select('count(b.id_folder) as bo,a.nama_folder');
        $this->db->from('list_folder a');
        $this->db->join('tbl_surat b', 'a.id_folder = b .id_folder');

        $this->db->group_by("a.id_folder");
        $data["diagram"] = $this->db->get()->result_array();

        $this->load->view('template/user_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/top_bar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('template/user_footer', $data);
    }
    public function profil()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('tbl_pengguna', ['username' =>
            $this->session->userdata('username'),
        ])->row_array();

        $this->load->view('template/user_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/top_bar', $data);
        $this->load->view('user/profil', $data);
        $this->load->view('template/user_footer', $data);
    }

    public function edit()
    {
        $this->form_validation->set_rules('name', 'Name', 'required',
            [
                'required' => 'Nama Belum Terisi',
            ]
        );

        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required',
            [
                'required' => 'Jabatan Belum Terisi',
            ]
        );

        $this->form_validation->set_rules('no_hp', 'No_hp', 'required',
            [
                'required' => 'Nomor Hp Belum Terisi',
            ]
        );

        $this->form_validation->set_rules('username', 'Username', 'required',
            [
                'required' => 'Username Belum Terisi',
            ]
        );

        $yakin = $this->input->post('yakin');
        if ($yakin) {

            $this->form_validation->set_rules('n_pass', 'Passworde', 'required|trim|min_length[3]|matches[ren_pass]', [
                'matches' => 'Password dont matches',
                'min_length' => 'Password too short',
            ]);
            $this->form_validation->set_rules('ren_pass', 'Passworde', 'required|trim|matches[n_pass]');

        }

        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('tbl_pengguna', ['username' =>
            $this->session->userdata('username'),
        ])->row_array();

        if ($this->form_validation->run() == false) {

            $this->load->view('template/user_header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/top_bar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('template/user_footer', $data);
        } else {
            if ($this->input->post('ren_pass')) {

                $datas = password_hash($this->input->post('ren_pass'), PASSWORD_DEFAULT);
                $this->db->set('password', $datas);

            }

            $name = $this->input->post('name');

            $u_kerja = $this->input->post('u_kerja');
            $jabatan = $this->input->post('jabatan');
            $no_hp = $this->input->post('no_hp');
            $username = $this->input->post('username');

            $id = $this->input->post('id');
//----//
            $upload_image = $_FILES['image'];
            if ($upload_image) {

                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '5000';
                $config['upload_path'] = './Asset/img/profil';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['Foto'];
                    {
                        var_dump($old_image);
                        if ($old_image != 'default.jpg') {
                            unlink(FCPATH . 'Asset/img/profil/' . $old_image);
                        }
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('Foto', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }

            }

            $this->db->set('nama', $name);
            $this->db->set('unit_kerja', $u_kerja);
            $this->db->set('jabatan', $jabatan);
            $this->db->set('no_hp', $no_hp);
            $this->db->set('username', $username);

            $this->db->where('id', $id);
            $this->db->update('tbl_pengguna');
            $this->session->set_flashdata('message',
                '<div class="alert alert-success" role="alert">
            Data telah di edit!.
            </div>');
            redirect('user/edit');
        }
    }

    public function arsip()
    {
        $data['title'] = 'Management Buku';

        $data['user'] = $this->db->get_where('tbl_pengguna', ['username' =>
            $this->session->userdata('username'),
        ])->row_array();

        $data['berkas'] = $this->db->get('list_folder')->result_array();

        $this->load->view('template/user_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/top_bar', $data);
        $this->load->view('user/arsip/index', $data);
        $this->load->view('template/user_footer', $data);

    }
    public function buku()
    {

        $data['title'] = 'Lihat Buku';

        $data['user'] = $this->db->get_where('tbl_pengguna', ['username' =>
            $this->session->userdata('username'),
        ])->row_array();

        $data['berkas'] = $this->db->get('list_folder')->result_array();

        $this->load->view('template/user_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/top_bar', $data);
        $this->load->view('user/buku/index', $data);
        $this->load->view('template/user_footer', $data);

    }

    public function upload()
    {
        $data['title'] = 'Upload Buku';

        $data['user'] = $this->db->get_where('tbl_pengguna', ['username' =>
            $this->session->userdata('username'),
        ])->row_array();
        $data['nama_folder'] = $this->db->get('list_folder')->result_array();

        $this->load->view('template/user_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/top_bar', $data);
        $this->load->view('user/upload/index', $data);
        $this->load->view('template/user_footer', $data);

    }

    public function tambahfolder()
    {
        $name = $this->input->post('name');

        if ($name) {
            $this->db->insert('list_folder', [
                'nama_folder' => $name,
            ]);
            mkdir("Asset/document/" . $name, 0700);

            $this->session->set_flashdata('message',
                '<div class="alert alert-success" role="alert">
          Folder Baru Berhasil Ditambahkan!.
            </div>');
            redirect('user/arsip');

        } else {
            $this->session->set_flashdata('message',
                '<div class="alert alert-danger" role="alert">
            Nama Folder Tidak Boleh Kosong!.
            </div>');
            redirect('user/arsip');

        }
    }

    public function hapus_folder()
    {
        $name = $this->input->post('menu_id');
        $fname = $this->db->get_where('list_folder', [
            'id_folder' => $name,
        ])->row_array();
        if ($name) {
            $this->db->delete('list_folder', [
                'id_folder' => $name,
            ]);
            rmdir("Asset/document/" . $fname['nama_folder'], 0700);

            $this->session->set_flashdata('message',
                '<div class="alert alert-success" role="alert">
          Folder Berhasil Dihapus!.
            </div>');

            redirect('user/arsip');
        } else {
            $this->session->set_flashdata('message',
                '<div class="alert alert-danger" role="alert">
            Silahkan Pilih Folder Terlebih Dahulu!.
            </div>');
            redirect('user/arsip');

        }
    }

    public function editp()
    {

        $j_surat = $this->input->post('j_surat');
        $fn = $this->input->post('fn');
        $tanggal = $this->input->post('tanggal');
        $k_surat = $this->input->post('k_surat');

        $data = array(
            'Judul' => $j_surat,
            'id_folder' => $fn,
            'tanggal' => $tanggal,
            'keterangan' => $k_surat,
        );

        if ($j_surat == "" or $fn == "" or $tanggal == "" or $k_surat == "") {
            $this->session->set_flashdata('message',
                '<div class="alert alert-danger" role="alert">
           Data Belum Diisi!.
            </div>');

            redirect('user/upload');
        } else {
            $cari = $this->db->get_where('list_folder', [
                'id_folder' => $fn,
            ])->row_array();

            $upload_foto = $_FILES['image'];
            if ($upload_foto) {
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_size'] = '10000';
                $config['upload_path'] = './Asset/img/buku/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $new_foto = $this->upload->data('file_name');
                } else {
                    $mama = $this->upload->display_errors();

                    $this->session->set_flashdata('message',
                        '<div class="alert alert-danger" role="alert">
                     ' . $mama . ' file harus bertype jpeg,jpg,png
                    </div>');

                }
            }

            $upload_image = $_FILES['doc'];
            if ($upload_image) {

                $config['allowed_types'] = 'pdf|doc|xls|jpeg|jpg|png|xlsx|docx';
                $config['max_size'] = '10000';
                $config['upload_path'] = './Asset/document/' . $cari['nama_folder'];
                $this->upload->initialize($config);

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('doc')) {

                    $new_image = $this->upload->data('file_name');

                    $type = explode(".", $upload_image['name']);

                    $this->db->set('type', $type[1]);
                    $this->db->set('document_file', $new_image);
                    $this->db->set('foto', $new_foto);
                    $this->db->set($data);
                    $this->db->insert('tbl_surat');

                    $this->session->set_flashdata('message',
                        '<div class="alert alert-success" role="alert">
                              Document Disimpan!.
                         </div>');

                } else {

                    $mama = $this->upload->display_errors();

                    $this->session->set_flashdata('message',
                        '<div class="alert alert-danger" role="alert">
                     ' . $mama . ' file harus bertype pdf,doc,xls,jpeg,jpg,png,xlsx,docx
                    </div>');

                }
                redirect('user/upload');

            }

        }
    }

    public function views()
    {
        $menu = $this->uri->segment(3);
        $data['link'] = $menu;
        $buku = $this->uri->segment(4);

        $this->db->select('*');
        $this->db->from('tbl_surat');
        $this->db->join('list_folder ', 'tbl_surat.id_folder = list_folder.id_folder');
        $this->db->where('tbl_surat.id_folder', $menu);
        $this->db->where('tbl_surat.id_surat', $buku);

        $data['berkas'] = $this->db->get()->result_array();

        $data['title'] = 'Lihat Buku';
        $data['user'] = $this->db->get_where('tbl_pengguna',
            ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('template/user_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/top_bar', $data);
        $this->load->view('user/buku/views', $data);
        $this->load->view('template/user_footer', $data);

    }

    public function folder2()
    {
        $menu = $this->uri->segment(3);
        $data['link'] = $menu;
        $sort = $this->uri->segment(4);
        $search = $this->input->post('search');

        $data['title'] = 'List Buku';
        $data['user'] = $this->db->get_where('tbl_pengguna', ['username' =>
            $this->session->userdata('username'),
        ])->row_array();

        $this->db->select('*');
        $this->db->from('tbl_surat');
        $this->db->join('tbl_icon ', 'tbl_surat.type = tbl_icon .type');
        $this->db->where('id_folder', $menu);

        if ($sort) {
            if ($sort == "tgl") {
                $this->db->order_by('tbl_surat.tanggal', 'asc');

            }
            if ($sort == "nm") {
                $this->db->order_by('tbl_surat.Judul', 'asc');

            }
            if ($sort == "typ") {
                $this->db->order_by('tbl_surat.type', 'asc');
            }

        }
        if ($search) {
            $this->db->like('tbl_surat.Judul', $search);
        }

        $data['berkas'] = $this->db->get()->result_array();

        $this->load->view('template/user_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/top_bar', $data);
        $this->load->view('user/buku/folder', $data);
        $this->load->view('template/user_footer', $data);

    }

    public function folder()
    {
        $menu = $this->uri->segment(3);
        $data['link'] = $menu;
        $sort = $this->uri->segment(4);
        $search = $this->input->post('search');

        $data['title'] = 'Management Buku';
        $data['user'] = $this->db->get_where('tbl_pengguna', ['username' =>
            $this->session->userdata('username'),
        ])->row_array();
        if ($sort) {
            if ($sort == "tgl") {
                $this->db->order_by('tbl_surat.tanggal', 'asc');

            }
            if ($sort == "nm") {
                $this->db->order_by('tbl_surat.Judul', 'asc');

            }
            if ($sort == "typ") {
                $this->db->order_by('tbl_surat.type', 'asc');
            }

        }
        if ($search) {
            $this->db->like('tbl_surat.Judul', $search);
        }

        $this->db->select('*');
        $this->db->from('tbl_surat');
        $this->db->join('tbl_icon ', 'tbl_surat.type = tbl_icon .type');
        $this->db->where('id_folder', $menu);

        $data['berkas'] = $this->db->get()->result_array();

        $this->load->view('template/user_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/top_bar', $data);
        $this->load->view('user/arsip/folder', $data);
        $this->load->view('template/user_footer', $data);

    }

    public function mendelete()
    {
        $link = $this->uri->segment(3);
        $id_surat = $this->uri->segment(4);

        $this->db->select('*');
        $this->db->from('tbl_surat');
        $this->db->join('list_folder ', 'tbl_surat.id_folder = list_folder .id_folder');
        $this->db->where('tbl_surat.id_surat', $id_surat);
        $cari = $this->db->get()->row_array();

        $path = "Asset/document/" . $cari["nama_folder"] . "/" . $cari["document_file"];

        unlink($path);
        $this->db->delete('tbl_surat', [
            'id_surat' => $id_surat,
        ]);

        $this->session->set_flashdata('message',
            '<div class="alert alert-danger" role="alert">
    Surat Berhasil Dihapus
                    </div>');

        redirect('user/folder/' . $link);

    }

    public function download()
    {

        $link = $this->input->post('link');
        $id_surat = $this->input->post('id_surat');

        $this->db->select('*');
        $this->db->from('tbl_surat');
        $this->db->join('list_folder ', 'tbl_surat.id_folder = list_folder .id_folder');
        $this->db->where('tbl_surat.id_surat', $id_surat);
        $cari = $this->db->get()->row_array();

        $this->load->helper('download');

        $path = "Asset/document/" . $cari["nama_folder"] . "/" . $cari["document_file"];
        force_download($path, null);

    }
}