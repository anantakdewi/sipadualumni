<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat extends CI_Model 
{
    public $tabel = 'surat';

    public function insert($data)
    {
        $this->db->insert($this->tabel, $data);
        return $this->db->insert_id();
    }

    public function delete($id)
    {
        return $this->db->delete($tabel, $id);
    }
    
    public function update($data, $id)
    {
        return $this->db->update($tabel, $data, $id);
    }

    public function get()
    {
        return $this->db->get($tabel);
    }


}


?>