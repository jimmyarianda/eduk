<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kgajicatatan_model extends CI_Model
{

    private static $_table = 'kgaji_catatan';
    private static $_pk = 'gct_id';

    // public function is_exist($where)
    // {
    // 	return $this->db->where($where)->get(self::$_table)->row_array();
    // }

    public function get_kgajicatatan($where)
    {
        $query = $this->db
            ->select('kgaji_catatan.id_user as id_user, user.usr_nama as usr_nama, kgaji_catatan.gct_tmt as gct_tmt, kgaji_catatan.gct_skkenaikangaji as gct_skkenaikangaji, kgaji_catatan.gct_tgl_naikgaji as gct_tgl_naikgaji')
            ->from(self::$_table)
            ->join('user', 'user.usr_id = kgaji_catatan.id_user', 'inner')
            ->where($where)
            ->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return NULL;
        }
    }

    public function get_all_user()
    {
        return $this->db->get('user')->result_array();
    }

    public function get_user()
    {
        return $this->db->get('user')->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert(self::$_table, $data);
    }

    public function update($data, $id)
    {
        return $this->db->set($data)->where(self::$_pk, $id)->update(self::$_table);
    }

    public function delete($id)
    {
        return $this->db->delete(self::$_table, array('gct_id' => $id));
    }
}
