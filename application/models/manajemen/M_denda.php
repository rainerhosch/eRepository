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

    public function getDataMasterDenda($data = null)
    {
        if (isset($data['field'])) {
            $this->_field = $data['field'];
        }
        $this->db->select($this->_field);
        $this->db->from($this->_table);
        if (isset($data['join_tbl'])) {
            foreach ($data['join_tbl'] as $key => $value) {
                $this->db->join($value['table'], $value['on'], $value['join_type']);
            }
        }
        if (isset($data['where'])) {
            $this->db->where($data['where']);
        }
        if (isset($data['limit']) && isset($data['offset'])) {
            $this->db->limit($data['limit'], $data['offset']);
        } elseif (isset($data['limit'])) {
            $this->db->limit($data['limit']);
        } elseif (isset($data['offset'])) {
            $this->db->limit($this->_limit, $data['offset']);
        }
        $this->db->order_by('id_denda', 'DESC');
        return $this->db->get();
    }

    public function getCount($where = null)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        if ($where != null) {
            $this->db->where($where);
        }
        return $this->db->get()->num_rows();
    }

    public function getData($where = null)
    {
        $this->db->select('tr_denda.*, m_buku.judul_buku, m_denda.desc_denda');
        $this->db->from('tr_denda');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('m_denda', 'm_denda.id_denda = tr_denda.jenis_denda', '');
        $this->db->join('m_buku', 'm_buku.id_buku = tr_denda.id_buku', '');
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
