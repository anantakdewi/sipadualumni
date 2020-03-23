<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemohon extends CI_Controller {

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
            redirect((base_url('index.php/auth/login')));
        };

    }

	public function index()
	{
        // data for active nav
        $data = array('nav_data' => 'dashboard');

        $this->load->view('dashboard/template/dashboard_header',$data);
        $this->load->view('dashboard/pemohon/dashboard_pemohon');
		$this->load->view('dashboard/template/dashboard_footer');
    }

    public function monitoring()
    {
        // data for active nav
        $data = array('nav_data' => 'monitoring');

        $this->load->view('dashboard/template/dashboard_header', $data);
        $this->load->view('dashboard/pemohon/monitoring_pemohon');
        $this->load->view('dashboard/template/dashboard_footer');
    }



}