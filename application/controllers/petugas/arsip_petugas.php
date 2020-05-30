<?php
defined('BASEPATH') or exit('No direct script access allowed');

class arsip_petugas extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {

        parent::__construct();

        $this->load->library('form_validation');

        sudah_login();
    }



    public function cariSurat()
    {

        $this->form_validation->set_rules('cari_dok','','required');

        if($this->form_validation->run() == false){

            redirect_back();

        } else {

            // data for header
            $data = array(
                'nav_data' => 'arsip',
                'title' => 'Arsip',
                'breadcumb' => '',
                'small_title' => 'Arsip Surat',
            );

            $surat = $this->input->post('cari_dok');

            $this->db->select('dokumen.id as id_dokumen, dokumen.path, permohonan.nama_permohonan as nama_surat, users.nama as pemohon');
            $this->db->from('dokumen');
            $this->db->join('permohonan','dokumen.permohonan_id = permohonan.id');
            $this->db->join('users', 'permohonan.user_id = users.id');
            $this->db->where('permohonan.jenis_permohonan', 3);
            $this->db->like('permohonan.nama_permohonan', $surat);
            $query['surat'] = $this->db->get()->result_array();
            
            // print "<pre>";
            // print_r($query);
            // die;

            $this->load->view('dashboard/template/dashboard_header2', $data);
            $this->load->view('dashboard/petugas/arsip/arsip_surat', $query);
            $this->load->view('dashboard/template/dashboard_footer');

        }

    }

    public function surat()
    {
        // data for header
        $data = array(
            'nav_data' => 'arsip',
            'title' => 'Arsip',
            'breadcumb' => '',
            'small_title' => 'Arsip Surat',
        );

        $query['surat'] = [];

        $this->load->view('dashboard/template/dashboard_header2', $data);
        $this->load->view('dashboard/petugas/arsip/arsip_surat', $query);
        $this->load->view('dashboard/template/dashboard_footer');
    }


    public function download()
    {

        $this->load->helper('url');
        $this->load->helper('download');

        $id_surat = $this->uri->segment(4);

        $this->db->select('path, jenis_dokumen');
        $query = $this->db->get_where('dokumen', ['id' => $id_surat])->row();

        $path = $query->path;

        $extFile = pathinfo($path);

        $file = file_get_contents($path);

        $filename = $query->jenis_dokumen . '_' . $this->session->userdata('nama') . '.' . $extFile['extension'];
        

        // print "<pre>";
        // var_dump($path);
        // var_dump($filename);
        // // var_dump($file);
        // die();

        force_download($filename,$file,TRUE);

        redirect_back();
        
    }
}
