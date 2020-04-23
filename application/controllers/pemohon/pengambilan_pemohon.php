<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pengambilan_pemohon extends CI_Controller {

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
        // data for nav
        $data = array(
            'nav_data' => 'pengambilan',
            'title' => 'Pengajuan Pengambilan Ijazah dan Transkrip Asli',
            'breadcumb' => array('Pengambilan','Pengajuan'),
            'small_title' => 'Pengajuan Pengambilan Ijazah',
        );

        $this->load->view('dashboard/template/dashboard_header', $data);
        $this->load->view('dashboard/pemohon/pengambilan/pengambilan_pengajuan');
        $this->load->view('dashboard/template/dashboard_footer');
    }
}