<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_master extends CI_Model
{

    public function live_chanel()
    {
        $hasil = $this->db->query("SELECT * FROM tb_chanel  ");
        return $hasil;
    }

    public function live_harga()
    {
        $hasil = $this->db->query("SELECT * FROM tb_harga  ");
        return $hasil;
    }

    public function live_user()
    {
        $hasil = $this->db->query("SELECT * FROM tb_user  ");
        return $hasil;
    }

    public function get($id = null)
    {
        $this->db->from('tb_user');
        if ($id != null) {
            $this->db->where('id_user', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function user_login()
    {
        $hasil = $this->db->get_where('tb_user', ['id_user' => $this->session->userdata('id_user')])->row();
        return $hasil;
    }
}
