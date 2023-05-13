<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pangkatcatatan_model extends CI_Model
{
	
	private static $_table = 'pangkat_catatan';
    private static $_pk = 'pct_id';
    
    // public function is_exist($where)
	// {
	// 	return $this->db->where($where)->get(self::$_table)->row_array();
	// }

	public function get_pangkatcatatan($where)
	{
		$query = $this->db
			->select('pangkat_catatan.id_user as id_user, user.usr_nama as usr_nama, pangkat_catatan.id_pangkat as id_pangkat, pangkat.pkt_nama as pkt_nama, pangkat_catatan.pct_tmt as pct_tmt, pangkat_catatan.pct_skpangkat as pct_skpangkat, pangkat_catatan.pct_status as pct_status, pangkat_catatan.pct_tgl_naikpangkat as pct_tgl_naikpangkat')
			->from(self::$_table)
			->join('user', 'user.usr_id = pangkat_catatan.id_user', 'inner')
			->join('pangkat', 'pangkat.pkt_id = pangkat_catatan.id_pangkat', 'inner')
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

	public function get_all_pangkat()
	{
		return $this->db->get('pangkat')->result_array();
	}

	public function get_pangkat()
	{
		return $this->db->get('pangkat')->row_array();
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
		return $this->db->delete(self::$_table, array('pct_id' => $id));
	}
}