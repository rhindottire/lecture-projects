<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pengeluaran extends CI_Model
{

    public function live_tgl()
    {
        date_default_timezone_set('Asia/Jakarta');
        $y = date('Y');
        $m = date('m');
        $hasil = $this->db->query("SELECT * FROM tb_pengeluaran WHERE MONTH(tgl) ='$m' AND YEAR(tgl) ='$y' ");
        return $hasil;
    }

    public function live_ttl()
    {
        date_default_timezone_set('Asia/Jakarta');
        $b = date('m');
        $t = date('Y');
        $hasil = $this->db->query("SELECT SUM(total) as ttl, tgl FROM tb_pengeluaran WHERE MONTH(tgl) ='$b' AND YEAR(tgl) ='$t' ");
        $cek = $hasil->num_rows();
        if ($cek > 0) {
            $ada = $hasil->row_array();
        } else {
            $ada = array(
                'ttl' => 0,
            );
        }
        return $ada;
    }
}
