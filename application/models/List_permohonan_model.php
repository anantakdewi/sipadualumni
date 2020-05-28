<?php
defined('BASEPATH') or exit('No direct script access allowed');

class List_permohonan_model extends CI_Model
{
    public function getAllList_permohonan()
    {
        return $this->db->get('list_permohonan')->result_array();
    }

    public function getList_permohonan($limit, $start)
    {

        return $this->db->get('list_permohonan', $limit, $start)->result_array();
    }

    public function countAllList_permohonan()
    {
        return $this->db->get('list_permohonan')->num_rows();
    }
}
