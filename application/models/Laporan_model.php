<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
	
	private static $_table = 'laporan';
    private static $_pk = 'lap_id';
    
    // public function is_exist($where)
	// {
	// 	return $this->db->where($where)->get(self::$_table)->row_array();
	// }

    //UNTUK EDIT INI (SOON)
	public function get_laporan($where)
	{
		$query = $this->db
			->select('laporan.id_unit as id_unit, laporan.id_user as id_user, unit.un_nama as un_nama, laporan.lap_tempat as lap_tempat, user.usr_nama as usr_nama, laporan.lap_periode as lap_periode, laporan.lap_tgl as lap_tgl, laporan.lap_jeniskeg as lap_jeniskeg, laporan.lap_uraiankeg as lap_uraiankeg, laporan.lap_saran_thlit as lap_saran_thlit, laporan.lap_saran_kasum as lap_saran_kasum, laporan.lap_saran_pimpinan as lap_saran_pimpinan')
			->from(self::$_table)
			->join('unit', 'unit.un_id = laporan.id_unit', 'inner')
			->join('user', 'user.usr_id = laporan.id_user', 'inner')
			->where($where)
			->get();

		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return NULL;
		}
	}

	public function get_unit()
	{
		return $this->db->get('unit')->result_array();
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
		return $this->db->delete(self::$_table, array('lap_id' => $id));
	}
}