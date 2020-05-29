<?php
defined('BASEPATH') or exit('No direct script access allowed');

class List_permohonan_model extends CI_Model
{
    public function getAllList_permohonan()
    {
        return $this->db->get('permohonan')->result_array();
    }

    public function getList_permohonan($limit, $start, $status)
    {

        $this->db->from('permohonan');
        $this->db->where('status', 1);
        $this->db->where('read',0);
        $count = $this->db->count_all_results();

        $this->session->set_userdata('newPermohonanCount', $count);

        $this->db->select('users.nama, users.email, permohonan.id as permohonan_id, permohonan.jenis_permohonan, permohonan.status, permohonan.read');
        $this->db->from('permohonan');
        $this->db->join('users','permohonan.user_id = users.id');
        $this->db->where_in('status', $status);
        $this->db->limit($limit,$start);
        $this->db->order_by('permohonan.created_at', 'DESC');
        return $this->db->get()->result_array();



        
    }

    public function countAllList_permohonan($status)
    {   
        $this->db->where_in('status',$status);
        return $this->db->get('permohonan')->num_rows();
    }

    public function getPermohonan($id_permohonan)
    {

        $this->db->set('read', 1);
        $this->db->where('id', $id_permohonan);
        $this->db->update('permohonan');

        $this->db->select('users.id as id_user, users.nama, users.nip, users.email, users.instansi,
                            permohonan.id as id_permohonan, permohonan.status, permohonan.jenis_pengambilan, 
                            permohonan.jenis_permohonan, permohonan.nama_permohonan, permohonan.resi, 
                            permohonan.status, permohonan.tgl_ambil');
        $this->db->from('permohonan');
        $this->db->join('users','permohonan.user_id = users.id');
        $this->db->where('permohonan.id', $id_permohonan);
        $hasil = $this->db->get()->result_array();


        $this->db->select('surat.id as id_surat, surat.nama_surat');
        $this->db->from('surat');
        $this->db->where('permohonan_id', $hasil[0]['id_permohonan']);
        $surat = $this->db->get()->result_array();

        $array = array(
            'permohonan' => $hasil[0],
            'surat' => $surat
        );

        
        // print "<pre>";
        // print_r($array);
        // die;

        return $array;
    
    }
}
