<?php
defined('BASEPATH') or exit('No direct script access allowed');

class monitoring_petugas extends CI_Controller
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

        $this->load->model('List_permohonan_model', 'list_permohonan');

        if (is_null($this->session->userdata('email'))) {
            redirect((base_url('auth/login')));
        };

    }

    public function lihatStatus()
    {

        //get id permohonan from URL
        $id_permohonan = $this->uri->segment(4);

        $arr_permohonan = $this->list_permohonan->getPermohonan($id_permohonan);

        // print "<pre>";
        // print_r($arr_permohonan);
        // die;

        $data = array(
            'nav_data' => 'daftar permohonan',
            'title' => 'Status Permohonan',
            'breadcumb' => array('Daftar Permohonan', 'Status Permohonan'),
            'small_title' => 'Status Permohonan',
        );

        $status_p = $arr_permohonan['permohonan']['status'];

        switch($status_p){
            case 1:
                $arr_permohonan['permohonan']['status'] = "Menunggu Konfirmasi Petugas";
                break;
            case 2:
                $arr_permohonan['permohonan']['status'] = "Permohonan diterima";
                break;
            case 3:
                $arr_permohonan['permohonan']['status'] = "Dokumen tidak Lengkap";
                break;
            case 4:
                $arr_permohonan['permohonan']['status'] = "Dokumen Sedang di proses";
                break;
            case 5:
                $arr_permohonan['permohonan']['status'] = "Dokumen Selesai";
                break;
            case 6:
                $arr_permohonan['permohonan']['status'] = "Dokumen sedang dikirim";
                break;
            case 7:
                $arr_permohonan['permohonan']['status'] = "Permohonan Selesai";
                break;
        }

        // print "<pre>";
        // print_r($arr_permohonan);
        // die;

        $this->load->view('dashboard/template/dashboard_header2', $data);
        $this->load->view('dashboard/petugas/monitoring/monitoring_read', $arr_permohonan);
        $this->load->view('dashboard/template/dashboard_footer');
    }

    public function downloadSurat()
    {
        $this->load->helper('url');
        $this->load->helper('download');

        $id_surat = $this->uri->segment(4);

        $this->db->select('path, nama_surat');
        $this->db->from('surat');
        $this->db->where('id',$id_surat);
        $data = $this->db->get()->result_array();

        $path = $data[0]['path'];
        $namafile = $data[0]['nama_surat'] . time();

        // print "<pre>";
        // print_r($data);
        // var_dump($path);
        // // var_dump($namafile);
        // var_dump('assets/documents/2020/May/1589770541.pdf');
        // die;

        force_download($path, NULL);
    }


    public function post()
    {
        $this->load->model('Dokumen');
        $this->load->model('Progress');

        $this->form_validation->set_rules('status','', 'required');
        
        if($this->input->post('status') == 5){

            if($this->input->post('jenis_permohonan') == "Legalisir"){

                $this->form_validation->set_rules('legalisir', '', 'callback_file_check[legalisir]');
                $this->form_validation->set_rules('transkrip', '', 'callback_file_check[transkrip]');
                $this->form_validation->set_rules('resi','','numeric');

            } else if ($this->input->post('jenis_permohonan') == "Lainnya"){

                $this->form_validation->set_rules('dokumen', '', 'callback_file_check[dokumen]');

            }

        }
        
        $this->form_validation->set_rules('id_permohonan','','required|numeric');
        $this->form_validation->set_rules('jenis_permohonan','','required');
        $this->form_validation->set_rules('id_user','','required|numeric');

        if ($this->form_validation->run() == false) {

            $arr_flashdata = array(
                'type' => 'warning',
                'title' => 'Error!',
                'messages' => 'Sepertinya ada yang salah..',
            );

            $this->session->set_flashdata('alert', $arr_flashdata);

            redirect_back();

        } else {

            $id_permohonan = $this->input->post('id_permohonan');
            $jenis_permohonan = $this->input->post('jenis_permohonan');
            $id_user = $this->input->post('id_user');


            $status = $this->input->post('status');
            
            if($status == 5){

                if($jenis_permohonan == "Legalisir"){

                    $arr_gambar = ['legalisir', 'transkrip'];

                    if(!is_null($this->input->post('resi'))){
                        $resi = $this->input->post('resi');
                    } else {
                        $resi = NULL;
                    }

                } else if($jenis_permohonan == "Lainnya"){
                    $arr_gambar = ['dokumen'];
                    $resi = NULL;
                }

                foreach($arr_gambar as $gambar){

                    $img = $_FILES[$gambar];

                    if ($img) {
        
                        try {
        
                            //cek direktori
                            if (!is_dir('assets/fileToPemohon/' . date("Y") . '/' . date("M") . '/')) {
                                mkdir('./assets/fileToPemohon/' . date("Y") . '/' . date("M") . '/', 0777, TRUE);
                            }
        
                            $config['upload_path']          = './assets/fileToPemohon/' . date("Y") . '/' . date("M") . '/';
                            $config['allowed_types']        = 'pdf|doc|docx';
                            $config['max_size']             = 2048;
                            $config['file_name']            = time();
        
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
        
                            if (!$this->upload->do_upload($gambar)) {
        
                                $error = $this->upload->display_errors();
                                die($error);
        
                            } else {
        
                                $details = $this->upload->data();
        
                            }
        
                            //menghilangkan path depan sebelum assets
                            $str = $details['full_path'];
                            $path = explode('/', $str);
                            
                            // print "<pre>";
                            // print_r($path);
                            // die();

                            unset($path[0]);
                            unset($path[1]);
                            unset($path[2]);
                            unset($path[3]);
                    
                            $path = implode('/', $path);
        
                            $dokumen = array(
                                'permohonan_id' => $id_permohonan,
                                'jenis_dokumen' => $jenis_permohonan,
                                'path' => $path,
                                'status' => 1,
                                'count' => 0,
                                'created_at' => date("Y-m-d H:i:s"),
                            );
        
                            $this->Dokumen->insert($dokumen);
        
                            // print "<pre>";
                            // print_r($img);
                            // print "<pre>";
                            // die();
                        } catch (\Exception  $e) {
                            die($e->getMessage());
                        }

                    }
                    
                }

                try {

                    $this->db->set('status', $status);
                    $this->db->set('resi', $resi);
                    $this->db->where('id', $id_permohonan);
                    $this->db->update('permohonan');

                    $progress = array(
                        'user_id' => $id_user,
                        'permohonan_id' => $id_permohonan,
                        'status' => $status,
                        'created_at' => date('Y-m-d H:i:s'),
                    );

                    $this->Progress->insert($progress);

                } catch (\Exception $e) {
                    die($e->getMessage());
                }
                

                $arr_flashdata = array(
                    'type' => 'success',
                    'title' => 'Success!',
                    'messages' => 'Permohonan berhasil di update!',
                );

                $this->session->set_flashdata('alert', $arr_flashdata);
            
                redirect_back();
                
            }

            try {

                $this->db->set('status', $status);
                $this->db->where('id', $id_permohonan);
                $this->db->update('permohonan');

                $progress = array(
                    'user_id' => $id_user,
                    'permohonan_id' => $id_permohonan,
                    'status' => $status,
                    'created_at' => date('Y-m-d H:i:s'),
                );



                $this->Progress->insert($progress);

                $this->db->set('status', $status);
                $this->db->where('id', $id_permohonan);
                $this->db->update('permohonan');

            } catch (\Exception $e) {
                die($e->getMessage());
            }

            $arr_flashdata = array(
                'type' => 'success',
                'title' => 'Success!',
                'messages' => 'Permohonan berhasil di update!',
            );

            $this->session->set_flashdata('alert', $arr_flashdata);
        
            redirect(base_url('petugas/monitoring/baru'));
        }
    }
    


    public function file_check($str, $variableFile)
    {

        $allowed_type_arr = array('application/pdf', 'application/msword');

        $mime = get_mime_by_extension($_FILES[$variableFile]['name']);

        if (isset($mime)) {
            if (in_array($mime, $allowed_type_arr)) {
                return true;
            } else {
                $this->form_validation->set_message('file_check', 'Please select only pdf/docx/doc file.');
                return false;
            }
        } else {

            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }



    public function dokumen()
    {
        // data for active nav
        $data = array(
            'nav_data' => 'permohonan sedang diproses',
            'title' => 'Daftar Permohonan',
            'breadcumb' => array('', ''),
            'small_title' => 'Permohonan Sedang Diproses',
        );

        $this->load->view('dashboard/template/dashboard_header2', $data);
        $this->load->view('dashboard/petugas/monitoring/monitoring_dokumen');
        $this->load->view('dashboard/template/dashboard_footer');
    }

    public function format()
    {
        // data for active nav
        $data = array(
            'nav_data' => 'permohonan selesai',
            'title' => 'Daftar Permohonan',
            'breadcumb' => array('', ''),
            'small_title' => 'Permohonan Selesai',
        );

        $this->load->view('dashboard/template/dashboard_header2', $data);
        $this->load->view('dashboard/petugas/monitoring/monitoring_format');
        $this->load->view('dashboard/template/dashboard_footer');
    }
}
