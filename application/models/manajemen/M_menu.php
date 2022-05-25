<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *  File Name             : M_menu.php
 *  File Type             : Model
 *  File Package          : CI_Models
 ** * * * * * * * * * * * * * * * * * **
 *  Author                : Rizky Ardiansyah
 *  Date Created          : 21/05/2022
 *  Quots of the code     : 'sebuah code program bukanlah sebatas perintah-perintah yang ditulis di komputer, melainkan sebuah kesempatan berkomunikasi antara komputer dan manusia. (bagi yang tidak punya teman wkwk)'
 */
class M_menu extends CI_Model
{
    private $_table = 'm_menu';

    // Add new 
    public function addData($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    function getData($field = null, $where = null, $tbl_join = null)
    {
        if ($field != null) {
            $this->db->select($field);
        } else {
            $this->db->select('*');
        }
        $this->db->from($this->_table);
        if ($tbl_join != null) {
            foreach ($tbl_join as $key => $value) {
                $this->db->join($value['table'], $value['on'], $value['type']);
            }
        }
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('nama_menu', 'ASC');
        return $this->db->get();
    }

    function updateData($data, $where)
    {
        $this->db->update('m_menu', $data, $where);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function deleteData($where)
    {
        $this->db->where($where);
        $this->db->delete('m_menu');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
