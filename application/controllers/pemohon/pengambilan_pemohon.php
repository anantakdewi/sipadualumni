<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pengambilan_pemohon extends CI_Controller
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

    public function showForm()
    {
        // data for nav
        $data = array(
            'nav_data' => 'pengambilan',
            'title' => 'Pengajuan Pengambilan Ijazah dan Transkrip Asli',
            'breadcumb' => array('Pengambilan', 'Pengajuan'),
            'small_title' => 'Pengajuan Pengambilan Ijazah',
        );

        $this->load->view('dashboard/template/dashboard_header', $data);
        $this->load->view('dashboard/pemohon/pengambilan/pengambilan_pengajuan');
        $this->load->view('dashboard/template/dashboard_footer');
    }

    public function postForm()
    {
        //load DB Model
        $this->load->model('Permohonan');

        $this->form_validation->set_rules('pengambilan_dokumen', 'Pengambilan Dokumen', 'required');
        $this->form_validation->set_rules('tgl_pengambilan', 'Tanggal Pengambilan', 'required');

        if ($this->form_validation->run() == false) {
            $this->showForm();
        } else {

            $pengambilan = htmlspecialchars($this->input->post('pengambilan_dokumen', true));
            $tgl = htmlspecialchars($this->input->post('tgl_pengambilan', true));
            $tgl_kasar = strtotime($tgl);
            $tgl_pengambilan = date('Y-m-d', $tgl_kasar);

            try {

                $arr_permohonan = array(
                    'user_id' => $this->session->userdata('id'),
                    'alamat_id' => NULL,
                    'jenis_permohonan' => 2,
                    'jenis_pengambilan' => $pengambilan,
                    'resi' => NULL,
                    'status' => 1,
                    'read' => 0,
                    'selesai' => 0,
                    'tgl_ambil' => $tgl_pengambilan,
                    'created_at' => date("Y-m-d H:i:s")
                );


                if ($this->Permohonan->insert($arr_permohonan)) {

                    $arr_flashdata = array(
                        'type' => 'success',
                        'title' => 'Success!',
                        'messages' => 'Permohonan anda telah diajukan!',
                    );

                    $this->session->set_flashdata('alert', $arr_flashdata);

                    redirect(base_url('pemohon/pengambilan'));
                }

                // print "<pre>";
                // print_r($arr_permohonan);
                // print "<pre>";
                // die();

            } catch (\Exception $e) {
                die($e->getMessage());
            }
        }
    }
}
