<?php

class M_product extends CI_Model
{
	private $_table = 'tbl_barang_masuk';

	public function list()
	{
		$sql = $this->db->query("SELECT kode_barang, 
								nama_barang, 
								SUM(jumlah) as jumlah,
								SUM(amount) AS budget,
								stat
						  	FROM tbl_barang_masuk 
							GROUP BY kode_barang, nama_barang, stat");
		$query = $sql->result();
		return $query;
	}
}