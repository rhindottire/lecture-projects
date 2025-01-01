<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_sewa extends CI_Model
{

    public function live_chanel()
    {
        $hasil = $this->db->query("SELECT * FROM tb_chanel  ");
        return $hasil;
    }

    public function live_online()
    {
        $hasil = $this->db->query("SELECT * FROM tb_chanel  JOIN tb_sewa ON tb_chanel.id_chanel=tb_sewa.id_chanel 
        JOIN tb_member ON tb_sewa.kode_member=tb_member.kode WHERE tb_chanel.status='Y' AND tb_member.status='N' ");
        return $hasil;
    }

    public function randomString()
    {
        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
        $shuffle  = substr(str_shuffle($karakter), 0, 5);
        return $shuffle;
    }

    public function live_member()
    {
        $hasil = $this->db->query("SELECT * FROM tb_member JOIN tb_sewa ON tb_member.kode=tb_sewa.kode_member where status='Y' order by id_member ASC limit 1 ");
        return $hasil->row();
    }

    public function live_bayar()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d');
        $hasil = $this->db->query("SELECT * FROM tb_member 
        JOIN tb_sewa ON tb_member.kode=tb_sewa.kode_member 
        WHERE status='T' AND tgl='$tgl' order by id_member DESC");
        return $hasil;
    }

    public function live_penjualan()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d');
        $hasil = $this->db->query("SELECT * FROM tb_penjualan  WHERE tgl='$tgl' ORDER BY id_penjualan DESC");
        return $hasil;
    }
}
