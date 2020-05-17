<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class lainnya_pemohon extends CI_Controller {

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

    public function monitoring()
    {
        $this->db->select('permohonan.jenis_permohonan, permohonan.nama_permohonan, progress.created_at, progress.status, progress.komentar');
        $this->db->from('progress');
        $this->db->join('permohonan', 'progress.permohonan_id = permohonan.id');
        $this->db->where('progress.user_id',$this->session->userdata('id'));
        $this->db->where('permohonan.status !=', 4);
        $query = $this->db->get();

        var_dump($query->getResult());

    }


    
}