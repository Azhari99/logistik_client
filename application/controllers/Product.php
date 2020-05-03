<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('m_product');
    }

    public function index() 
    {
    	$this->template->load('overview', 'product/vProduct');
    }

    public function getAll() 
    {
        $list = $this->m_product->list();
        $number = 1;
        $data = array();
        foreach ($list as $value) {
            $row = array();
            $row[] = $number++;
            $row[] = $value->kode_barang;
            $row[] = $value->nama_barang;
            $row[] = $value->jumlah;
            
            if($value->stat == '1'){
                $row[] = '<center><span class="label label-success">Completed</span></center>';
            } else {
                $row[] = '<center><span class="label label-danger">Not Yet Completed</span></center>';
            }
            $data[] = $row;
        }
        $result = array('data' => $data );
        echo json_encode($result);
    }
}