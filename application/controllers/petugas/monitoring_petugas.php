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

        permohonanOnProgress($this->session->userdata('id'));

        if (is_null($this->session->userdata('email'))) {
            redirect((base_url('auth/login')));
        };

        // $this->load->helper('sipadu');

    }


    public function lihatStatus()
    {
        // data for active nav
        $data = array(
            'nav_data' => 'daftar permohonan',
            'title' => 'Status Permohonan',
            'breadcumb' => array('Daftar Permohonan', 'Status Permohonan'),
            'small_title' => 'Status Permohonan',
        );

        $this->load->view('dashboard/template/dashboard_header2', $data);
        $this->load->view('dashboard/petugas/monitoring/monitoring_read');
        $this->load->view('dashboard/template/dashboard_footer');
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
