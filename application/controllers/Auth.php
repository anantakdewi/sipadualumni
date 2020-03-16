<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

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
	public function index()
	{
		$this->load->view('auth/login');
    }
    
    public function register()
	{
		$this->load->view('auth/register');
    }
    
    public function reg_action()
	{
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $repassword = $this->input->post('repassword');
        $nip = $this->input->post('nip');
        $instansi = $this->input->post('instansi');
        $tgl_angkat = $this->input->post('tgl_angkat');
        $tgl_tempat = $this->input->post('tgl_tempat');

        if ($password != $repassword) {
            echo "Password tidak sama.";
        }else{

        $data = array(
            'nama'=>$nama,
            'email'=>$email,
            'password'=>$password,
            'nip'=>$nip,
            'instansi'=>$instansi);
        $result=$this->model->simpan('register', $data);
        if ($result > 0) {
            echo "Data alumni berhasil disimpan.";
        }else{
            echo "Data alumni gagal disimpan.";
        }


        
    }
    }
}
?>