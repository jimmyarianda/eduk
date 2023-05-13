<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatancatatan_model extends CI_Model
{
	
	private static $_table = 'jabatan_catatan';
    private static $_pk = 'jct_id';
    
    // public function is_exist($where)
	// {
	// 	return $this->db->where($where)->get(self::$_table)->row_array();
	// }

	public function get_jabatancatatan($where)
	{
		$query = $this->db
			->select('jabatan_catatan.id_user as id_user, user.usr_nama as usr_nama, jabatan_catatan.id_jabatan as id_jabatan, jabatan.jbt_nama as jbt_nama, jabatan_catatan.jct_tmt as jct_tmt, jabatan_catatan.jct_skjabatan as jct_skjabatan, jabatan_catatan.jct_status as jct_status, jabatan_catatan.jct_keterangan as jct_keterangan')
			->from(self::$_table)
			->join('user', 'user.usr_id = jabatan_catatan.id_user', 'inner')
			->join('jabatan', 'jabatan.jbt_id = jabatan_catatan.id_jabatan', 'inner')
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

	public function get_all_jabatan()
	{
		return $this->db->get('jabatan')->result_array();
	}

	public function get_jabatan()
	{
		return $this->db->get('jabatan')->row_array();
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
		return $this->db->delete(self::$_table, array('jct_id' => $id));
	}
}