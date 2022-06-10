<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *  File Name             : M_denda.php
 *  File Type             : Model
 *  File Package          : CI_Models
 ** * * * * * * * * * * * * * * * * * **
 *  Author                : Rizky Ardiansyah
 *  Date Created          : 09/06/2022
 *  Quots of the code     : 'sebuah code program bukanlah sebatas perintah-perintah yang ditulis di komputer, melainkan sebuah kesempatan berkomunikasi antara komputer dan manusia. (bagi yang tidak punya teman wkwk)'
 */
class M_denda extends CI_Model
{
    private $_table = 'm_denda';
    private $_field = '*';
    private $_limit = 10;
    private $_offset;
    private $_join_tbl = null;

    public function getData($where = null)
    {
        $this->db->select($this->_field);
        $this->db->from($this->_table);
        if ($where != null) {
            $this->db->where($where);
        }
        return $this->db->get();
    }

    public function insertData($data)
    {
        $this->db->insert($this->_table, $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function updateData($where, $data)
    {
        $this->db->where($where);
        $this->db->update($this->_table, $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function deleteData($where)
    {
        $this->db->where($where);
        $this->db->delete($this->_table);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
