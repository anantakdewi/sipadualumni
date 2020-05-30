<?php
defined('BASEPATH') or exit('No direct script access allowed');

class list_permohonan extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->library('form_validation');

        $this->load->model('List_permohonan_model', 'list_permohonan');

        if (is_null($this->session->userdata('email'))) {
            redirect((base_url('auth/login')));
        };
    }

    public function lihatList()
    {
        // LOAD EVERYTHING HERE //
        $this->load->model('List_permohonan_model', 'list_permohonan');
        $this->load->library('pagination');

        // CHECK URL FOR PAGINATION 
        $type = $this->uri->segment(3);

        switch ($type) {

            case "baru":

                $data = array(
                    'nav_data' => 'permohonan baru',
                    'title' => 'Daftar Permohonan',
                    'breadcumb' => array('', ''),
                    'small_title' => 'Permohonan Baru',
                );

                $statusPermohonan = ['1'];
                $list['headerBox'] = "Permohonan Baru";

                // print "<pre>";
                // var_dump($statusPermohonan);
                // die;

                $config['base_url'] = base_url('petugas/monitoring/baru');
                break;

            case "sedangProses":

                $data = array(
                    'nav_data' => 'permohonan baru',
                    'title' => 'Daftar Permohonan',
                    'breadcumb' => array('', ''),
                    'small_title' => 'Permohonan dalam Proses',
                );

                $statusPermohonan = ['2', '4', '5'];
                $list['headerBox'] = "Permohonan dalam Proses";

                $config['base_url'] = base_url('petugas/monitoring/sedangProses');
                break;

            case "selesai":

                $data = array(
                    'nav_data' => 'permohonan baru',
                    'title' => 'Daftar Permohonan',
                    'breadcumb' => array('', ''),
                    'small_title' => 'Permohonan Selesai',
                );

                $list['headerBox'] = "Permohonan Selesai";

                $config['base_url'] = base_url('petugas/monitoring/selesai');
                break;
        }

        // $config['base_url'] = 'http://localhost/sipadualumni/petugas/list_permohonan/lihatList/';

        if($type == "selesai"){

            $this->db->from('permohonan');
            $this->db->where('selesai', 1);
            $selesaiCount = $this->db->count_all_results();

            $config['total_rows'] = $selesaiCount;

        } else {

            $config['total_rows'] = $this->list_permohonan->countAllList_permohonan($statusPermohonan);

        }
        
        $config['per_page'] = 10;

        //custom
        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = ' </ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');

        //inisiasi
        $this->pagination->initialize($config);

        $list['start'] = $this->uri->segment(4);

        if($type == "selesai"){

            $this->db->select('users.nama, users.email, permohonan.id as permohonan_id, permohonan.jenis_permohonan, permohonan.nama_permohonan, permohonan.status, permohonan.read');
            $this->db->from('permohonan');
            $this->db->join('users', 'permohonan.user_id = users.id');
            $this->db->where_in('selesai', 1);
            $this->db->limit($config['per_page'], $list['start']);
            $this->db->order_by('permohonan.created_at', 'DESC');
            $list['list_permohonan'] = $this->db->get()->result_array();

        } else {
            
            $list['list_permohonan'] = $this->list_permohonan->getList_permohonan($config['per_page'], $list['start'], $statusPermohonan);

        }
        
       
        // print "<pre>";
        // print_r($list['list_permohonan']);
        // die();

        $this->load->view('dashboard/template/dashboard_header2', $data);
        $this->load->view('dashboard/petugas/monitoring/monitoring_petugas', $list);
        $this->load->view('dashboard/template/dashboard_footer');
    }
}
