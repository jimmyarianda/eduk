<?php defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('notifikasi_kenaikanpangkat')) {
    function notifikasi_kenaikanpangkat()
    {
        //untuk pendeklaraasian db secara global
        $CI = &get_instance();

        $query = $CI->db
            ->select('user.usr_nama as usr_nama, pangkat_catatan.pct_tgl_naikpangkat as tgl_naikpangkat')
            ->from('pangkat_catatan')
            ->join('user', 'user.usr_id = pangkat_catatan.id_user', 'inner')
            ->order_by('tgl_naikpangkat', 'desc')
            ->limit(5)
            ->get();

        $result = [];
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
        } else {
            $result = NULL;
        }

        return $result;
    }
}

if (!function_exists('notifikasi_kenaikangaji')) {
    function notifikasi_kenaikangaji()
    {
        //untuk pendeklaraasian db secara global
        $CI = &get_instance();

        $query = $CI->db
            ->select('user.usr_nama as usr_nama, kgaji_catatan.gct_tgl_naikgaji as tgl_naikgaji')
            ->from('kgaji_catatan')
            ->join('user', 'user.usr_id = kgaji_catatan.id_user', 'inner')
            ->order_by('tgl_naikgaji', 'desc')
            ->limit(5)
            ->get();

        $result = [];
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
        } else {
            $result = NULL;
        }

        return $result;
    }
}
