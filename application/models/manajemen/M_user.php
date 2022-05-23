<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *  File Name             : M_user.php
 *  File Type             : Model
 *  File Package          : CI_Models
 ** * * * * * * * * * * * * * * * * * **
 *  Author                : Rizky Ardiansyah
 *  Date Created          : 23/05/2022
 *  Quots of the code     : 'sebuah code program bukanlah sebatas perintah-perintah yang ditulis di komputer, melainkan sebuah kesempatan berkomunikasi antara komputer dan manusia. (bagi yang tidak punya teman wkwk)'
 */
class M_user extends CI_Model
{
    public function getData($field, $where = null)
    {
        $this->db->select($field);
        $this->db->from('user');
        $this->db->join('user_detail', 'user_detail.user_detail_id=user.user_detail_id');
        $this->db->join('user_role', 'user_role.role_id=user.role_id');

        if ($where != null) {
            $this->db->where($where);
        }
        return $this->db->get();
    }

    // insert data
    public function insert_data($table, $data)
    {
        $insert_status = $this->db->insert($table, $data);
        $id_insert = $this->db->insert_id();
        if ($insert_status) {
            return $id_insert;
        } else {
            return false;
        }
    }

    // update data
    public function update_data($table, $id, $data)
    {
        $field = $table . '_id';
        $this->db->where($field, $id);
        $this->db->update($table, $data);
        $updated_status = $this->db->affected_rows();
        if ($updated_status) {
            return true;
        } else {
            return false;
        }
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

    public function get_user_acces_menu($where = null)
    {
        // $this->db->distinct();
        $this->db->select('*');
        $this->db->from('user_access_menu');
        $this->db->join('m_menu', 'm_menu.id_menu=user_access_menu.id_menu');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('user_access_menu.id_menu', 'ASC');
        return $this->db->get();
    }
}
