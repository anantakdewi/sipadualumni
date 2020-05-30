<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dashboard_pemohon extends CI_Controller
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

        if (is_null($this->session->userdata('email'))) {
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


        $this->db->select('id, jenis_permohonan, nama_permohonan, created_at, status');
        $this->db->from('permohonan');
        $this->db->where('permohonan.user_id', $this->session->userdata('id'));
        $this->db->where('permohonan.selesai !=', 1);
        $hasil = $this->db->get()->result_array();

        if(sizeof($hasil) != 0){

            $hasil[0]['created_at'] = date('d M Y',strtotime($hasil[0]['created_at']));
            $query['permohonan'] = $hasil[0];

        } else {
            $query['permohonan'] = $hasil;
        }

        $this->db->select('*');
        $this->db->order_by('id', 'DESC');
        $pengumuman = $this->db->get('pengumuman',1)->result_array();

        $query['pengumuman'] = $pengumuman[0];

        $this->db->select('path');
        $dokumen = $this->db->get_where('dokumen_pengumuman', array('pengumuman_id' => $pengumuman[0]['id']) )->result_array();

        $query['dokumen_pengumuman'] = $dokumen;


        // print "<pre>";
        // print_r($query);
        // die;

        $this->load->view('dashboard/template/dashboard_header', $data);
        $this->load->view('dashboard/pemohon/dashboard_pemohon', $query);
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

        $this->db->select('permohonan.id as id_permohonan, permohonan.jenis_permohonan, permohonan.jenis_pengambilan,
                            permohonan.status as statusNow, permohonan.nama_permohonan, progress.created_at, progress.status, progress.komentar');

        $this->db->from('progress');
        $this->db->join('permohonan', 'progress.permohonan_id = permohonan.id');
        $this->db->where('progress.user_id', $this->session->userdata('id'));
        $this->db->where('permohonan.selesai !=', 1);
        $query = $this->db->get()->result_array();
        
        $arr['results'] = $query;
        
        if(sizeof($query) != 0){

            $index = sizeof($query) - 1;


            if($query[$index]['status'] == 5 && $query[$index]['jenis_pengambilan'] == "Unduh"){

                $this->db->select('id as id_dokumen');
                $this->db->from('dokumen');
                $this->db->where('permohonan_id', $query[0]['id_permohonan']);
                $dokumenPath = $this->db->get()->result_array();
                
                $arr['dokumen'] = $dokumenPath;

            } elseif($query[$index]['jenis_pengambilan'] == "POS"){

                $this->db->select('resi');
                $this->db->from('permohonan');
                $this->db->where('id', $query[0]['id_permohonan']);
                $arr['resi'] = $this->db->get()->row()->resi;

            }


        }
        
        
        // print "<pre>";
        // var_dump($arr);
        // die();

        $this->load->view('dashboard/template/dashboard_header', $data);
        $this->load->view('dashboard/pemohon/monitoring_pemohon', $arr);
        $this->load->view('dashboard/template/dashboard_footer');
    }


    public function downloadDokumen()
	{

        $this->load->helper('download');

        $id_dokumen = $this->uri->segment(4);

        
        $this->db->select('path, count, jenis_dokumen');
        $this->db->from('dokumen');
        $this->db->where('id', $id_dokumen);
        $query = $this->db->get()->row();

        // print "<pre>";
        // print_r($query->path);
        // die();

        if($query->count >= 3){

             $arr_flashdata = array(
                        'type' => 'warning',
                        'title' => 'Erorr!',
                        'messages' => 'Dokumen sudah mencapai batas max download!',
                    );

            $this->session->set_flashdata('alert', $arr_flashdata);

            redirect_back();

        }

        $path = $query->path;

        $extFile = pathinfo($path);

        $file = file_get_contents($path);

        $filename = $query->jenis_dokumen . '_' . $this->session->userdata('nama') . '.' . $extFile['extension'];
        

        // print "<pre>";
        // var_dump($path);
        // var_dump($filename);
        // // var_dump($file);
        // die();

        $this->db->set('count', 'count+1', FALSE);
        $this->db->where('id', $id_dokumen);
        $this->db->update('dokumen');

        force_download($filename,$file,TRUE);
        // redirect(base_url($path));

    }
    
    public function konfirmasi()
    {
        $konfirmasi = $this->uri->segment(3);
        $id_permohonan = $this->uri->segment(4);

        if($konfirmasi == 'selesai'){

            $this->db->set('selesai', 1);
            $this->db->where('id', $id_permohonan);
            $this->db->update('permohonan');

        } elseif($konfirmasi == 'sampai'){

            $this->load->model('Progress');

            $progress = array(
                'user_id' => $this->session->userdata('id'),
                'permohonan_id' => $id_permohonan,
                'status' => 7,
                'created_at' => date('Y-m-d H:i:s'),
            );

            $this->Progress->insert($progress);

            $this->db->set('status', 7);
            $this->db->where('id', $id_permohonan);
            $this->db->update('permohonan');

        } else {

            // url error

            redirect_back();
        }


        //notifikasi sukses

        redirect_back();
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

        // get data button download
        $query = $this->db->query("SELECT * FROM master_dokumen WHERE jenis_dokumen = 'Legalisir' AND `status` = 1;");

        $buttonSurat = array('buttons' => $query->result());

        $this->load->view('dashboard/template/dashboard_header', $data);
        $this->load->view('dashboard/pemohon/legalisir/legalisir_pemohon', $buttonSurat);
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

        if ($this->session->userdata('tahun_abdi') < 4) {

            $this->load->view('dashboard/template/dashboard_header', $data);
            $this->load->view('dashboard/error/error_tahun_abdi');
            $this->load->view('dashboard/template/dashboard_footer');
        } else {


            $this->load->view('dashboard/template/dashboard_header', $data);
            $this->load->view('dashboard/pemohon/lainnya_pemohon');
            $this->load->view('dashboard/template/dashboard_footer');
        }
    }
}
