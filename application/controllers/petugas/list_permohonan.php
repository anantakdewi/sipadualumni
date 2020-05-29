<?php
defined('BASEPATH') or exit('No direct script access allowed');

class list_permohonan extends CI_Controller
{
    public function lihatList()
    {
        // LOAD EVERYTHING HERE //
        $this->load->model('List_permohonan_model', 'list_permohonan');
        $this->load->library('pagination');

        // CHECK URL FOR PAGINATION 
        $type = $this->uri->segment(3);
        
        switch($type){

            case "baru" :

                $data = array(
                    'nav_data' => 'permohonan baru',
                    'title' => 'Daftar Permohonan',
                    'breadcumb' => array('', ''),
                    'small_title' => 'Permohonan Baru',
                );

                $statusPermohonan = ['1'];
                $list['headerBox'] = "Permohonan Baru";

                // print "<pre>";
                // var_dump($statusPermohonan);
                // die;
                
                $config['base_url'] = base_url('petugas/monitoring/baru');
                break;

            
            
            case "sedangProses" :

                $data = array(
                    'nav_data' => 'permohonan baru',
                    'title' => 'Daftar Permohonan',
                    'breadcumb' => array('', ''),
                    'small_title' => 'Permohonan dalam Proses',
                );

                $statusPermohonan = ['2','4'];
                $list['headerBox'] = "Permohonan dalam Proses";

                $config['base_url'] = base_url('petugas/monitoring/sedangProses');
                break;



            case "selesai" :
                
                $data = array(
                    'nav_data' => 'permohonan baru',
                    'title' => 'Daftar Permohonan',
                    'breadcumb' => array('', ''),
                    'small_title' => 'Permohonan Selesai',
                );

                $statusPermohonan = ['7'];
                $list['headerBox'] = "Permohonan Selesai";

                $config['base_url'] = base_url('petugas/monitoring/selesai');
                break;

        }

        // $config['base_url'] = 'http://localhost/sipadualumni/petugas/list_permohonan/lihatList/';

        $config['total_rows'] = $this->list_permohonan->countAllList_permohonan($statusPermohonan);
        $config['per_page'] = 10;

        //custom
        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = ' </ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');

        //inisiasi
        $this->pagination->initialize($config);

        $list['start'] = $this->uri->segment(4);

        $list['list_permohonan'] = $this->list_permohonan->getList_permohonan($config['per_page'], $list['start'], $statusPermohonan);
        
        // print "<pre>";
        // print_r($list['list_permohonan']);
        // die();

        $this->load->view('dashboard/template/dashboard_header2', $data);
        $this->load->view('dashboard/petugas/monitoring/monitoring_petugas', $list);
        $this->load->view('dashboard/template/dashboard_footer');
    }

    public function downloadSurat()
    {


        $this->load->helper('url');
        $this->load->helper('download');

        $value = $this->uri->segment(4);

        $query = $this->db->query('SELECT path FROM master_dokumen WHERE id = ' . $value . ' AND `status` = 1;');
        $row = $query->row();

        $data = "download/$row->path";


        // die($data);

        force_download($data, NULL);

        $this->load->view('dashboard/petugas/monitoring/monitoring_surat');
    }

    public function submit()
    {

        //load DB Model
        $this->load->model('Permohonan');
        $this->load->model('Surat');

        // cek apakah user menginput dua permohonan
        $var1 = $this->input->post('surat_lainnya', true);
        $var2 = $this->input->post('permohonan_lain', true);
        if (!empty($var1) && !empty($var2)) {
            redirect(base_url('pemohon/lainnya'));
        }

        // die($this->input->post('permohonan_lain', true));
        if (!empty($var1)) {
            $this->form_validation->set_rules('surat_lainnya', '', 'numeric');
        }

        if (!empty($_FILES['format_surat']['name'])) {
            $this->form_validation->set_rules('format_surat', '', 'callback_file_check[format_surat]');
        }

        if ($this->form_validation->run() == false) {
            // nanti balik ke form
            die("salah");
            redirect(base_url('pemohon/lainnya'));
        } else {

            if (!empty($var1)) {

                $angka = htmlspecialchars($this->input->post('surat_lainnya', true));

                switch ($angka) {
                    case 1:
                        $permohonan = "Surat Keterangan Akreditasi Prodi";
                        break;
                    case 2:
                        $permohonan = "Surat Keterangan Penahanan Ijazah Asli";
                        break;
                    case 3:
                        $permohonan = "Surat Keterangan Lulus";
                        break;
                    case 4:
                        $permohonan = "Surat Konversi Nilai Pendaftaran Universitas";
                        break;
                }
            } else if (!empty($var2)) {

                $permohonan = htmlspecialchars($this->input->post('permohonan_lain', true));
            }


            $arr_permohonan = array(
                'user_id' => $this->session->userdata('id'),
                'alamat_id' => NULL,
                'jenis_permohonan' => 3,
                'jenis_pengambilan' => 1,
                'nama_permohonan' => $permohonan,
                'resi' => NULL,
                'status' => 1,
                'read' => 0,
                'tgl_ambil' => NULL,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => NULL,
            );

            $id_permohonan = $this->Permohonan->insert($arr_permohonan);

            if (!empty($_FILES['format_surat']['name'])) {

                //cek direktori
                if (!is_dir('assets/documents/' . date("Y") . '/' . date("M") . '/')) {
                    mkdir('./assets/documents/' . date("Y") . '/' . date("M") . '/', 0777, TRUE);
                }

                $config['upload_path']          = './assets/documents/' . date("Y") . '/' . date("M") . '/';
                $config['allowed_types']        = 'jpg|jpeg|png|pdf|doc|docx';
                $config['max_size']             = 2048;
                $config['file_name']            = time();

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('format_surat')) {
                    $error = $this->upload->display_errors();
                    die($error);
                } else {
                    $details = $this->upload->data();
                }

                $surat = array(
                    'permohonan_id' => $id_permohonan,
                    'path' => $details['full_path'],
                    'status' => 1,
                    'created_at' => date("Y-m-d H:i:s"),
                );

                $this->Surat->insert($surat);
            }


            $arr_flashdata = array(
                'type' => 'success',
                'title' => 'Success!',
                'messages' => 'Permohonan anda telah diajukan!',
            );

            $this->session->set_flashdata('alert', $arr_flashdata);

            redirect(base_url('pemohon/lainnya'));
        }
    }
}
