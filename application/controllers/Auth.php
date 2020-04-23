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

    public function __construct() {

        parent::__construct();
        $this->load->library('form_validation');

        // if(is_null($this->session->userdata('email'))){
        //     redirect(('index.php/auth/login'));
        // };

    }

	public function index()
	{
        if(empty($this->session->userdata('email'))){
            
            redirect(('auth/login'));

        } else {
            
            if($this->session->userdata('role_id') == 2){

                redirect(('pemohon/dashboard'));

            } else if($this->session->userdata('role_id') == 1){

                redirect(('petugas/dashboard'));

            }
        }
		
    }
    
    public function register()
	{
		$this->load->view('auth/register');
    }
    
    public function reg_action()
	{

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|max_length[150]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]');
        $this->form_validation->set_rules('repassword', 'Password Confirmation', 'required|trim|matches[password]');
        $this->form_validation->set_rules('nip', 'NIP', 'required|trim|max_length[21]');
        $this->form_validation->set_rules('instansi', 'Instansi', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('tahun_lulus', 'Tahun Lulus', 'required|trim');

        if($this->form_validation->run() == false){
            $this->load->view('auth/register');
        } else {
            
            $nama = htmlspecialchars($this->input->post('nama', true));
            $email = htmlspecialchars($this->input->post('email', true));
            $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            // $repassword = $this->input->post('repassword');
            $nip = $this->input->post('nip');
            $instansi = $this->input->post('instansi');
            $tahun_lulus = $this->input->post('tahun_lulus');

            // if ($password != $repassword) {`
            //     echo "Password tidak sama.";
            // }else{

            $data = array(
                'nama'=>$nama,
                'email'=>$email,
                'password'=>$password,
                'nip'=>$nip,
                'instansi'=>$instansi,
                'tahun_lulus'=>$tahun_lulus,
                'role_id' => 2, // 2 : Alumni, 1 : Admin
                'active' => 0, //0 : belum verifikasi, 1 : sudah verifikasi
            );

            $result = $this->model->simpan('users', $data);

            if ($result > 0) {
                echo "Data alumni berhasil disimpan.";
            } else {
                echo "Data alumni gagal disimpan.";
            }
        }
    }


    public function login()
        {
            $this->form_validation->set_rules('email', "Email", 'required|trim|max_length[150]|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]');

            if($this->form_validation->run() == false){

                $this->load->view('auth/login'); 

            } else {

                $email = htmlspecialchars($this->input->post('email',true));
                $password = $this->input->post('password');
                $alumni = $this->db->get_where('users',['email' => $email])->row_array();

                if($alumni){
                    // jika ada email

                    if($alumni['active'] == 1){
                        // jika sudah di verifikasi
                        
                        if(password_verify($password, $alumni['password'])){
                            // jika password benar
                            $user_data = [
                                'id' => $alumni['id'],
                                'email' => $alumni['email'],
                                'nama' => $alumni['nama'],
                                'nip' => $alumni['nip'],
                                'role_id' => $alumni['role_id'],
                            ];

                            $this->session->set_userdata($user_data);

                            redirect(base_url('pemohon/dashboard'));
                            

                        } else {
                            // jika password salah

                            $this->session->set_flashdata('message', 
                            '<div class="alert alert-danger" role="alert">
                            Email dan Password tidak cocok!</div>');
                            
                            redirect(base_url('auth/login'));

                        }
                        
                    } else {
                        // jika belum di verifikasi
                        $this->session->set_flashdata('message', 
                        '<div class="alert alert-danger" role="alert">
                        Email belum terverifikasi!, mohon cek inbox email anda dan segera verifikasi </div>');

                        redirect(base_url('auth/login'));
                        
                    }
                    
                } else {
                    // jika tidak ada email
                    $this->session->set_flashdata('message', 
                    '<div class="alert alert-danger" role="alert">
                    Email tidak terdaftar! </div>');

                    redirect(base_url('auth/login'));
                }

            }
        }
        
        
    
    
}
?>