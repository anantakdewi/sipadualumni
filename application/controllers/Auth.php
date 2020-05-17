<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
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
    }

    public function index()
    {
        if (empty($this->session->userdata('email'))) {

            redirect(('auth/login'));
        } else {

            if ($this->session->userdata('role_id') == 2) {

                redirect(('pemohon/dashboard'));
            } else if ($this->session->userdata('role_id') == 1) {

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

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/register');
        } else {
            $email = $this->input->post('email', true);

            $nama = htmlspecialchars($this->input->post('nama', true));
            $email = htmlspecialchars($email);
            $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            // $repassword = $this->input->post('repassword');
            $nip_kasar = $this->input->post('nip');
            $instansi = $this->input->post('instansi');
            $tahun_lulus = $this->input->post('tahun_lulus');

            // if ($password != $repassword) {`
            //     echo "Password tidak sama.";
            // }else{

            $nip = str_replace(' ', '', $nip_kasar);

            // die($nip);

            $data = array(
                'nama' => $nama,
                'email' => $email,
                'password' => $password,
                'nip' => $nip,
                'instansi' => $instansi,
                'tahun_lulus' => $tahun_lulus,
                'role_id' => 2, // 2 : Alumni, 1 : Admin
                'active' => 0, //0 : belum verifikasi, 1 : sudah verifikasi
                'date_created' => time()
            );


            // Token bilangan random
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];


            $result = $this->model->simpan('users', $data);
            $this->db->insert('user_token', $user_token);

            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                            Akun Anda telah dibuat. Silakan verifikasi akun melalui link yang telah dikirimkan ke email.</div>'
            );

            redirect(base_url('auth/login'));

            // if ($result > 0) {
            //     echo "Data alumni berhasil disimpan.";
            // } else {
            //     echo "Data alumni gagal disimpan.";
            // }
        }
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'sipadu.alumni@gmail.com',
            'smtp_pass' => 'sipadualumni20',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"

        ];

        $this->load->library('email', $config);

        $this->email->from('sipadu.alumni@gmail.com', 'SIPADU ALUMNI POLSTAT STIS');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {

            $this->email->subject('Verifikasi Akun');
            $this->email->message('Silakan klik link berikut ini untuk verifikasi akun Anda. 
        <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&
        token=' . urlencode($token) . '">di sini</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('users', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {

                    $this->db->set('active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('users');

                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert">
                                    Akun Anda telah diverifikasi. Silakan login.</div>'
                    );

                    redirect(base_url('auth/login'));
                } else {

                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger" role="alert">
                                Verifikasi gagal! Token kadaluarsa.</div>'
                    );

                    redirect(base_url('auth/login'));
                }
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">
                            Verifikasi gagal! Email salah.</div>'
                );

                redirect(base_url('auth/login'));
            }
        }
    }


    public function login()
    {
        $this->form_validation->set_rules('email', "Email", 'required|trim|max_length[150]|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]');

        if ($this->form_validation->run() == false) {

            $this->load->view('auth/login');
        } else {

            $email = htmlspecialchars($this->input->post('email', true));
            $password = $this->input->post('password');
            $alumni = $this->db->get_where('users', ['email' => $email])->row_array();

            if ($alumni) {
                // jika ada email

                if ($alumni['active'] == 1) {
                    // jika sudah di verifikasi

                    if (password_verify($password, $alumni['password'])) {


                        //proses cek tahun pengangkatan
                        $arr = str_split($alumni['nip'], 1);

                        $thAngkat = '';

                        for ($i = 8; $i <= 11; $i++) {
                            $thAngkat = $thAngkat . $arr[$i];
                        }

                        $thNow = date('Y');
                        $selisih =  $thNow - $thAngkat;

                        // if($thAngkat )

                        // jika password benar
                        $user_data = [
                            'id' => $alumni['id'],
                            'email' => $alumni['email'],
                            'nama' => $alumni['nama'],
                            'nip' => $alumni['nip'],
                            'role_id' => $alumni['role_id'],
                            'tahun_abdi' => $selisih . "",
                        ];

                        $this->session->set_userdata($user_data);

                        if ($alumni['role_id'] == 1) {
                            redirect(base_url('petugas/dashboard'));
                        } else
                            redirect(base_url('pemohon/dashboard'));
                    } else {
                        // jika password salah

                        $this->session->set_flashdata(
                            'message',
                            '<div class="alert alert-danger" role="alert">
                            Email dan password tidak cocok!</div>'
                        );

                        $this->load->view('auth/login');
                    }
                } else {
                    // jika belum di verifikasi
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger" role="alert">
                        Akun belum terverifikasi! Mohon cek inbox email anda dan segera verifikasi.</div>'
                    );

                    $this->load->view('auth/login');
                }
            } else {
                // jika tidak ada email
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">
                    Email tidak terdaftar! </div>'
                );

                redirect(base_url('auth/login'));
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-danger" role="alert">
                        Anda telah keluar</div>'
        );

        redirect(base_url('auth/login'));
    }


    public function lupa()
    {
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
