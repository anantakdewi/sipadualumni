<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard_pemohon extends CI_Controller {

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

	public function index()
	{
        // data for header
        $data = array(
            'nav_data' => 'dashboard',
            'title' => 'Dashboard',
            'breadcumb' => '',
            'small_title' => 'Halaman Utama',
        );

        $this->load->view('dashboard/template/dashboard_header',$data);
        $this->load->view('dashboard/pemohon/dashboard_pemohon');
		$this->load->view('dashboard/template/dashboard_footer');
    }

    public function monitoring()
    {
        // data for active nav
        $data = array(
            'nav_data' => 'monitoring',
            'title' => 'Monitoring',
            'breadcumb' => array('Monitoring'),
            'small_title' => 'Monitoring',
        );

        $this->load->view('dashboard/template/dashboard_header', $data);
        $this->load->view('dashboard/pemohon/monitoring_pemohon');
        $this->load->view('dashboard/template/dashboard_footer');
    }

    public function legalisir()
    {

        // data for active nav
        $data = array(
            'nav_data' => 'legalisir',
            'title' => 'Legalisir',
            'breadcumb' => array('Legalisir'),
            'small_title' => 'Legalisir',
        );

        $this->load->view('dashboard/template/dashboard_header', $data);
        $this->load->view('dashboard/pemohon/legalisir/legalisir_pemohon');
        $this->load->view('dashboard/template/dashboard_footer');
        
    }

    public function pengambilan()
    {

        // data for active nav
        $data = array(
            'nav_data' => 'pengambilan',
            'title' => 'Pengambilan',
            'breadcumb' => array('Pengambilan'),
            'small_title' => 'Pengambilan',
        );

        $this->load->view('dashboard/template/dashboard_header', $data);
        $this->load->view('dashboard/pemohon/pengambilan/pengambilan_pemohon');
        $this->load->view('dashboard/template/dashboard_footer');
        
    }
    

    public function lainnya()
    {

        // data for active nav
        $data = array(
            'nav_data' => 'lainnya',
            'title' => 'Permohonan Lainnya',
            'breadcumb' => array('Lainnya'),
            'small_title' => 'Permohonan Lainnya',
        );

        $this->load->view('dashboard/template/dashboard_header', $data);
        $this->load->view('dashboard/pemohon/lainnya_pemohon');
        $this->load->view('dashboard/template/dashboard_footer');
        
    }

}