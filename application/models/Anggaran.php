<?php



defined('BASEPATH') or exit('No direct script access allowed');

class Anggaran extends CI_Model
{
    public function getAll()
    {
        return $this->db->get("tbl_anggaran")->result();
    }

    public function getById($id)
    {
        return $this->db->get_where("tbl_anggaran", ["id_anggaran" => $id])->row();
    }

    function getBulan()
    {
        return $this->db->query("SELECT * FROM tbl_bulan ");
    }

    function getPos($idKategori)
    {
        return $this->db->query("SELECT * FROM tbl_pos WHERE id_kategori='$idKategori'");
    }

    function insertData($tableName, $data)
    {
        $this->db->insert($tableName, $data);
        return $this->db->affected_rows();
    }

    function updateData($tableName, $data, $where)
    {
        $this->db->where($where);
        $this->db->update($tableName, $data);
        return $this->db->affected_rows();
    }

    function deleteData($tableName, $where)
    {
        $this->db->where($where);
        $this->db->delete($tableName);

        return $this->db->affected_rows();
    }

    function listAdministration()
    {
        return $this->db->query("SELECT * FROM `tbl_anggaran` LEFT JOIN tbl_klien ON tbl_anggaran.id_klien=tbl_klien.id_klien
        LEFT JOIN tbl_bulan ON tbl_anggaran.id_bulan=tbl_bulan.id_bulan
        LEFT JOIN tbl_detail_anggaran ON tbl_anggaran.id_anggaran=tbl_detail_anggaran.id_anggaran
        LEFT JOIN tbl_pos ON tbl_detail_anggaran.id_pos=tbl_pos.id_pos
        LEFT JOIN tbl_kategori ON tbl_pos.id_kategori=tbl_kategori.id_kategori
        WHERE tbl_kategori.id_kategori='1'");
    }

    function summaryAdministration()
    {
        return $this->db->query("SELECT * FROM tbl_anggaran INNER JOIN tbl_klien ON tbl_anggaran.id_klien=tbl_klien.id_klien GROUP BY tahun
        ");
    }

    function listProduction()
    {
        return $this->db->query("SELECT * FROM `tbl_anggaran` LEFT JOIN tbl_klien ON tbl_anggaran.id_klien=tbl_klien.id_klien
        LEFT JOIN tbl_bulan ON tbl_anggaran.id_bulan=tbl_bulan.id_bulan
        LEFT JOIN tbl_detail_anggaran ON tbl_anggaran.id_anggaran=tbl_detail_anggaran.id_anggaran
        LEFT JOIN tbl_pos ON tbl_detail_anggaran.id_pos=tbl_pos.id_pos
        LEFT JOIN tbl_kategori ON tbl_pos.id_kategori=tbl_kategori.id_kategori
        WHERE tbl_kategori.id_kategori='1'");
    }

    function summaryProduction()
    {
        return $this->db->query("SELECT * FROM tbl_anggaran INNER JOIN tbl_klien ON tbl_anggaran.id_klien=tbl_klien.id_klien GROUP BY tahun
        ");
    }

    function listHardware()
    {
        return $this->db->query("SELECT * FROM `tbl_anggaran` LEFT JOIN tbl_klien ON tbl_anggaran.id_klien=tbl_klien.id_klien
        LEFT JOIN tbl_bulan ON tbl_anggaran.id_bulan=tbl_bulan.id_bulan
        LEFT JOIN tbl_detail_anggaran ON tbl_anggaran.id_anggaran=tbl_detail_anggaran.id_anggaran
        LEFT JOIN tbl_pos ON tbl_detail_anggaran.id_pos=tbl_pos.id_pos
        LEFT JOIN tbl_kategori ON tbl_pos.id_kategori=tbl_kategori.id_kategori
        WHERE tbl_kategori.id_kategori='1'");
    }

    function summaryHardware()
    {
        return $this->db->query("SELECT * FROM tbl_anggaran INNER JOIN tbl_klien ON tbl_anggaran.id_klien=tbl_klien.id_klien GROUP BY tahun
        ");
    }

    function listMaintenance()
    {
        return $this->db->query("SELECT * FROM `tbl_anggaran` LEFT JOIN tbl_klien ON tbl_anggaran.id_klien=tbl_klien.id_klien
        LEFT JOIN tbl_bulan ON tbl_anggaran.id_bulan=tbl_bulan.id_bulan
        LEFT JOIN tbl_detail_anggaran ON tbl_anggaran.id_anggaran=tbl_detail_anggaran.id_anggaran
        LEFT JOIN tbl_pos ON tbl_detail_anggaran.id_pos=tbl_pos.id_pos
        LEFT JOIN tbl_kategori ON tbl_pos.id_kategori=tbl_kategori.id_kategori
        WHERE tbl_kategori.id_kategori='1'");
    }

    function summaryMaintenance()
    {
        return $this->db->query("SELECT * FROM tbl_anggaran INNER JOIN tbl_klien ON tbl_anggaran.id_klien=tbl_klien.id_klien GROUP BY tahun
        ");
    }
}
