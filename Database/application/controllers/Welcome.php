<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_master');
		$this->load->model('m_sewa');
		$this->load->library('form_validation');
	}
	public function index()
	{
		chek_belom_login();
		$data = [
			'title' => 'PlayStation | Chanel',
			'Menu' => 'onch',
			'activeMenu' => 'on_chanel',
			'log' => $this->m_master->user_login(),
			'ch' => $this->m_master->live_chanel()->result(),
			'hrg' => $this->m_master->live_harga()->result(),
			'ol' => $this->m_sewa->live_online()->result(),
			'byy' => $this->m_sewa->live_bayar()->result(),
			'pj' => $this->m_sewa->live_penjualan()->result(),
		];
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar');
		$this->load->view('template/navbar');
		$this->load->view('template/home');
		$this->load->view('template/footer');
	}

	public function start()
	{
		date_default_timezone_set('Asia/Jakarta');
		$kode = $this->m_sewa->randomString();
		$id_ch = $this->input->post('id');
		$kode2 = $kode . date("YmdHis");
		$waktu = $this->input->post('waktu');

		if ($waktu == "A") {
			$wktu = date('Y-m-d H:i:s', time() + (60 * 60)); //1 jam kedepan
			$paket = "Paket : 1 Jam";
		} else if ($waktu == "B") {
			$wktu = date('Y-m-d H:i:s', time() + (60 * 60) + (60 * 30)); //1.5 jam kedepan
			$paket = "Paket : 1.5 Jam";
		} else if ($waktu == "C") {
			$wktu = date('Y-m-d H:i:s', time() + (60 * 60) * 2); //2 jam kedepan
			$paket = "Paket : 2 Jam";
		} else if ($waktu == "D") {
			$wktu = date('Y-m-d H:i:s', time() + (60 * 60) * 2 + (60 * 30)); //2.5 jam kedepan
			$paket = "Paket : 2.5 Jam";
		} else if ($waktu == "E") {
			$wktu = date('Y-m-d H:i:s', time() + (60 * 60) * 3); //3 jam kedepan
			$paket = "Paket : 3 Jam";
		} else if ($waktu == "F") {
			$wktu = date('Y-m-d H:i:s', time() + (60 * 60) * 3 + (60 * 30)); //3.5 jam kedepan
			$paket = "Paket : 3.5 Jam";
		} else if ($waktu == "G") {
			$wktu = date('Y-m-d H:i:s', time() + (60 * 60) * 4); //4 jam kedepan
			$paket = "Paket : 4 Jam";
		} else if ($waktu == "H") {
			$wktu = date('Y-m-d H:i:s', time() + (60 * 30)); //4 jam kedepan
			$paket = "Paket : 30 Menit";
		} else if ($waktu == "") {
			$wktu = "";
			$paket = "Paket : 0 Jam";
			$this->session->set_flashdata('notiff', '<div class="alert alert-danger" role="alert">"GAGAL START" <br>Pastikan paket yang anda pilih sudah benar</div>');
			redirect('welcome');
		}



		$data = [
			'id_user' => 1,
			'kode' => $kode2,
			'nama' => $this->input->post('nm'),
			'tgl' => date('Y-m-d'),
		];
		$this->db->insert('tb_member', $data);

		if ($waktu == "kosong") {

			$data2 = [
				'id_chanel' => $id_ch,
				'kode_member' => $kode2,
				'start' => date('Y-m-d H:i:s'),
				'harga_sewa' => $this->input->post('harga'),
				'aktif' => 'ON'
			];
			$this->db->insert('tb_sewa', $data2);
		} else {

			$data2 = [
				'id_chanel' => $id_ch,
				'kode_member' => $kode2,
				'start' => date('Y-m-d H:i:s'),
				'stop' => $wktu,
				'harga_sewa' => $this->input->post('harga'),
				'aktif' => 'ON'
			];
			$this->db->insert('tb_sewa', $data2);

			$data3 = [
				'kode_paket' => $kode2,
				'paket' => $paket,
			];
			$this->db->insert('tb_paket', $data3);
		}

		$data4 = [
			'status' => 'Y'
		];
		$this->db->where('id_chanel', $id_ch);
		$this->db->update('tb_chanel', $data4);

		redirect('welcome');
	}

	public function add()
	{
		date_default_timezone_set('Asia/Jakarta');
		$id_sw = $this->input->post('id');
		$id_pk = $this->input->post('id_pk');
		$waktu_lama = $this->input->post('waktu_lama');

		$date = date_create($waktu_lama);

		$waktu = $this->input->post('waktu');
		if ($waktu == "A") {
			date_add($date, date_interval_create_from_date_string('1 hours'));
			$wktu = date_format($date, 'Y-m-d H:i:s'); //1 jam kedepan
			$paket = "Tambah : 1 Jam";
		} else if ($waktu == "B") {
			date_add($date, date_interval_create_from_date_string('1 hours  30 minute'));
			$wktu = date_format($date, 'Y-m-d H:i:s'); //1.5 jam kedepan
			$paket = "Tambah : 1.5 Jam";
		} else if ($waktu == "C") {
			date_add($date, date_interval_create_from_date_string('2 hours'));
			$wktu = date_format($date, 'Y-m-d H:i:s'); //2 jam kedepan
			$paket = "Tambah : 2 Jam";
		} else if ($waktu == "D") {
			date_add($date, date_interval_create_from_date_string('2 hours  30 minute'));
			$wktu = date_format($date, 'Y-m-d H:i:s'); //2.5 jam kedepan
			$paket = "Tambah : 2.5 Jam";
		} else if ($waktu == "E") {
			date_add($date, date_interval_create_from_date_string('3 hours'));
			$wktu = date_format($date, 'Y-m-d H:i:s'); //3 jam kedepan
			$paket = "Tambah : 3 Jam";
		} else if ($waktu == "F") {
			date_add($date, date_interval_create_from_date_string('3 hours  30 minute'));
			$wktu = date_format($date, 'Y-m-d H:i:s'); //3.5 jam kedepan
			$paket = "Tambah : 3.5 Jam";
		} else if ($waktu == "G") {
			date_add($date, date_interval_create_from_date_string('4 hours'));
			$wktu = date_format($date, 'Y-m-d H:i:s'); //4 jam kedepan
			$paket = "Tambah : 4 Jam";
		} else if ($waktu == "H") {
			date_add($date, date_interval_create_from_date_string('30 minute'));
			$wktu = date_format($date, 'Y-m-d H:i:s'); //30 Menit kedepan
			$paket = "Tambah : 30 Menit";
		} else if ($waktu == "") {
			$wktu = "";
			$paket = "Tambah : 0 Jam";
			$this->session->set_flashdata('notiff', '<div class="alert alert-danger" role="alert">"GAGAL TAMBAH" <br>Pastikan paket yang anda pilih sudah benar</div>');
			redirect('welcome');
		}

		$data = [
			'stop' => $wktu,
		];
		$this->db->where('id_sewa', $id_sw);
		$this->db->update('tb_sewa', $data);

		$data2 = [
			'paket' => $paket,
		];
		$this->db->where('id_paket', $id_pk);
		$this->db->update('tb_paket', $data2);
		redirect('welcome');
	}

	public function hapus_start()
	{
		$id_pk = $this->input->post('id_pk');
		if ($id_pk == "KO") {
		} else {
			$this->db->where('id_paket', $id_pk);
			$this->db->delete('tb_paket');
		}

		$id_sw = $this->input->post('id_sw');
		$this->db->where('id_sewa', $id_sw);
		$this->db->delete('tb_sewa');

		$id_mm = $this->input->post('id_mm');
		$this->db->where('id_member', $id_mm);
		$this->db->delete('tb_member');

		$id_ch = $this->input->post('id_ch');
		$data = [
			'status' => 'N'
		];
		$this->db->where('id_chanel', $id_ch);
		$ss = $this->db->update('tb_chanel', $data);

		echo json_encode($ss);
	}

	public function stop()
	{
		date_default_timezone_set('Asia/Jakarta');
		$a = $this->input->post('id_ch');
		$b = $this->input->post('id_mm');
		$c = $this->input->post('id_sw');
		$id_pk = $this->input->post('id_pk');
		$id_hpk = $this->input->post('id_hpk');
		if ($id_pk == "KO") {
			$data = [
				'stop' => date('Y-m-d H-i-s'),
				'aktif' => 'OFF'
			];
			$this->db->where('id_sewa', $c);
			$this->db->update('tb_sewa', $data);
		} else {
			$data = [
				'aktif' => 'OFF'
			];
			$this->db->where('id_sewa', $c);
			$this->db->update('tb_sewa', $data);
		}


		if ($id_hpk == "KO") {
		} else {
			$this->db->where('id_paket', $id_hpk);
			$this->db->delete('tb_paket');
		}

		$data2 = [
			'status' => 'Y'
		];
		$this->db->where('id_member', $b);
		$this->db->update('tb_member', $data2);

		$data3 = [
			'status' => 'N'
		];
		$this->db->where('id_chanel', $a);
		$ss = $this->db->update('tb_chanel', $data3);
		echo json_encode($ss);
	}

	public function hitung_sewa()
	{
		date_default_timezone_set('Asia/Jakarta');
		$cek = $this->m_sewa->live_member();


		if (!empty($cek)) { // Jika data sewa ada/ditemukan

			$awal  = date_create($cek->start);
			$akhir = date_create($cek->stop); // waktu sekarang
			$diff  = date_diff($awal, $akhir);
			$thn = $diff->y . ' Tahun, ';
			$bln = $diff->m . ' Bulan, ';
			$hr = $diff->d . ' Hari, ';
			$t = $diff->y;
			$b = $diff->m;
			$h = $diff->d;
			$jamm =  $diff->h;
			$mnt =  $diff->i;
			$dtk =  $diff->s;

			$waktu_awal        = strtotime($cek->start);
			$waktu_akhir    = strtotime($cek->stop);
			//menghitung selisih dengan hasil detik
			$diff    = $waktu_akhir - $waktu_awal;
			//membagi detik menjadi jam
			// $hari = floor($diff / (60 * 60 * 24));

			// $jam    = floor($diff / (60 * 60));

			// $menit2 = $diff - $jam * (60 * 60);
			$menit = floor($diff / 60);
			// $detik = floor($menit / 60);

			$sql = "SELECT * FROM tb_harga";
			$w = $this->db->query($sql)->row();

			$total = ($menit / $w->menit) * $w->harga;




			if ($t > 0) {
				$thn1 = $thn;
			} else {
				$thn1 = "";
			}

			if ($b > 0) {
				$bln1 = $bln;
			} else {
				$bln1 = "";
			}

			if ($h > 0) {
				$hr1 = $hr;
			} else {
				$hr1 = "";
			}

			if ($jamm >= 10) {
				$jamm1 = $jamm;
			} else {
				$jamm1 = "0" . $jamm;
			}

			if ($mnt >= 10) {
				$mnt1 = $mnt;
			} else {
				$mnt1 = "0" . $mnt;
			}

			if ($dtk >= 10) {
				$dtk1 = $dtk;
			} else {
				$dtk1 = "0" . $dtk;
			}

			$tl_rp = "Rp. " . number_format($total, 0, ",", ".");

			$penjualan = $this->db->query("SELECT * FROM tb_penjualan WHERE kode_penjualan='$cek->kode'");
			$penjualan2 = $this->db->query("SELECT kode_penjualan,jml, SUM(jml) as jml FROM tb_penjualan WHERE kode_penjualan='$cek->kode'");
			$pen = $penjualan->num_rows();
			$p = $penjualan2->row();
			if ($pen > 0) {
				$tl_pj = "Rp. " . number_format($p->jml, 0, ",", ".");
				$sub_tl = $total + $p->jml;
				$sub_tl_pj = "Rp. " . number_format($sub_tl, 0, ",", ".");
			} else {
				$tl_pj = "Rp. 0";
				$sub_tl = $total;
				$sub_tl_pj = $tl_rp;
			}

			// $timestampg =  date($j . ':' . $m . ':' . $d);
			// $timestampg = $jamm1 .  ":" . $mnt1 . ":" . $dtk1;
			$timestampg = $thn1 . $bln1 . $hr1 .  $jamm1 .  ":" . $mnt1 . ":" . $dtk1;

			// $time1 = date('H:i:s', strtotime($cek->start));
			// $time2 = date('H:i:s', strtotime($cek->stop));
			// Buat sebuah array
			$callback = array(
				'status' => 'success', // Set array status dengan success
				'id_member' => $cek->id_member,
				'id_sewa' => $cek->id_sewa,
				'nama' => $cek->nama,
				'tl_rp' => $tl_rp,
				'total' => $sub_tl,
				'lama' => $timestampg,
				'tl_pj' => $tl_pj,
				'sub_tl_pj' => $sub_tl_pj,
			);
		} else {
			$callback = array('status' => 'failed'); // set array status dengan failed
		}
		echo json_encode($callback);
	}



	public function bayar()
	{
		$data = [
			'total' => $this->input->post('total'),
			'dibayar' => $this->input->post('bayar'),
			'status' => 'T',
		];
		$id_mm = $this->input->post('id_m');
		$this->db->where('id_member', $id_mm);
		$this->db->update('tb_member', $data);

		$data2 = [
			'lama_sewa' => $this->input->post('sewa')
		];
		$id_s = $this->input->post('id_s');
		$this->db->where('id_sewa', $id_s);
		$this->db->update('tb_sewa', $data2);

		$this->session->set_flashdata('test', '<div class="alert alert-success" role="alert">Pembayaran berhasil tersimpan</div>');
		redirect('welcome');
	}

	public function edit_end()
	{
		$b = $this->input->post('id');
		$data2 = [
			'status' => 'Y'
		];
		$this->db->where('id_member', $b);
		$ss = $this->db->update('tb_member', $data2);

		echo json_encode($ss);
	}

	public function hapus_end()
	{
		$id_pk = $this->input->post('id_p');
		if ($id_pk == "KO") {
		} else {
			$this->db->where('id_paket', $id_pk);
			$this->db->delete('tb_paket');
		}
		$id_sw = $this->input->post('id_s');
		$this->db->where('id_sewa', $id_sw);
		$this->db->delete('tb_sewa');

		$id_mm = $this->input->post('id_m');
		$this->db->where('id_member', $id_mm);
		$this->db->delete('tb_member');

		$kode = $this->input->post('kd');
		$penjualan = $this->db->query("SELECT * FROM tb_penjualan WHERE kode_penjualan='$kode'");
		$cek = $penjualan->num_rows();
		$arry = $penjualan->result();
		if ($cek > 0) {
			foreach ($arry as $d) {
				$id = $d->id_penjualan;
				$this->db->where('id_penjualan', $id);
				$this->db->delete('tb_penjualan');
			}

			$ss = "ok";
			echo json_encode($ss);
		} else {
			$ss = "ok";
			echo json_encode($ss);
		}
	}

	public function penjualan()
	{

		$this->form_validation->set_rules('kode_member', 'Kode', 'required|trim', ['required' => 'Form harus diisi']);
		$this->form_validation->set_rules('jenis', 'Jenis', 'required|trim', ['required' => 'Form harus diisi']);
		$this->form_validation->set_rules('jml_ttl', 'Jumlah', 'required|trim', ['required' => 'Form harus diisi']);
		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('pjl', '<div class="alert alert-danger" role="alert">Gagal tersimpan</div>');
			redirect('welcome');
		} else {
			date_default_timezone_set('Asia/Jakarta');
			$data = [
				'kode_penjualan' => $this->input->post('kode_member'),
				'jenis' => $this->input->post('jenis'),
				'jml' => $this->input->post('jml_ttl'),
				'tgl' => date('Y-m-d')
			];
			$this->db->insert('tb_penjualan', $data);
			$this->session->set_flashdata('pjl', '<div class="alert alert-success" role="alert">Penjualan berhasil tersimpan</div>');
			redirect('welcome');
		}
	}

	public function edit_penjualan()
	{
		$id = $this->input->post('id');
		$data = [
			'kode_penjualan' => $this->input->post('kode_member'),
			'jenis' => $this->input->post('jenis'),
			'jml' => $this->input->post('jml'),
		];
		$this->db->where('id_penjualan', $id);
		$this->db->update('tb_penjualan', $data);
		$this->session->set_flashdata('pjl', '<div class="alert alert-success" role="alert">Edit Data Penjualan berhasil tersimpan</div>');
		redirect('welcome');
	}

	public function hapus_pjl()
	{
		$id = $this->input->post('id');
		$this->db->where('id_penjualan', $id);
		$ss = $this->db->delete('tb_penjualan');
		echo json_encode($ss);
	}

	public function error_404()
	{
		$data = [
			'title' => 'PlayStation | Error',
			'Menu' => 'onch',
			'activeMenu' => 'error',
			'log' => $this->m_master->user_login(),
			'ch' => $this->m_master->live_chanel()->result(),
			'hrg' => $this->m_master->live_harga()->result(),
			'ol' => $this->m_sewa->live_online()->result(),
			'byy' => $this->m_sewa->live_bayar()->result(),
		];
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar');
		$this->load->view('template/navbar');
		$this->load->view('template/error_404');
		$this->load->view('template/footer');
	}
}
