<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_master');
        $this->load->library('form_validation');
    }
    public function chanel()
    {
        chek_belom_login();
        check_admin();
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|is_unique[tb_chanel.nama_chanel]', ['required' => 'Form harus diisi', 'is_unique' => 'Nama Chanel sudah pernah di inputkan, silahkan input Nama lain!']);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'PlayStation | Data Chanel',
                'Menu' => 'master',
                'activeMenu' => 'chanel',
                'log' => $this->m_master->user_login(),
                'ch' => $this->m_master->live_chanel()->result()
            ];
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('template/navbar');
            $this->load->view('master/chanel');
            $this->load->view('template/footer');
        } else {
            $data = [
                'nama_chanel' => $this->input->post('nama'),
                'status' => 'N'
            ];
            $this->db->insert('tb_chanel', $data);
            $this->session->set_flashdata('test', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
            redirect('master/chanel');
        }
    }

    public function edit_chanel()
    {
        $id = $this->input->post('id');
        $data = [
            'nama_chanel' => $this->input->post('nama')
        ];
        $this->db->where('id_chanel', $id);
        $this->db->update('tb_chanel', $data);
        $this->session->set_flashdata('edit', '<div class="alert alert-success" role="alert">Edit data berhasil disimpan</div>');
        redirect('master/chanel');
    }

    public function hapus_chanel()
    {
        $a = $this->input->post('id');
        $this->db->where('id_chanel', $a);
        $ss = $this->db->delete('tb_chanel');
        echo json_encode($ss);
    }

    public function harga()
    {
        chek_belom_login();
        check_admin();
        $data = [
            'title' => 'PlayStation | Data Harga',
            'Menu' => 'master',
            'activeMenu' => 'harga',
            'log' => $this->m_master->user_login(),
            'hrg' => $this->m_master->live_harga()->result()
        ];
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/navbar');
        $this->load->view('master/harga');
        $this->load->view('template/footer');
    }

    public function edit_harga()
    {
        $id = $this->input->post('id');
        $data = [
            'menit' => $this->input->post('menit'),
            'harga' => $this->input->post('harga')
        ];
        $this->db->where('id_harga', $id);
        $this->db->update('tb_harga', $data);
        $this->session->set_flashdata('edit', '<div class="alert alert-success" role="alert">Edit data berhasil disimpan</div>');
        redirect('master/harga');
    }

    public function user()
    {
        chek_belom_login();
        check_admin();
        $this->form_validation->set_rules('nama_lengkap', 'Nama', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tb_user.username]', ['is_unique' => 'Username sudah pernah di inputkan, silahkan input Username lain!']);
        $this->form_validation->set_rules('level', 'Level', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', ['matches' => 'Password tidak sama!', 'min_length' => 'Password harus 6 digit/lebih!', 'required' => 'Password harus diisi']);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', ['required' => 'Konfirmasi password harus diisi']);
        if ($this->form_validation->run() == false) {

            $data = [
                'title' => 'PlayStation | Data User',
                'Menu' => 'master',
                'activeMenu' => 'user',
                'log' => $this->m_master->user_login(),
                'ur' => $this->m_master->live_user()->result()
            ];
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('template/navbar');
            $this->load->view('master/user');
            $this->load->view('template/footer');
        } else {
            $data = [
                'nama_lengkap' => htmlspecialchars($this->input->post('nama_lengkap', true)),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'level' => htmlspecialchars($this->input->post('level', true))
            ];
            $this->db->insert('tb_user', $data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
            redirect('master/user');
        }
    }

    public function edit_user()
    {
        $id = $this->input->post('id');
        $data = [
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'username' => $this->input->post('username'),
            'level' => $this->input->post('level'),
        ];
        $this->db->where('id_user', $id);
        $this->db->update('tb_user', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Edit data berhasil disimpan</div>');
        redirect('master/user');
    }

    public function hapus_user()
    {
        $a = $this->input->post('id');
        $this->db->where('id_user', $a);
        $ss = $this->db->delete('tb_user');
        echo json_encode($ss);
    }

    public function edit_password()
    {
        chek_belom_login();
        $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
        $this->form_validation->set_rules('pass_lama', 'Password Lama', 'required|trim', ['required' => 'Password lama harus diisi']);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', ['matches' => 'Password tidak sama!', 'min_length' => 'Password harus 6 digit/lebih!', 'required' => 'Password harus diisi']);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', ['required' => 'Konfirmasi password harus diisi']);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'PlayStation | Edit Password',
                'Menu' => 'edit_passs',
                'activeMenu' => 'edit_passs',
                'log' => $this->m_master->user_login(),
            ];
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('template/navbar');
            $this->load->view('master/edit_password');
            $this->load->view('template/footer');
        } else {
            $passlama = $this->input->post('pass_lama');
            $passbaru = $this->input->post('password1');
            if (!password_verify($passlama, $data['user']['password'])) {
                $this->session->set_flashdata('pass', '<div class="alert alert-danger" role="alert">Password lama salah</div>');
                redirect('master/edit_password');
            } else {
                if ($passlama == $passbaru) {
                    $this->session->set_flashdata('pass', '<div class="alert alert-danger" role="alert">Password tidak boleh sama dengan yang lama</div>');
                    redirect('master/edit_password');
                } else {
                    $pass_hash = password_hash($passbaru, PASSWORD_DEFAULT);

                    $this->db->set('password', $pass_hash);
                    $this->db->where('id_user', $data['user']['id_user']);
                    $this->db->update('tb_user');

                    $this->session->set_flashdata('pass', '<div class="alert alert-success" role="alert">Edit Password Berhasil</div>');

                    redirect('master/edit_password');
                }
            }
        }
    }
}
