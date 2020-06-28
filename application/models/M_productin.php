<?php

class M_productin extends CI_Model
{
	private $_table = 'tbl_barang_masuk';

	public function list()
	{
		$this->db->select('tbl_barang_masuk.id_barang_masuk,
							tbl_barang_masuk.documentno,
							tbl_barang_masuk.kode_barang,
							tbl_barang_masuk.nama_barang,
							tbl_barang_masuk.instansi,
							tbl_barang_masuk.jumlah,
							tbl_barang_masuk.amount,
							tbl_barang_masuk.tgl_barang_masuk,
							tbl_barang_masuk.keterangan,
							tbl_barang_masuk.stat,
							tbl_barang_masuk.pathDownload');
		$this->db->from($this->_table);
		//$this->db->join('tbl_barang', 'tbl_barang.tbl_barang_id = '.$this->_table.'.tbl_barang_id', 'Left');
		$query = $this->db->get()->result();
		return $query;
	}

	public function listProductOut($options, $id, $date_start, $date_end)
	{
		$this->db->select('tbl_barang_masuk.*');
		$this->db->from($this->_table);
		$this->db->where('tbl_barang_masuk.tgl_barang_masuk BETWEEN "'.$date_start.'"AND"'.$date_end.'"');
		if ($options == "product" && !empty($id)){
			$this->db->where('kode_barang', $id);
		} else if ($options == "category" && !empty($id)){
			$this->db->where('kategori_id', $id);
		} else {
			if (!empty($id)){
				$this->db->where('jenis_id', $id);
			}
		}
		$query = $this->db->get()->result();
		return $query;
	}

	public function save($data)
	{		
		$this->db->insert($this->_table, $data);
	}

	public function update($data, $where)
	{
		$this->db->where($where);
		$this->db->update($this->_table, $data);
	}

	public function detail($id)
	{
		return $this->db->get_where($this->_table, array('tbl_barangmasuk_id' => $id));
	}

	public function delete($id)
	{
		return $this->db->delete($this->_table, array('tbl_barangmasuk_id' => $id));
	}

	public function generateCode() 
	{		
		$firstCode = "PIN"; //karakter depan kodenya
		$lastCode = ""; //kode awal
		$separtor = '-';
        $sql = $this->db->query("SELECT MAX(RIGHT(documentno,4)) AS maxcode 
        						FROM ".$this->_table);
        
        if( $sql->num_rows() > 0 ) {
            foreach($sql->result() as $value) {
                $intCode = ((int)$value->maxcode) + 1;
                $lastCode = sprintf("%04s", $intCode);
            }

        } else {
            $lastCode = "0001";
        }
        return $firstCode.$separtor.$lastCode;
   }

   public function totalQtyProductIn($id, $datetrx) 
   {
   		$param = array(
   				'tbl_barang_id' 				=> $id,
   				'DATE_FORMAT(datetrx, "%Y") ='	=> $datetrx
   				// 'status'						=> 'CO'
   			);
   		$this->db->select_sum('qtyentered');
   		$this->db->where($param);
   		$this->db->from($this->_table);
   		return $this->db->get()->row();
   }

   	public function totalProductIn()
	{
		$this->db->from($this->_table);
		$query = $this->db->count_all_results();
		return $query;
	}

	public function budgetProductIn($year)
	{
		$this->db->select_sum('amount');
		$this->db->from($this->_table);
		$this->db->where('DATE_FORMAT(tgl_barang_masuk, "%Y") =', $year);
		return $this->db->get()->row();
	}
}