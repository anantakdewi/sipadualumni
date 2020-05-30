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



    public function postPengumuman()
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
}
