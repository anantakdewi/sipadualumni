<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dashboard_petugas extends CI_Controller
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

        sudah_login();
    }

    public function index()
    {
        // data for header
        $data = array(
            'nav_data' => 'dashboard',
            'title' => 'Dashboard',
            'breadcumb' => '',
            'small_title' => 'Halaman Utama',
        );

        $this->load->view('dashboard/template/dashboard_header2', $data);
        $this->load->view('dashboard/petugas/dashboard_petugas');
        $this->load->view('dashboard/template/dashboard_footer');
    }



    public function pengumuman()
    {
        // data for active nav
        $data = array(
            'nav_data' => 'pengumuman',
            'title' => 'Pengumuman',
            'breadcumb' => array('Pengumuman'),
            'small_title' => 'Pengumuman',
        );

        $this->load->view('dashboard/template/dashboard_header2', $data);
        $this->load->view('dashboard/petugas/pengumuman_petugas');
        $this->load->view('dashboard/template/dashboard_footer');
    }

    public function postPengumuman()
    {

        // $img = $_FILES;
        // print "<pre>";
        // print_r($img['files']);
        // die;
                

        $this->load->library('form_validation');

        $this->form_validation->set_rules('judul','','required');
        $this->form_validation->set_rules('isi','','required');

        if(!empty($_FILES['files']['name'][0])){

            die('masuk');
            $this->form_validation->set_rules('files','','callback_files_check[files]');

        }

        if($this->form_validation->run() == false){
            
            $arr_flashdata = array(
                'type' => 'warning',
                'title' => 'Error!',
                'messages' => 'Sepertinya ada yang salah..',
            );

            $this->session->set_flashdata('alert', $arr_flashdata);
            
            redirect_back();

        } else {

            $judul = htmlspecialchars($this->input->post('judul'));
            $isi = $this->input->post('isi');

            try {
                
                $arr_pengumuman = array(
                    'user_id' => $this->session->userdata('id'),
                    'judul' => $judul,
                    'pengumuman' => $isi,
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                );

                $this->db->insert('pengumuman', $arr_pengumuman);
                $id_pengumuman = $this->db->insert_id();

                if(!empty($_FILES['files']['name'][0])){

                        //cek direktori
                    if (!is_dir('assets/pengumuman/' . date("Y") . '/' . date("M") . '/')) {
                        mkdir('./assets/pengumuman/' . date("Y") . '/' . date("M") . '/', 0777, TRUE);
                    }

                    $config['upload_path']          = './assets/pengumuman/' . date("Y") . '/' . date("M") . '/';
                    $config['allowed_types']        = 'jpg|jpeg|png|pdf|doc|docx';
                    $config['max_size']             = 10240;
                    $config['file_name']            = time();

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    $imgCount = sizeof($_FILES['files']['name']);
                    
                    for($i = 0 ; $i < $imgCount; $i++){

                        $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                        $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                        $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                        $_FILES['file']['size'] = $_FILES['files']['size'][$i];

                        if($this->upload->do_upload('file')){
                            $data = $this->upload->data();


                            //menghilangkan path depan sebelum assets
                            $str = $data['full_path'];

                            $path = explode('/', $str);
                            unset($path[0]);
                            unset($path[1]);
                            unset($path[2]);
                            unset($path[3]);
                    
                            $path = implode('/', $path);

                            $arr_dok_pengumuman = array(
                                'user_id' => $this->session->userdata('id'),
                                'pengumuman_id' => $id_pengumuman,
                                'path' => $path,
                                'status' => 1,
                                'created_at' => date('Y-m-d H:i:s'),
                            );

                            $this->db->insert('dokumen_pengumuman', $arr_dok_pengumuman);

                        } else {
                            
                            $error = $this->upload->display_errors();
                            die($error);

                        }

                    }
                    
                }

                
                

            } catch (\Exception $e) {
                $e->getMessage();
                die;
            }

            $arr_flashdata = array(
                'type' => 'success',
                'title' => 'Success!',
                'messages' => 'Pengumuman berhasil dibuat!',
            );

            $this->session->set_flashdata('alert', $arr_flashdata);

            redirect_back();

        }


    }

    public function files_check($str, $files)
    {

        // var_dump($files);
        // die;

        $allowed_type_arr = array('application/pdf', 'image/gif', 'image/jpeg', 'image/png', 'image/x-png', 'application/msword');

        $count = sizeof($_FILES[$files]['name']);

        for($i = 0; $i < $count; $i++){

            $mime = get_mime_by_extension($_FILES[$files]['name'][$i]);

            if (isset($mime)) {
                if (in_array($mime, $allowed_type_arr)) {
                    
                    continue;

                } else {
                    $this->form_validation->set_message('file_check', 'Please select only pdf/jpg/png/doc/docx file.');
                    return false;
                }
            } else {

                $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
                return false;
            }

        }

        return true;
        

    }


}
