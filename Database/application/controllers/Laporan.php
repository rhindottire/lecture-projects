<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_laporan');
    }

    public function index()
    {
        chek_belom_login();
        check_admin();
        $data = [
            'title' => 'PlayStation | Laporan',
            'Menu' => 'laporan',
            'activeMenu' => 'laporan',
            'log' => $this->m_master->user_login(),
        ];
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/navbar');
        $this->load->view('laporan/laporan');
        $this->load->view('template/footer');
    }

    public function cari_data()
    {
        $tgl1 = $this->input->post('tgl1');
        $tgl2 = $this->input->post('tgl2');
        if (isset($_POST['tgl1'])) {
            $data['v_pdt'] = $this->m_laporan->chek_pendapatan($tgl1, $tgl2);
            $data['v_ttl_pdt'] = $this->m_laporan->total_pendapatan($tgl1, $tgl2)->row_array();
            $data['v_pjl'] = $this->m_laporan->chek_penjualan($tgl1, $tgl2);
            $data['v_ttl_pjl'] = $this->m_laporan->total_penjualan($tgl1, $tgl2)->row_array();
            $data['v_pgl'] = $this->m_laporan->chek_pengeluaran($tgl1, $tgl2);
            $data['v_ttl_pgl'] = $this->m_laporan->total_pengeluaran($tgl1, $tgl2)->row_array();
            $this->load->view('laporan/dt_print', $data);
        } else {
            echo 'Cek Lagi';
        }
    }
}
