<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_laporan extends CI_Model
{

    public function chek_pendapatan($tgl1, $tgl2)
    {
        $this->db->select('tgl,dibayar, sum(dibayar) as dby');
        $this->db->from('tb_member');
        $this->db->where("tgl >='$tgl1'");
        $this->db->where("tgl <='$tgl2'");
        $this->db->where("status", "T");
        $this->db->group_by("tgl");
        $query = $this->db->get();
        return $query;
    }

    public function total_pendapatan($tgl1, $tgl2)
    {
        $this->db->select('tgl,status,dibayar, sum(dibayar) as ttl_dby');
        $this->db->from('tb_member');
        $this->db->where("tgl >='$tgl1'");
        $this->db->where("tgl <='$tgl2'");
        $this->db->where("status", "T");
        $this->db->group_by("status");
        $query = $this->db->get();
        return $query;
    }

    public function chek_penjualan($tgl1, $tgl2)
    {
        $this->db->select('tgl,jml, sum(jml) as jum');
        $this->db->from('tb_penjualan');
        $this->db->where("tgl >='$tgl1'");
        $this->db->where("tgl <='$tgl2'");
        $this->db->where("kode_penjualan", "BY");
        $this->db->group_by("tgl");
        $query = $this->db->get();
        return $query;
    }

    public function total_penjualan($tgl1, $tgl2)
    {
        $this->db->select('tgl,jml,kode_penjualan, sum(jml) as ttl_jum');
        $this->db->from('tb_penjualan');
        $this->db->where("tgl >='$tgl1'");
        $this->db->where("tgl <='$tgl2'");
        $this->db->where("kode_penjualan", "BY");
        $this->db->group_by("kode_penjualan");
        $query = $this->db->get();
        return $query;
    }

    public function chek_pengeluaran($tgl1, $tgl2)
    {
        $this->db->select('tgl,total, sum(total) as jum');
        $this->db->from('tb_pengeluaran');
        $this->db->where("tgl >='$tgl1'");
        $this->db->where("tgl <='$tgl2'");
        $this->db->group_by("tgl");
        $query = $this->db->get();
        return $query;
    }

    public function total_pengeluaran($tgl1, $tgl2)
    {
        $this->db->select('tgl,total, sum(total) as ttl_jump');
        $this->db->from('tb_pengeluaran');
        $this->db->where("tgl >='$tgl1'");
        $this->db->where("tgl <='$tgl2'");
        $this->db->group_by("total");
        $query = $this->db->get();
        return $query;
    }
}
