<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class legalisir_pemohon extends CI_Controller {

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

        if(is_null($this->session->userdata('email'))){
            redirect((base_url('auth/login')));
        };

    }

    public function showForm()
    {
        // data for active nav
        $data = array(
            'nav_data' => 'legalisir',
            'title' => 'Pengajuan Legalisir Ijazah dan Transkrip',
            'breadcumb' => array('Legalisir','Pengajuan'),
            'small_title' => 'Pengajuan Legalisir',
        );

        $this->load->view('dashboard/template/dashboard_header',$data);
        $this->load->view('dashboard/pemohon/legalisir/legalisir_pengajuan');
        $this->load->view('dashboard/template/dashboard_footer');
    }

    public function postForm()
    {
        $this->form_validation->set_rules('pengambilan_dokumen', 'Pengambilan Dokumen', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|min_length[10]');
        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
        $this->form_validation->set_rules('kabupaten', 'Kabupaten', 'required');
        $this->form_validation->set_rules('kode_pos', 'Kode Pos', 'required|min_length[4]');

        if($this->form_validation->run() == false){
            redirect(base_url('pemohon/legalisir/pengajuan'));
        } else {
            
            $metodePengambilan = $this->input->post('pengambilan_dokumen', true);
            $alamat = htmlspecialchars($this->input->post('alamat', true));
            $provinsi = htmlspecialchars($this->input->post('provinsi', true));
            $kabupaten = htmlspecialchars($this->input->post('kabupaten', true));
            $kodePos = htmlspecialchars($this->input->post('kode_pos', true));


            //jika mengabdi diatas 4 tahun
            $upload_img = $_FILES['surat_permohonan_legalisir']['surat_pendaftaran_univ'];

            if($upload_img){

                $permohonan = array(
                    'user_id' => $this->session->userdata('id'),
                    'jenis_permohonan_id' => 1,
                    'nama_permohonan' => NULL,
                    'jenis_pengambilan' => $metodePengambilan,
                    'status' => 1,
                    'read' => 0,
                    'tgl_ambil' => NULL,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => NULL,
                );


                $config['upload_path']          = './assets/img/';
                $config['allowed_types']        = 'jpg|png';
                $config['max_size']             = 2048;
                $config['file_name']            = time();


            }


            
        }
    }

    
}