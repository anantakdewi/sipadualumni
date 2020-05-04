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
        //load DB
        $this->load->model('Alamat');
        $this->load->model('Permohonan');
        $this->load->model('Surat');

        // $this->form_validation->set_rules('pengambilan_dokumen', 'Pengambilan Dokumen', 'required');
        
        $this->form_validation->set_rules('surat_permohonan_legalisir', '', 'callback_file_check[surat_permohonan_legalisir]');
        
        if($this->session->userdata('tahun_abdi') < 4){
        
            $this->form_validation->set_rules('surat_izin_eselon_2', '', 'callback_file_check[surat_izin_eselon_2]');
            $this->form_validation->set_rules('surat_izin_pusdiklat', '', 'callback_file_check[surat_izin_pusdiklat]');
        
        } else {
        
            $this->form_validation->set_rules('surat_bukti_daftar_univ', '', 'callback_file_check[surat_bukti_daftar_univ]');
        
        }

        if($this->input->post('pengambilan_dokumen', true) == 4){
            
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|min_length[10]');
            $this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
            $this->form_validation->set_rules('kabupaten', 'Kabupaten', 'required');
            $this->form_validation->set_rules('kode_pos', 'Kode Pos', 'required|min_length[4]');

        } 
        

        if($this->form_validation->run() == false){
            $this->showForm();
        } else {

            $metodePengambilan = $this->input->post('pengambilan_dokumen', true);

            if($metodePengambilan == 4){
                $alamat = htmlspecialchars($this->input->post('alamat', true));
                $provinsi = htmlspecialchars($this->input->post('provinsi', true));
                $kabupaten = htmlspecialchars($this->input->post('kabupaten', true));
                $kodePos = htmlspecialchars($this->input->post('kode_pos', true));
            } else {
                $alamat = NULL;
                $provinsi = NULL;
                $kabupaten = NULL;
                $kodePos = NULL;
            }

            
            try {
                
                if($alamat != NULL){
                    $arr_alamat = array(
                        'user_id' => $this->session->userdata('id'),
                        'alamat' => $alamat,
                        'prov' => $provinsi,
                        'kabkot' => $kabupaten,
                        'kode_pos' => $kodePos,
                        'created_at' => date("Y-m-d H:i:s"),
                        );

                    $id_alamat = $this->Alamat->insert($arr_alamat);
                } else {
                    $id_alamat = NULL;
                }

                $arr_permohonan = array(
                    'user_id' => $this->session->userdata('id'),
                    'alamat_id' => $id_alamat,
                    'jenis_permohonan' => 1,
                    'jenis_pengambilan' => $metodePengambilan,
                    'resi' => NULL,
                    'status' => 1,
                    'read' => 0,
                    'tgl_ambil' => NULL,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => NULL,
                );
                
                $id_permohonan = $this->Permohonan->insert($arr_permohonan);

            } catch (\Exception $e) {
                die($e->getMessage());
            }

            //jika mengabdi diatas 4 tahun
            if($this->session->userdata('tahun_abdi') >= 4){
                
                $upload_img = array($_FILES['surat_permohonan_legalisir'], $_FILES['surat_bukti_daftar_univ']);
                
                $arr_var_gambar = array('surat_permohonan_legalisir','surat_bukti_daftar_univ');
                
                
                if($upload_img){

                    try {

                        //cek direktori
                        if(!is_dir('assets/documents/'.date("Y").'/'.date("M").'/')){
                            mkdir('./assets/documents/'.date("Y").'/'.date("M").'/',0777,TRUE);
                        }
                        
                        $config['upload_path']          = './assets/documents/'.date("Y").'/'.date("M").'/';
                        $config['allowed_types']        = 'jpg|jpeg|png|pdf|doc|docx';
                        $config['max_size']             = 2048;
                        $config['file_name']            = time();

                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        

                        $i = 0;
                        foreach($upload_img as $img){

                            if(!$this->upload->do_upload($arr_var_gambar[$i])){
                                $error = $this->upload->display_errors();
                                die($error);
                            } else{
                                $details = $this->upload->data();
                            }


                            $surat = array(
                                'permohonan_id' => $id_permohonan,
                                'path' => $details['full_path'],
                                'status' => 1,
                                'created_at' => date("Y-m-d H:i:s"),
                            );

                            $this->Surat->insert($surat);
                        
                            $i++;
                        }

                        // print "<pre>";
                        // print_r($img);
                        // print "<pre>";
                        // die();

                    } catch (\Exception  $e) {
                        die($e->getMessage());
                    }

                    $this->session->set_flashdata('message', 
                    '<div class="alert alert-success" role="alert">
                    Permohonan berhasil diajukan!</div>');

                    redirect(base_url('pemohon/legalisir'));
                }

            } else if($this->session->userdata('tahun_abdi') < 4){

                $upload_img = array($_FILES['surat_permohonan_legalisir'], $_FILES['surat_izin_eselon_2'], $_FILES['surat_izin_pusdiklat']);
                
                $arr_var_gambar = array('surat_permohonan_legalisir','surat_izin_eselon_2','surat_izin_pusdiklat');
                
                
                if($upload_img){

                    try {

                        //cek direktori
                        if(!is_dir('assets/documents/'.date("Y").'/'.date("M").'/')){
                            mkdir('./assets/documents/'.date("Y").'/'.date("M").'/',0777,TRUE);
                        }
                        
                        $config['upload_path']          = './assets/documents/'.date("Y").'/'.date("M").'/';
                        $config['allowed_types']        = 'jpg|jpeg|png|pdf|doc|docx';
                        $config['max_size']             = 2048;
                        $config['file_name']            = time();

                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        

                        $i = 0;
                        foreach($upload_img as $img){

                            if(!$this->upload->do_upload($arr_var_gambar[$i])){
                                $error = $this->upload->display_errors();
                                die($error);
                            } else{
                                $details = $this->upload->data();
                            }


                            $surat = array(
                                'permohonan_id' => $id_permohonan,
                                'path' => $details['full_path'],
                                'status' => 1,
                                'created_at' => date("Y-m-d H:i:s"),
                            );

                            $this->Surat->insert($surat);
                        
                            $i++;
                        }

                        // print "<pre>";
                        // print_r($img);
                        // print "<pre>";
                        // die();
                    } catch (\Exception  $e) {
                        die($e->getMessage());
                    }

                    $this->session->set_flashdata('message', 
                    '<div class="alert alert-success" role="alert">
                    Permohonan berhasil diajukan!</div>');

                    redirect(base_url('pemohon/legalisir'));
                    
                }
            }
        }
    }

    public function file_check($str, $variableFile)
    {

        $allowed_type_arr = array('application/pdf','image/gif','image/jpeg','image/png','image/x-png','application/msword');
        
        if($variableFile == "surat_permohonan_legalisir"){
            $mime = get_mime_by_extension($_FILES['surat_permohonan_legalisir']['name']);
        } else if($variableFile == "surat_izin_eselon_2"){
            $mime = get_mime_by_extension($_FILES['surat_izin_eselon_2']['name']);
        } else if($variableFile == "surat_izin_pusdiklat"){
            $mime = get_mime_by_extension($_FILES['surat_izin_pusdiklat']['name']);
        } else if($variableFile == "surat_bukti_daftar_univ"){
            $mime = get_mime_by_extension($_FILES['surat_bukti_daftar_univ']['name']);
        }

        if(isset($mime)){
            if(in_array($mime,$allowed_type_arr)){
                return true;
            } else {
                $this->form_validation->set_message('file_check', 'Please select only pdf/jpg/png/doc/docx file.');
                return false;
            }
        } else {
            
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
            
        }


            // if(isset($_FILES['file']['name']) && $_FILES['file']['name']!=""){

            //     if(in_array($mime,$allowed_type_arr)){
            //         return true;
            //     } else {
            //         $this->form_validation->set_message('file_check', 'Please select only pdf/gif/jpg/png file.');
            //         return false;
            //     }
            
            // } else {
            //     $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            //     return false;
            // }
        
    }

    public function downloadSurat()
    {
        $this->load->helper('url');
        $this->load->helper('download');

        $value = $this->uri->segment(4);

        $query = $this->db->query('SELECT path FROM master_dokumen WHERE id = '. $value .' AND `status` = 1;');
        $row = $query->row();

        $data = "download/$row->path";


        // die($data);

        force_download($data, NULL);
        

    }
    

    
}