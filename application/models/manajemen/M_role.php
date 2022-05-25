<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *  File Name             : M_role.php
 *  File Type             : Model
 *  File Package          : CI_Models
 ** * * * * * * * * * * * * * * * * * **
 *  Author                : Rizky Ardiansyah
 *  Date Created          : 25/05/2022
 *  Quots of the code     : 'sebuah code program bukanlah sebatas perintah-perintah yang ditulis di komputer, melainkan sebuah kesempatan berkomunikasi antara komputer dan manusia. (bagi yang tidak punya teman wkwk)'
 */
class M_role extends CI_Model
{

    // Add new 
    public function addData($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function getData($field, $where = null)
    {
        $this->db->select($field);
        $this->db->from('user_role');
        if ($where != null) {
            $this->db->where($where);
        }
        return $this->db->get();
    }

    public function getAccessMenu($where = null)
    {
        $this->db->select('*');
        $this->db->from('user_access_menu');
        $this->db->join('m_menu', 'm_menu.id_menu = user_access_menu.id_menu');
        if ($where != null) {
            $this->db->where($where);
        }
        return $this->db->get();
    }


    public function getRoleAccesMenu($field, $tbl, $where = null)
    {
        if ($field = null) {
            $this->db->select('*');
        } else {
            $this->db->select($field);
        }
        $this->db->from($tbl['first_table']);
        if ($tbl['join_table'] != null) {
            foreach ($tbl['join_table'] as $key => $value) {
                $this->db->join($value['table'], $value['on'], $value['join']);
            }
        }
        if ($where != null) {
            $this->db->where($where);
        }
        return $this->db->get();
    }

    public function delete_data($tbl, $where)
    {
        $this->db->where($where);
        $this->db->delete($tbl);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
