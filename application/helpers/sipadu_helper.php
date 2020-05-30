<?php

function sudah_login()
{

    $ci = get_instance();

    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);

        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}

function permohonanOnProgress($id)
{
    $CI = &get_instance();
    
    // echo "<pre>";
    // var_dump($ci->session->userdata('email'));
    // die();
    
    $CI->db->select('count(id) as id');
    $CI->db->from('permohonan');
    $CI->db->where('user_id', $id);
    $CI->db->where('selesai !=', 1);
    $query = $CI->db->get()->result_array();

    $count = $query[0]["id"];

    // $count = $CI->permohonan->getActive($id);

    if($count > 0){

        $arr_flashdata = array(
            'type' => 'notice',
            'title' => 'Warning!',
            'messages' => 'Anda masih memiliki permohonan aktif!',
        );

        $CI->session->set_flashdata('alert', $arr_flashdata);

        redirect_back();
        // die("ANDA MASIH MEMILIKI PERMOHONAN AKTIF");
    }

}

function redirect_back()
    {
        if(isset($_SERVER['HTTP_REFERER']))
        {
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
        else
        {
            header('Location: http://'.$_SERVER['SERVER_NAME']);
        }
        exit;
    }

function maskNip($nip_kasar){

//mask nip agar ada pisah pisah nya

    $nipKasar = str_split($nip_kasar);
    
    
    $i = 0;
    $space = 1;
    $nip = '';
    while($i < sizeof($nipKasar)){

        if($i <= 7){
            $nip .= $nipKasar[$i];
            $i++;
        } else if($i == 8 && $space == 1){
            $nip .= ' ';
            $space++;
        } else if($i <= 14){
            $nip .= $nipKasar[$i];
            $i++;
        } else if($i == 15 && $space == 2){
            $nip .= ' ';
            $space++;
        } else if($i == 15){
            $nip .= $nipKasar[$i];
            $i++;
        } else if($i == 16 && $space == 3){
            $nip .= ' ';
            $space++;
        } else if($i <= 18) {
            $nip .= $nipKasar[$i];
            $i++;
        }

    }

    return $nip;

}
