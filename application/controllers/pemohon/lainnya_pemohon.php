<?php
defined('BASEPATH') or exit('No direct script access allowed');

class lainnya_pemohon extends CI_Controller
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

        permohonanOnProgress($this->session->userdata('id'));

        if (is_null($this->session->userdata('email'))) {
            redirect((base_url('auth/login')));
        };
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
                'selesai' => 0,
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

                //menghilangkan path depan sebelum assets
                $str = $details['full_path'];
                $path = explode('/', $str);
                unset($test[0]);
                unset($test[1]);
                unset($test[2]);
                unset($test[3]);
        
                $path = implode('/', $path);

                $surat = array(
                    'permohonan_id' => $id_permohonan,
                    'nama_surat' => 'Surat Format',
                    'path' => $path,
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

    public function file_check($str)
    {

        $allowed_type_arr = array('application/pdf', 'image/gif', 'image/jpeg', 'image/png', 'image/x-png', 'application/msword');

        $mime = get_mime_by_extension($_FILES['format_surat']['name']);
        if (isset($mime)) {
            if (in_array($mime, $allowed_type_arr)) {
                return true;
            } else {
                $this->form_validation->set_message('file_check', 'Please select only pdf/jpg/png/doc/docx file.');
                return false;
            }
        }
    }
}
