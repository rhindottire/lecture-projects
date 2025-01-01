<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengeluaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_master');
        $this->load->model('m_pengeluaran');
        $this->load->library('form_validation');
    }
    public function index()
    {
        chek_belom_login();
        check_admin();
        $this->form_validation->set_rules('item', 'Item', 'required|trim', ['required' => 'Form harus diisi']);
        $this->form_validation->set_rules('jml', 'Jumlah', 'required|trim', ['required' => 'Form harus diisi']);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'PlayStation | Pengeluaran',
                'Menu' => 'pengeluaran',
                'activeMenu' => 'pengeluaran',
                'log' => $this->m_master->user_login(),
                'pg' => $this->m_pengeluaran->live_tgl()->result(),
                'ttl' => $this->m_pengeluaran->live_ttl()
            ];
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('template/navbar');
            $this->load->view('pengeluaran/pengeluaran');
            $this->load->view('template/footer');
        } else {
            $data = [
                'item' => $this->input->post('item'),
                'tgl' => date('Y-m-d'),
                'total' => $this->input->post('jml2'),
                'id_user' => 1
            ];
            $this->db->insert('tb_pengeluaran', $data);
            $this->session->set_flashdata('test', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
            redirect('pengeluaran');
        }
    }

    public function edit_pengeluaran()
    {
        $id = $this->input->post('id');
        $data = [
            'item' => $this->input->post('item'),
            'total' => $this->input->post('jml'),
        ];
        $this->db->where('id_pengeluaran', $id);
        $this->db->update('tb_pengeluaran', $data);
        $this->session->set_flashdata('edit', '<div class="alert alert-success" role="alert">Edit data berhasil disimpan</div>');
        redirect('pengeluaran');
    }

    public function hapus_pengeluaran()
    {
        $a = $this->input->post('id');
        $this->db->where('id_pengeluaran', $a);
        $ss = $this->db->delete('tb_pengeluaran');
        echo json_encode($ss);
    }
}
