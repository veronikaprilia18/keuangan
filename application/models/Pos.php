<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Pos extends CI_Model
{
    public function getAll()
    {
        return $this->db->get("tbl_pos")->result();
    }

    public function getById($id)
    {
        return $this->db->get_where("tbl_pos", ["id_pos" => $id])->row();
    }

    function getPos()
    {
        return $this->db->query("SELECT * FROM tbl_pos");
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

/* End of file ModelName.php */
