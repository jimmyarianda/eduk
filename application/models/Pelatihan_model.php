<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelatihan_model extends CI_Model
{
	
	private static $_table = 'pelatihan';
    private static $_pk = 'plt_id';
    
    // public function is_exist($where)
	// {
	// 	return $this->db->where($where)->get(self::$_table)->row_array();
	// }

	public function get_pelatihan($where)
	{
		$query = $this->db
			->select('pelatihan.id_user as id_user, user.usr_nama as usr_nama, pelatihan.plt_nama as plt_nama, pelatihan.plt_tgl_pelatihan as plt_tgl_pelatihan, pelatihan.plt_sertifikat as plt_sertifikat')
			->from(self::$_table)
			->join('user', 'user.usr_id = pelatihan.id_user', 'inner')
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
		return $this->db->delete(self::$_table, array('plt_id' => $id));
	}
}