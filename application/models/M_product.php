<?php

use GuzzleHttp\Client;

class M_product extends CI_Model
{
	private $_table = 'tbl_barang_masuk';
	private $_client;

	public function __construct()
	{
		$this->_client = new Client([
			'base_uri'  => 'http://localhost/rest-api/wpu-rest-server/projectinventory/api/'
		]);
	}

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

	public function listProduct()
	{
		$sql = $this->db->query("SELECT Distinct kode_barang, 
								nama_barang
						  	FROM tbl_barang_masuk");
		$query = $sql->result();
		return $query; 
	}

	public function getCategoryByIdAPI()
	{
		$response = $this->_client->request('GET', 'category', [
			'query' => [
				'key' => 'inv123'
				//'id' => $id
			]
		]);

		$result = json_decode($response->getBody()->getContents(), true);

		return $result['data'];
	}

	public function getTypeByIdAPI()
	{
		$response = $this->_client->request('GET', 'type', [
			'query' => [
				'key' => 'inv123'
				//'id' => $id
			]
		]);

		$result = json_decode($response->getBody()->getContents(), true);

		return $result['data'];
	}
}