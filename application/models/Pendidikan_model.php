<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendidikan_model extends CI_Model
{
	
	private static $_table = 'pendidikan';
    private static $_pk = 'pd_id';
    
    // public function is_exist($where)
	// {
	// 	return $this->db->where($where)->get(self::$_table)->row_array();
	// }

	public function get_pendidikan($where)
	{
		$query = $this->db
			->select('pendidikan.id_user as id_user, user.usr_nama as usr_nama, pendidikan.pd_jenjang_pendidikan as pd_jenjang_pendidikan, pendidikan.pd_nama as pd_nama, pendidikan.pd_tahun_lulus as pd_tahun_lulus, pendidikan.pd_ijazah as pd_ijazah')
			->from(self::$_table)
			->join('user', 'user.usr_id = pendidikan.id_user', 'inner')
			->where($where)
			->get();

		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return NULL;
		}
	}

	//melakukan add persesion
    public function get_user_session($where)
	{
		return $this->db->where($where)->get('user')->row_array();
	}

	public function get_user()
	{
		return $this->db->get('user')->row_array();
	}

	public function get_all_user()
	{
		return $this->db->get('user')->result_array();
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
		return $this->db->delete(self::$_table, array('pd_id' => $id));
	}
}