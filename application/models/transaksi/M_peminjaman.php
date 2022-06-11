<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *  File Name             : M_peminjaman.php
 *  File Type             : Model
 *  File Package          : CI_Models
 ** * * * * * * * * * * * * * * * * * **
 *  Author                : Rizky Ardiansyah
 *  Date Created          : 28/08/2022
 *  Quots of the code     : 'sebuah code program bukanlah sebatas perintah-perintah yang ditulis di komputer, melainkan sebuah kesempatan berkomunikasi antara komputer dan manusia. (bagi yang tidak punya teman wkwk)'
 */
class M_peminjaman extends CI_Model
{
    private $_table = 'tr_peminjaman';
    private $_field = '*';
    private $_limit = 10;
    private $_offset;
    private $_join_tbl = null;


    public function getDataById($where = null, $field = null, $join_tbl = null)
    {
        if ($field != null) {
            $this->_field = $field;
            $this->db->select($field);
        } else {
            $this->db->select($this->_field);
        }
        $this->db->from($this->_table);
        if ($join_tbl != null) {
            foreach ($join_tbl as $key => $value) {
                $this->db->join($value['table'], $value['on'], $value['join_type']);
            }
        }
        if ($where != null) {
            $this->db->where($where);
        }
        return $this->db->get();
    }

    public function getMaxId()
    {
        $this->db->select_max('id_peminjaman');
        $this->db->from($this->_table);
        return $this->db->get();
    }

    public function getData($data = null)
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
        $this->db->order_by('id_peminjaman', 'DESC');
        return $this->db->get();
    }

    public function insertData($data, $table = null)
    {
        if ($table != null) {
            $this->db->insert($table, $data);
        } else {
            $this->db->insert($this->_table, $data);
        }
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
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

    function updateData($data, $where, $table = null)
    {
        if ($table != null) {
            $this->db->where($where);
            $this->db->update($table, $data);
        } else {
            $this->db->where($where);
            $this->db->update($this->_table, $data);
        }
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function deleteData($where)
    {
        $this->db->delete($this->_table, $where);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
