<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pangkat_model extends CI_Model
{
	
	private static $_table = 'pangkat';
    private static $_pk = 'pkt_id';
    
    // public function is_exist($where)
	// {
	// 	return $this->db->where($where)->get(self::$_table)->row_array();
	// }

	public function get_pangkat($where)
	{
		return $this->db->where($where)->get(self::$_table)->row_array();
	}

    public function get_user()
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
		return $this->db->delete(self::$_table, array('pkt_id' => $id));
	}
}