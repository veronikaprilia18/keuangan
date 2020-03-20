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
}
