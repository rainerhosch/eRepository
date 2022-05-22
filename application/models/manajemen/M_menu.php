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
    function getData($where = null)
    {
        $this->db->select('*');
        $this->db->from('m_menu');
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
}
