<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //load model admin
        $this->load->model('admin');
        $this->load->model('anggaran');
        $this->load->model('klien');
        $this->load->model('pos');
        $this->load->model('user');
        $this->load->library('form_validation');
    }

    // fungsi data master KLIEN
    function klien()
    {
        //load the view
        $data['klien'] = $this->klien->getAll();
        $this->load->view('headfoot/header');
        $this->load->view('klien/list-klien', $data);
        $this->load->view('headfoot/footer');
    }

    function tambah_klien()
    {
        $this->load->view('headfoot/header');
        $this->load->view('klien/input-data-klien');
        $this->load->view('headfoot/footer');
    }

    function input_klien_proses()
    {
        $idKlien = $this->input->post('klien');
        $namaPerusahaan = $this->input->post('nama_perusahaan');
        $namaKlien = $this->input->post('nama_klien');
        $alamatKlien = $this->input->post('alamat_klien');
        $emailKlien = $this->input->post('email_klien');
        $teleponKlien = $this->input->post('telepon_klien');

        $dataInsertKlien = [
            'id_klien' => $idKlien,
            'nama_perusahaan' => $namaPerusahaan,
            'nama_klien' => $namaKlien,
            'alamat_klien' => $alamatKlien,
            'email_klien' => $emailKlien,
            'telepon_klien' => $teleponKlien,
        ];

        $this->klien->insertData('tbl_klien', $dataInsertKlien);

        redirect('master/klien');
    }

    function edit_klien($idKlien)
    {
        $data['klien'] = $this->klien->getById($idKlien);
        $this->load->view('headfoot/header');
        $this->load->view('klien/edit-data-klien', $data);
        $this->load->view('headfoot/footer');
    }

    function update_klien($idKlien)
    {
        $namaPerusahaan = $this->input->post('nama_perusahaan');
        $namaKlien = $this->input->post('nama_klien');
        $alamatKlien = $this->input->post('alamat_klien');
        $emailKlien = $this->input->post('email_klien');
        $teleponKlien = $this->input->post('telepon_klien');

        $dataUpdateKlien = [
            'nama_perusahaan' => $namaPerusahaan,
            'nama_klien' => $namaKlien,
            'alamat_klien' => $alamatKlien,
            'email_klien' => $emailKlien,
            'telepon_klien' => $teleponKlien,
        ];

        $where = ['id_klien' => $idKlien];
        $this->klien->updateData('tbl_klien', $dataUpdateKlien, $where);

        redirect('master/klien');
    }

    function delete_klien($idKlien)
    {
        $where = ['id_klien' => $idKlien];
        $this->klien->deleteData('tbl_klien', $where);
        redirect('master/klien');
    }

    // fungsi data master POS
    function pos()
    {
        //load the view
        $data['pos'] = $this->pos->getAll();
        $this->load->view('headfoot/header');
        $this->load->view('pos/list-pos', $data);
        $this->load->view('headfoot/footer');
    }

    function tambah_pos()
    {
        $this->load->view('headfoot/header');
        $this->load->view('pos/input-data-pos');
        $this->load->view('headfoot/footer');
    }

    function input_pos_proses()
    {
        $idPos = $this->input->post('id_pos');
        $idKategori = $this->input->post('id_kategori');
        $namaPos = $this->input->post('nama_pos');

        $dataInsertPos = [
            'id_pos' => $idPos,
            'id_kategori' => $idKategori,
            'nama_pos' => $namaPos,
        ];

        $this->pos->insertData('tbl_pos', $dataInsertPos);

        redirect('master/pos');
    }

    function edit_pos($idPos)
    {
        $data['pos'] = $this->pos->getById($idPos);
        $this->load->view('headfoot/header');
        $this->load->view('pos/edit-data-pos', $data);
        $this->load->view('headfoot/footer');
    }

    function update_pos($idPos)
    {
        $idPos = $this->input->post('id_pos');
        $idKategori = $this->input->post('id_kategori');
        $namaPos = $this->input->post('nama_pos');

        $dataUpdatePos = [
            'id_pos' => $idPos,
            'id_kategori' => $idKategori,
            'nama_pos' => $namaPos,
        ];

        $where = ['id_pos' => $idPos];
        $this->pos->updateData('tbl_pos', $dataUpdatePos, $where);

        redirect('master/pos');
    }

    function delete_pos($idPos)
    {
        $where = ['id_pos' => $idPos];
        $this->pos->deleteData('tbl_pos', $where);
        redirect('master/pos');
    }

    // fungsi data master USER
    function user()
    {
        //load the view
        $data['user'] = $this->user->getAll();
        $this->load->view('headfoot/header');
        $this->load->view('user/list-user', $data);
        $this->load->view('headfoot/footer');
    }

    function tambah_user()
    {
        $this->load->view('headfoot/header');
        $this->load->view('user/input-data-user');
        $this->load->view('headfoot/footer');
    }

    function input_user_proses()
    {
        $idUser = $this->input->post('user');
        $idPeran = $this->input->post('id_peran');
        $namaUser = $this->input->post('nama_user');
        $teleponUser = $this->input->post('telepon_user');
        $gajiUser = $this->input->post('gaji_user');

        $dataInsertUser = [
            'id_user' => $idUser,
            'id_peran' => $idPeran,
            'nama_user' => $namaUser,
            'telepon_user' => $teleponUser,
            'gaji_user' => $gajiUser,
        ];

        $this->user->insertData('tbl_user', $dataInsertUser);

        redirect('master/user');
    }

    function edit_user($idUser)
    {
        $data['user'] = $this->user->getById($idUser);
        $this->load->view('headfoot/header');
        $this->load->view('user/edit-data-user', $data);
        $this->load->view('headfoot/footer');
    }

    function update_user($idUser)
    {
        $idUser = $this->input->post('user');
        $idPeran = $this->input->post('id_peran');
        $namaUser = $this->input->post('nama_user');
        $teleponUser = $this->input->post('telepon_user');
        $gajiUser = $this->input->post('gaji_user');

        $dataUpdateUser = [
            'id_user' => $idUser,
            'id_peran' => $idPeran,
            'nama_user' => $namaUser,
            'telepon_user' => $teleponUser,
            'gaji_user' => $gajiUser,
        ];

        $where = ['id_user' => $idUser];
        $this->user->updateData('tbl_user', $dataUpdateUser, $where);

        redirect('master/user');
    }

    function delete_user($idUser)
    {
        $where = ['id_user' => $idUser];
        $this->user->deleteData('tbl_user', $where);
        redirect('master/user');
    }
}

/* End of file Controllername.php */
