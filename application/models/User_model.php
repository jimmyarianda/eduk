<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    
    private static $_table = 'user';
    private static $_pk = 'usr_id';
    
    public function is_exist($where)
    {
        return $this->db->where($where)->get(self::$_table)->row_array();
    }

    public function get_user($where) 
    {
        return $this->db->where($where)->get(self::$_table)->row_array();
    }

    public function insert($data) 
    {
        return $this->db->insert(self::$_table, $data);
    }
    
    public function update($data, $usr_id) 
    {
        return $this->db->set($data)->where(self::$_pk, $usr_id)->update(self::$_table);
    }

    public function delete($id)
	{
		return $this->db->delete(self::$_table, array('usr_id' => $id));
	}
}