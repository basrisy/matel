<?php

function activity_log($aksi, $user, $level, $new_level, $tgl_berakhir){
    $CI =& get_instance();

    $param['admin'] = $CI->session->userdata('nama');
    $param['aksi'] = $aksi;
    $param['user'] = $user;
    $param['level'] = $level;
    $param['new_level'] = $new_level;
    $param['tgl_berakhir']= $tgl_berakhir;

    //load model log
    $CI->load->model('m_log');

    //save to database
    $CI->m_log->save_log($param);

}
?> 