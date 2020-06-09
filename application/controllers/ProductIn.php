<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductIn extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('m_productin');
        //$this->load->model('m_product');
        $this->load->library('upload');
    }

    public function index() 
    {
    	$this->template->load('overview', 'product_in/vPIn');
    }

    public function getAll() 
    {
        $list = $this->m_productin->list();
        $number = 1;
        $data = array();
        foreach ($list as $value) {
            $row = array();
            $product = $value->kode_barang.'-'.$value->nama_barang;
            $linkDownload = $value->pathDownload;
            $row[] = $number++;
            $row[] = $value->documentno;
            $row[] = $product;
            $row[] = $value->instansi;
            if ($value->nama_barang == "DANA")
            {
                $row[] = "-";
            } else {
                $row[] = $value->jumlah;
            }
            $row[] = rupiah($value->amount);
            $row[] = date('d-m-Y',strtotime($value->tgl_barang_masuk));
            $row[] = $value->keterangan;
            
            if($value->stat == '1'){
                $row[] = '<center><span class="label label-success">Completed</span></center>';
                if (!empty($linkDownload)) {
                    $row[] = '<center>            
                            <a class="btn btn-primary btn-xs" href="' . $linkDownload . '" title="Download"><i class="fa fa-download"></i></a>
                        </center>';
                } else {
                    $row[] = '';
                }
                
            } else {
                $row[] = '<center><a href="javascript:void(0)" onclick="completeProductIn('."'".$value->id_barang_masuk."'".')" title="Proses"><span class="label label-warning">Drafted</span></a></center>';
                $row[] = '<center>            
                            <a class="btn btn-primary btn-xs" href="productin/edit/'.$value->id_barang_masuk.'" title="Edit"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-danger btn-xs"  onclick="deleteProductIn('."'".$value->id_barang_masuk."'".')" title="Delete"><i class="fa fa-trash-o"></i></a>
                        </center>';
            }
            $data[] = $row;
        }
        $result = array('data' => $data );
        echo json_encode($result);
    }
}