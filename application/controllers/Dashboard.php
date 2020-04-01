<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//load model admin
		// $this->load->model('admin');
		// $this->load->model('anggaran');
		// $this->load->model('klien');
		// $this->load->library('form_validation');
	}

	public function index()
	{
		if ($this->admin->logged_id()) {

			$this->load->view('headfoot/header');
			$this->load->view("dashboard");
			$this->load->view('headfoot/footer');
		} else {

			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}

	function administration()
	{
		//load the view
		$data['anggaran'] = $this->anggaran->summaryAdministration()->result();
		$data['bulan'] = $this->anggaran->getBulan()->result();
		$data['pos'] = $this->anggaran->getPos(1)->result();
		$this->load->view('headfoot/header');
		$this->load->view('administration/list-data', $data);
		$this->load->view('headfoot/footer');
	}

	function tambah_admin()
	{
		$data['bulan'] = $this->anggaran->getBulan()->result();
		$data['pos'] = $this->anggaran->getPos(1)->result();
		$data['klien'] = $this->klien->getKlien()->result();
		$this->load->view('headfoot/header');
		$this->load->view('administration/input-data', $data);
		$this->load->view('headfoot/footer');
	}

	function input_admin_proses()
	{
		$idKlien = $this->input->post('klien');
		$tahun = $this->input->post('tahun-anggaran');
		$bulan = $this->input->post('bulan-anggaran');
		$idAnggaran = $this->input->post('id_anggaran');

		//detail anggaran
		$pos = $this->input->post('pos-anggaran');
		$uraian = $this->input->post('uraian');
		$volume = $this->input->post('volume');
		$satuan = $this->input->post('satuan');
		$hargaSatuan = $this->input->post('harga-satuan');
		$pengeluaran = $this->input->post('pengeluaran');

		$dataInsertAnggaran = [
			'id_anggaran' => $idAnggaran,
			'id_klien' => $idKlien,
			'id_bulan' => $bulan,
			'tahun' => $tahun,

		];

		foreach ($uraian as $key => $value) {

			$dataInsertDetail = [
				'id_anggaran' => $idAnggaran,
				'id_pos' => $pos,
				'uraian' => $value,
				'volume' => $volume[$key],
				'satuan' => $satuan[$key],
				'harga_satuan' => $hargaSatuan[$key],
				'pengeluaran' => $pengeluaran[$key],
			];

			$this->anggaran->insertData('tbl_detail_anggaran', $dataInsertDetail);
		}

		$this->anggaran->insertData('tbl_anggaran', $dataInsertAnggaran);

		redirect('dashboard/administration');
	}

	function edit_admin()
	{
		$idAnggaran = $this->input->get('id-anggaran');
		$data['bulan'] = $this->anggaran->getBulan()->result();
		$data['pos'] = $this->anggaran->getPos(1)->result();
		$data['klien'] = $this->klien->getKlien()->result();
		$data['anggaran'] = $this->anggaran->getAdministrationById($idAnggaran);
		// echo "SELECT * FROM tbl_anggaran INNER JOIN tbl_detail_anggaran ON tbl_anggaran.id_anggaran=tbl_detail_anggaran.id_anggaran 
		// INNER JOIN tbl_klien ON tbl_anggaran.id_klien=tbl_klien.id_klien 
		// WHERE tbl_anggaran.id_anggaran='$idAnggaran'";
		$this->load->view('headfoot/header');
		$this->load->view('administration/edit-data', $data);
		$this->load->view('headfoot/footer');
	}

	function update_admin()
	{
		//detail anggaran
		$idDetail = $this->input->post('id_detail');
		$uraian = $this->input->post('uraian');
		$volume = $this->input->post('volume');
		$satuan = $this->input->post('satuan');
		$hargaSatuan = $this->input->post('harga-satuan');
		$pengeluaran = $this->input->post('pengeluaran');

		foreach ($uraian as $key => $value) {

			$dataInsertDetail = [
				'uraian' => $value,
				'volume' => $volume[$key],
				'satuan' => $satuan[$key],
				'harga_satuan' => $hargaSatuan[$key],
				'pengeluaran' => $pengeluaran[$key],
			];

			$where = ['id_detail_anggaran' => $idDetail[$key]];

			$this->anggaran->updateData('tbl_detail_anggaran', $dataInsertDetail, $where);
		}
		redirect('dashboard/administration');
	}

	function detail_data_admin()
	{
		$this->load->view('headfoot/header');
		$data['bulan'] = $this->anggaran->getBulan()->result();
		$this->load->view('administration/detail-data');
		$this->load->view('headfoot/footer');
	}

	function update_klien($idKlien)
	{
		$idKlien = $this->input->post('klien');
		$tahun = $this->input->post('tahun-anggaran');
		$bulan = $this->input->post('bulan-anggaran');


		//detail anggaran
		$pos = $this->input->post('pos-anggaran');
		$uraian = $this->input->post('uraian');
		$volume = $this->input->post('volume');
		$satuan = $this->input->post('satuan');
		$hargaSatuan = $this->input->post('harga-satuan');
		$pengeluaran = $this->input->post('pengeluaran');

		$dataUpdateAnggaran = [
			'id_klien' => $idKlien,
			'id_bulan' => $bulan,
			'tahun' => $tahun,

		];

		$dataUpdateDetail = [
			'id_pos' => $pos,
			'uraian' => $uraian,
			'volume' => $volume,
			'satuan' => $satuan,
			'harga_satuan' => $hargaSatuan,
			'pengeluaran' => $pengeluaran,
		];

		$where = ['id_klien' => $idKlien];
		$this->anggaran->updateData('tbl_anggaran', $dataUpdateAnggaran, $where);
		$this->anggaran->updateData('tbl_detail_anggaran', $dataUpdateDetail, $where);

		redirect('dashboard/administration');
	}

	function delete_admin($idKlien)
	{
		$where = ['id_klien' => $idKlien];
		$this->klien->deleteData('tbl_anggaran', $where);
		redirect('dashboard/administration');
	}

	function production()
	{
		//load the view
		$data['anggaran'] = $this->anggaran->summaryProduction()->result();
		$this->load->view('headfoot/header');
		$this->load->view('production/list-data', $data);
		$this->load->view('headfoot/footer');
	}

	function tambah_production()
	{
		$data['bulan'] = $this->anggaran->getBulan()->result();
		$data['pos'] = $this->anggaran->getPos(1)->result();
		$data['klien'] = $this->klien->getKlien()->result();
		$this->load->view('headfoot/header');
		$this->load->view('production/input-data', $data);
		$this->load->view('headfoot/footer');
	}

	function input_production_proses()
	{
		$idKlien = $this->input->post('klien');
		$tahun = $this->input->post('tahun-anggaran');
		$bulan = $this->input->post('bulan-anggaran');
		$idAnggaran = $this->input->post('id_anggaran');

		//detail anggaran
		$pos = $this->input->post('pos-anggaran');
		$uraian = $this->input->post('uraian');
		$volume = $this->input->post('volume');
		$satuan = $this->input->post('satuan');
		$hargaSatuan = $this->input->post('harga-satuan');
		$pengeluaran = $this->input->post('pengeluaran');

		$dataInsertAnggaran = [
			'id_anggaran' => $idAnggaran,
			'id_klien' => $idKlien,
			'id_bulan' => $bulan,
			'tahun' => $tahun,

		];

		foreach ($uraian as $key => $value) {

			$dataInsertDetail = [
				'id_anggaran' => $idAnggaran,
				'id_pos' => $pos,
				'uraian' => $value,
				'volume' => $volume[$key],
				'satuan' => $satuan[$key],
				'harga_satuan' => $hargaSatuan[$key],
				'pengeluaran' => $pengeluaran[$key],
			];

			$this->anggaran->insertData('tbl_detail_anggaran', $dataInsertDetail);
		}

		$this->anggaran->insertData('tbl_anggaran', $dataInsertAnggaran);

		redirect('dashboard/production');
	}

	function edit_production($idAnggaran)
	{
		$data['anggaran'] = $this->anggaran->getById($idAnggaran);
		$this->load->view('headfoot/header');
		$this->load->view('production/edit-data', $data);
		$this->load->view('headfoot/footer');
	}

	function detail_data_production()
	{
		$this->load->view('headfoot/header');
		$this->load->view('production/detail-data');
		$this->load->view('headfoot/footer');
	}

	function update_production($idKlien)
	{
		$idKlien = $this->input->post('klien');
		$tahun = $this->input->post('tahun-anggaran');
		$bulan = $this->input->post('bulan-anggaran');


		//detail anggaran
		$pos = $this->input->post('pos-anggaran');
		$uraian = $this->input->post('uraian');
		$volume = $this->input->post('volume');
		$satuan = $this->input->post('satuan');
		$hargaSatuan = $this->input->post('harga-satuan');
		$pengeluaran = $this->input->post('pengeluaran');

		$dataUpdateAnggaran = [
			'id_klien' => $idKlien,
			'id_bulan' => $bulan,
			'tahun' => $tahun,

		];

		$dataUpdateDetail = [
			'id_pos' => $pos,
			'uraian' => $uraian,
			'volume' => $volume,
			'satuan' => $satuan,
			'harga_satuan' => $hargaSatuan,
			'pengeluaran' => $pengeluaran,
		];

		$where = ['id_klien' => $idKlien];
		$this->anggaran->updateData('tbl_anggaran', $dataUpdateAnggaran, $where);
		$this->anggaran->updateData('tbl_detail_anggaran', $dataUpdateDetail, $where);

		redirect('dashboard/production');
	}

	function delete_production($idKlien)
	{
		$where = ['id_klien' => $idKlien];
		$this->klien->deleteData('tbl_anggaran', $where);
		redirect('dashboard/production');
	}

	function hardware()
	{
		//load the view
		$data['anggaran'] = $this->anggaran->summaryHardware()->result();
		$this->load->view('headfoot/header');
		$this->load->view('hardware/list-data', $data);
		$this->load->view('headfoot/footer');
	}

	function tambah_hardware()
	{
		$data['bulan'] = $this->anggaran->getBulan()->result();
		$data['pos'] = $this->anggaran->getPos(1)->result();
		$data['klien'] = $this->klien->getKlien()->result();
		$this->load->view('headfoot/header');
		$this->load->view('hardware/input-data', $data);
		$this->load->view('headfoot/footer');
	}

	function input_hardware_proses()
	{
		$idKlien = $this->input->post('klien');
		$tahun = $this->input->post('tahun-anggaran');
		$bulan = $this->input->post('bulan-anggaran');
		$idAnggaran = $this->input->post('id_anggaran');

		//detail anggaran
		$pos = $this->input->post('pos-anggaran');
		$uraian = $this->input->post('uraian');
		$volume = $this->input->post('volume');
		$satuan = $this->input->post('satuan');
		$hargaSatuan = $this->input->post('harga-satuan');
		$pengeluaran = $this->input->post('pengeluaran');

		$dataInsertAnggaran = [
			'id_anggaran' => $idAnggaran,
			'id_klien' => $idKlien,
			'id_bulan' => $bulan,
			'tahun' => $tahun,

		];

		foreach ($uraian as $key => $value) {

			$dataInsertDetail = [
				'id_anggaran' => $idAnggaran,
				'id_pos' => $pos,
				'uraian' => $value,
				'volume' => $volume[$key],
				'satuan' => $satuan[$key],
				'harga_satuan' => $hargaSatuan[$key],
				'pengeluaran' => $pengeluaran[$key],
			];

			$this->anggaran->insertData('tbl_detail_anggaran', $dataInsertDetail);
		}

		$this->anggaran->insertData('tbl_anggaran', $dataInsertAnggaran);

		redirect('dashboard/hardware');
	}

	function edit_hardware($idAnggaran)
	{
		$data['anggaran'] = $this->anggaran->getById($idAnggaran);
		$this->load->view('headfoot/header');
		$this->load->view('hardware/edit-data', $data);
		$this->load->view('headfoot/footer');
	}

	function detail_data_hardware()
	{
		$this->load->view('headfoot/header');
		$this->load->view('hardware/detail-data');
		$this->load->view('headfoot/footer');
	}

	function update_hardware($idKlien)
	{
		$idKlien = $this->input->post('klien');
		$tahun = $this->input->post('tahun-anggaran');
		$bulan = $this->input->post('bulan-anggaran');


		//detail anggaran
		$pos = $this->input->post('pos-anggaran');
		$uraian = $this->input->post('uraian');
		$volume = $this->input->post('volume');
		$satuan = $this->input->post('satuan');
		$hargaSatuan = $this->input->post('harga-satuan');
		$pengeluaran = $this->input->post('pengeluaran');

		$dataUpdateAnggaran = [
			'id_klien' => $idKlien,
			'id_bulan' => $bulan,
			'tahun' => $tahun,

		];

		$dataUpdateDetail = [
			'id_pos' => $pos,
			'uraian' => $uraian,
			'volume' => $volume,
			'satuan' => $satuan,
			'harga_satuan' => $hargaSatuan,
			'pengeluaran' => $pengeluaran,
		];

		$where = ['id_klien' => $idKlien];
		$this->anggaran->updateData('tbl_anggaran', $dataUpdateAnggaran, $where);
		$this->anggaran->updateData('tbl_detail_anggaran', $dataUpdateDetail, $where);

		redirect('dashboard/hardware');
	}

	function delete_hardware($idKlien)
	{
		$where = ['id_klien' => $idKlien];
		$this->klien->deleteData('tbl_anggaran', $where);
		redirect('dashboard/hardware');
	}

	function maintenance()
	{
		//load the view
		$data['anggaran'] = $this->anggaran->summaryAdministration()->result();
		$this->load->view('headfoot/header');
		$this->load->view('maintenance/list-data', $data);
		$this->load->view('headfoot/footer');
	}

	function tambah_maintenance()
	{
		$data['bulan'] = $this->anggaran->getBulan()->result();
		$data['pos'] = $this->anggaran->getPos(1)->result();
		$data['klien'] = $this->klien->getKlien()->result();
		$this->load->view('headfoot/header');
		$this->load->view('maintenance/input-data', $data);
		$this->load->view('headfoot/footer');
	}

	function input_maintenance_proses()
	{
		$idKlien = $this->input->post('klien');
		$tahun = $this->input->post('tahun-anggaran');
		$bulan = $this->input->post('bulan-anggaran');
		$idAnggaran = $this->input->post('id_anggaran');

		//detail anggaran
		$pos = $this->input->post('pos-anggaran');
		$uraian = $this->input->post('uraian');
		$volume = $this->input->post('volume');
		$satuan = $this->input->post('satuan');
		$hargaSatuan = $this->input->post('harga-satuan');
		$pengeluaran = $this->input->post('pengeluaran');

		$dataInsertAnggaran = [
			'id_anggaran' => $idAnggaran,
			'id_klien' => $idKlien,
			'id_bulan' => $bulan,
			'tahun' => $tahun,

		];

		foreach ($uraian as $key => $value) {

			$dataInsertDetail = [
				'id_anggaran' => $idAnggaran,
				'id_pos' => $pos,
				'uraian' => $value,
				'volume' => $volume[$key],
				'satuan' => $satuan[$key],
				'harga_satuan' => $hargaSatuan[$key],
				'pengeluaran' => $pengeluaran[$key],
			];

			$this->anggaran->insertData('tbl_detail_anggaran', $dataInsertDetail);
		}

		$this->anggaran->insertData('tbl_anggaran', $dataInsertAnggaran);

		redirect('dashboard/maintenance');
	}

	function edit_maintenance($idAnggaran)
	{
		$data['anggaran'] = $this->anggaran->getById($idAnggaran);
		$this->load->view('headfoot/header');
		$this->load->view('maintenance/edit-data', $data);
		$this->load->view('headfoot/footer');
	}

	function detail_data_maintenance()
	{
		$this->load->view('headfoot/header');
		$this->load->view('maintenance/detail-data');
		$this->load->view('headfoot/footer');
	}

	function update_maintenance($idKlien)
	{
		$idKlien = $this->input->post('klien');
		$tahun = $this->input->post('tahun-anggaran');
		$bulan = $this->input->post('bulan-anggaran');


		//detail anggaran
		$pos = $this->input->post('pos-anggaran');
		$uraian = $this->input->post('uraian');
		$volume = $this->input->post('volume');
		$satuan = $this->input->post('satuan');
		$hargaSatuan = $this->input->post('harga-satuan');
		$pengeluaran = $this->input->post('pengeluaran');

		$dataUpdateAnggaran = [
			'id_klien' => $idKlien,
			'id_bulan' => $bulan,
			'tahun' => $tahun,

		];

		$dataUpdateDetail = [
			'id_pos' => $pos,
			'uraian' => $uraian,
			'volume' => $volume,
			'satuan' => $satuan,
			'harga_satuan' => $hargaSatuan,
			'pengeluaran' => $pengeluaran,
		];

		$where = ['id_klien' => $idKlien];
		$this->anggaran->updateData('tbl_anggaran', $dataUpdateAnggaran, $where);
		$this->anggaran->updateData('tbl_detail_anggaran', $dataUpdateDetail, $where);

		redirect('dashboard/maintenance');
	}

	function delete_maintenance($idKlien)
	{
		$where = ['id_klien' => $idKlien];
		$this->klien->deleteData('tbl_anggaran', $where);
		redirect('dashboard/maintenance');
	}
}
