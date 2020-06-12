<?php

use GuzzleHttp\Client;

class M_requestout extends CI_Model
{
	private $_table = 'tbl_permintaan';
	private $_client;

	public function __construct()
	{
		$this->_client = new Client([
			'base_uri'  => 'http://localhost/rest-api/wpu-rest-server/projectinventory/api/'
		]);
	}

	public function list()
	{
		$this->db->select('tbl_permintaan.tbl_permintaan_id,
							tbl_permintaan.documentno,
							tbl_permintaan.datetrx,
							tbl_permintaan.status,
							tbl_permintaan.qtyentered,
							tbl_permintaan.amount,
							tbl_permintaan.keterangan,
							tbl_permintaan.created,
							tbl_permintaan.nama_barang,
							tbl_permintaan.nama_instansi,
							tbl_permintaan.file');
		$this->db->from($this->_table);
		//$this->db->join('tbl_barang', 'tbl_barang.tbl_barang_id = '.$this->_table.'.tbl_barang_id', 'Left');
		//$this->db->join('tbl_instansi', 'tbl_instansi.tbl_instansi_id = '.$this->_table.'.tbl_instansi_id', 'Left');
		$query = $this->db->get()->result();
		return $query;
	}

	public function save($data)
	{
		$this->db->insert($this->_table, $data);
	}

	public function savePermintaanApi($dataApi)
	{
		$response = $this->_client->request('POST', 'permintaan', [
			'form_params' => $dataApi
		]);

		$result = json_decode($response->getBody()->getContents(), true);

		return $result;
	}

	public function getBudgetApi($type_id, $trxYear)
	{
		$response = $this->_client->request('GET', 'budget', [
			'query' => [
				'key' => 'inv123',
				'jenis_id' => $type_id,
				'tahun' => $trxYear
			]
		]);

		$result = json_decode($response->getBody()->getContents(), true);

		return $result['data'];
	}

	public function totalBudgetProductOut($id_product, $trxYear, $amount)
	{
		$response = $this->_client->request('GET', 'barangkeluar', [
			'query' => [
				'key' => 'inv123',
				'tbl_barang_id' => $id_product,
				'datetrx' => $trxYear,
				'status' => 'CO',
				'amount' => $amount
			]
		]);

		$result = json_decode($response->getBody()->getContents(), true);

		return $result['data'];
	}

	public function totalBudgetInstituteProductOut($institute, $trxYear, $amount)
	{
		$response = $this->_client->request('GET', 'barangkeluar', [
			'query' => [
				'key' => 'inv123',
				'tbl_instansi_id' => $institute,
				'datetrx' => $trxYear,
				//'status' => 'CO',
				'amount' => $amount
			]
		]);

		$result = json_decode($response->getBody()->getContents(), true);

		return $result['data'];
	}

	public function totalQtyProductOut($id_product, $trxYear, $amount)
	{
		$response = $this->_client->request('GET', 'barangkeluar', [
			'query' => [
				'key' => 'inv123',
				'tbl_barang_id' => $id_product,
				'datetrx' => $trxYear,
				'status' => 'DR',
				'amount' => $amount
			]
		]);

		$result = json_decode($response->getBody()->getContents(), true);

		return $result['data'];
	}

	public function listProductApi()
	{
		$response = $this->_client->request('GET', 'masterbarang', [
			'query' => [
				'key' => 'inv123'
			]
		]);

		$result = json_decode($response->getBody()->getContents(), true);

		return $result['data'];
	}

	public function getDataApiByID($id)
	{
		$response = $this->_client->request('GET', 'masterbarang', [
			'query' => [
				'key' => 'inv123',
				'id' => $id
			]
		]);

		$result = json_decode($response->getBody()->getContents(), true);

		return $result['data'];
	}

	public function listInstituteApi()
	{
		$response = $this->_client->request('GET', 'instansi', [
			'query' => [
				'key' => 'inv123',
				'id' => 3
			]
		]);

		$result = json_decode($response->getBody()->getContents(), true);

		return $result['data'];
	}

	public function getInstansiByIdAPI($id)
	{
		$response = $this->_client->request('GET', 'instansi', [
			'query' => [
				'key' => 'inv123',
				'id' => $id
			]
		]);

		$result = json_decode($response->getBody()->getContents(), true);

		return $result['data'];
	}

	public function update($data, $where)
	{
		$this->db->where($where);
		$this->db->update($this->_table, $data);
	}

	public function detail($id)
	{
		return $this->db->get_where($this->_table, array('tbl_permintaan_id' => $id));
	}

	public function delete($id)
	{
		return $this->db->delete($this->_table, array('tbl_permintaan_id' => $id));
	}

	public function generateCode()
	{
		$firstCode = "PROUT"; //karakter depan kodenya
		$lastCode = ""; //kode awal
		$separtor = '-';
		$sql = $this->db->query("SELECT MAX(RIGHT(documentno,4)) AS maxcode 
        						FROM " . $this->_table);

		if ($sql->num_rows() > 0) {
			foreach ($sql->result() as $value) {
				$intCode = ((int) $value->maxcode) + 1;
				$lastCode = sprintf("%04s", $intCode);
			}
		} else {
			$lastCode = "0001";
		}
		return $firstCode . $separtor . $lastCode;
	}

	public function totalRequestOut($id, $id_product, $datetrx)
	{
		if ($id == null) {
			$sql = $this->db->query("SELECT sum(rk.amount) as amount,
								sum(rk.qtyentered) as qtyentered
								FROM tbl_permintaan rk
								WHERE rk.tbl_barang_id = $id_product
								AND status = 'DR'
								AND YEAR(rk.datetrx) = $datetrx");
		} else {
			$sql = $this->db->query("SELECT sum(rk.amount) as amount,
								sum(rk.qtyentered) as qtyentered
								FROM tbl_permintaan rk
								WHERE rk.tbl_barang_id = $id_product
								AND status = 'DR'
								AND YEAR(rk.datetrx) = $datetrx
								AND rk.tbl_permintaan_id != $id ");
		}
		return $sql->row();
	}

	public function totalInstituteOut($id_pout, $id_institute, $datetrx)
	{
		if($id_pout == null){
			$sql = $this->db->query("SELECT sum(rk.amount) as amount
								FROM tbl_permintaan rk
								WHERE rk.tbl_instansi_id = $id_institute
								AND YEAR(rk.datetrx) = $datetrx");
		} else {
			$sql = $this->db->query("SELECT sum(rk.amount) as amount
								FROM tbl_permintaan rk
								WHERE rk.tbl_instansi_id = $id_institute
								AND YEAR(rk.datetrx) = $datetrx
								AND rk.tbl_permintaan_id != $id_pout ");
		}
		
		return $sql->row();
	}

	public function totalQtyProduct($id, $datetrx)
	{
		$param = array(
			'tbl_barang_id' => $id,
			'DATE_FORMAT(datetrx, "%Y") =' => $datetrx
		);
		$this->db->select_sum('qtyentered');
		$this->db->where($param);
		$this->db->from($this->_table);
		return $this->db->get()->row();
	}

	public function totalProductOut()
	{
		$this->db->from($this->_table);
		$query = $this->db->count_all_results();
		return $query;
	}
}
