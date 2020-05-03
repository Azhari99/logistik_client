<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductOut extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('m_productout');
        $this->load->model('m_product');
        //$this->load->model('m_institute');
    }

    public function index() 
    {
    	$this->template->load('overview', 'product_out/vPOut');
    }

    public function getAll() 
    {
        $list = $this->m_productout->list();
        $number = 1;
        $data = array();
        foreach ($list as $value) {
            $row = array();
            $product = $value->nama_barang;
            $institute = $value->nama_instansi;
            $row[] = $number++;
            $row[] = $value->documentno;
            $row[] = $product;
            $row[] = $institute;
            $row[] = date('d-m-Y',strtotime($value->datetrx));
            if ($value->nama_barang == "DANA") {
                $row[] = "-";
            } else {
                $row[] = $value->qtyentered;
            }
            
            $row[] = $value->keterangan;
            
            if($value->status == 'CO'){
                $row[] = '<center><span class="label label-success">Proses</span></center>';
                $row[] = '<center>            
                            <a class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                        </center>';
            } else {
                $row[] = '<center><a href="javascript:void(0)" onclick="completeProductOut('."'".$value->tbl_permintaan_id."'".')" title="Proses"><span class="label label-warning">Drafted</span></a></center>';
                $row[] = '<center>            
                            <a class="btn btn-primary btn-xs" href="productout/edit/'.$value->tbl_permintaan_id.'" title="Edit"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-danger btn-xs"  onclick="deleteProductOut('."'".$value->tbl_permintaan_id."'".')" title="Delete"><i class="fa fa-trash-o"></i></a>
                        </center>';
            }
            $data[] = $row;
        }
        $result = array('data' => $data );
        echo json_encode($result);
    }

    public function add()
    {
        $data['product'] = $this->m_productout->listProductApi();
        $data['institute'] = $this->m_productout->listInstituteApi();
        $data['code'] = $this->m_productout->generateCode();
    	$this->template->load('overview', 'product_out/addPOut', $data);
    }

    public function getProductType()
    {
        $id = $this->input->post('id');
        $data = $this->m_productout->getDataApiByID($id);
        echo json_encode($data);
    }
    
    public function actAdd()
    {
        $this->form_validation->set_rules('product_out','product','required');
        $this->form_validation->set_rules('institute_out','institute','required');
        $this->form_validation->set_rules('datetrx_out','date transaction','required');
        
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        $code = $this->input->post('code_out');
        $product = $this->input->post('product_out');
        $institute = $this->input->post('institute_out');
        $date = explode('/', $this->input->post('datetrx_out'));
        $qty = $this->input->post('qty_out');
        $desc = $this->input->post('desc_out');

        $trxDay =  $date[0];
        $trxMonth =  $date[1];
        $trxYear =  $date[2];
        $datetrx = ($trxYear.'-'.$trxMonth.'-'.$trxDay);
        
        $produtDetail = $this->m_productout->getDataApiByID($product);
        $instansiDetail = $this->m_productout->getInstansiByIdAPI($institute);

        $namaProduct = $produtDetail[0]['name'];
        $namaInstansi = $instansiDetail[0]['name'];
        // var_dump($namaProduct,$namaInstansi);
        // die;
        if ($this->form_validation->run() == FALSE) {
            $data['product'] = $this->m_productout->listProductApi();
            $data['institute'] = $this->m_productout->listInstituteApi();
            $data['code'] = $this->m_productout->generateCode();
            $this->template->load('overview', 'product_out/addPOut', $data);

        } else {
            if ($qty <= $produtDetail[0]['qtyavailable']) {
                $param_out = array(
                                'documentno'        => $code,
                                'datetrx'           => $datetrx,
                                'tbl_barang_id'     => $product,
                                'nama_barang'       => $namaProduct,
                                'tbl_instansi_id'   => $institute,
                                'nama_instansi'     => $namaInstansi,
                                'qtyentered'        => $qty,
                                'status'            => 'DR',
                                'keterangan'        => $desc
                        );
                $this->m_productout->save($param_out);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible fade in" role="alert">'.
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>'.
                    '</button>'.
                    'Data berhasil disimpan</div>');
                }
                echo "<script>window.location='".site_url('productout')."';</script>";
            } else {
                $this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissible fade in" role="alert">'.
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>'.
                '</button>'.
                'Total Quantity product : '.$produtDetail->qtyavailable.'</div>');
                echo "<script>window.location='".site_url('productout')."';</script>";
            }
        }
    }

    public function edit($id)
    {
        $data['product_out_id'] = $id;
        $data['product'] = $this->m_productout->listProductApi();
        $data['institute'] = $this->m_productout->listInstituteApi();
        $this->template->load('overview', 'product_out/editPOut', $data);
    }

    public function get_data_edit()
    {
        $product_out_id = $this->input->post('id');
        $data = $this->m_productout->detail($product_out_id)->result();
        echo json_encode($data);
    }

    public function actEdit()
    {
        $this->form_validation->set_rules('product_out','product','required');
        $this->form_validation->set_rules('institute_out','institute','required');
        $this->form_validation->set_rules('datetrx_out','date transaction','required');
        
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        $id_barang_out = $this->input->post('id_barang_out');
        $code = $this->input->post('code_out');
        $product = $this->input->post('product_out');
        $institute = $this->input->post('institute_out');
        $date = explode('/', $this->input->post('datetrx_out'));
        $qty = $this->input->post('qty_out');
        $desc = $this->input->post('desc_out');

        $trxDay =  $date[0];
        $trxMonth =  $date[1];
        $trxYear =  $date[2];
        $datetrx = ($trxYear.'-'.$trxMonth.'-'.$trxDay);
        
        $produtDetail = $this->m_productout->getDataApiByID($product);
        $instansiDetail = $this->m_productout->getInstansiByIdAPI($institute);

        $namaProduct = $produtDetail[0]['name'];
        $namaInstansi = $instansiDetail[0]['name'];

        if ($this->form_validation->run() == FALSE) {
            $data['product_out_id'] = $id_barang_out;
            $data['product'] = $this->m_productout->listProductApi();
            $data['institute'] = $this->m_productout->listInstituteApi();
            $this->template->load('overview', 'product_out/editPOut', $data);

        } else {
            if ($qty <= $produtDetail[0]['qtyavailable']) {
                $param_out = array(
                                'documentno'        => $code,
                                'datetrx'           => $datetrx,
                                'tbl_barang_id'     => $product,
                                'nama_barang'       => $namaProduct,
                                'tbl_instansi_id'   => $institute,
                                'nama_instansi'     => $namaInstansi,
                                'qtyentered'        => $qty,
                                'status'            => 'DR',
                                'keterangan'        => $desc,
                                'updated'           => date('Y-m-d H:i:s')
                        );
                $where_out = array('tbl_permintaan_id' => $id_barang_out);
                $this->m_productout->update($param_out, $where_out);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible fade in" role="alert">'.
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>'.
                    '</button>'.
                    'Data berhasil diubah</div>');
                }
                echo "<script>window.location='".site_url('productout')."';</script>";
            } else {
                $this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissible fade in" role="alert">'.
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>'.
                '</button>'.
                'Total Quantity product : '.$produtDetail->qtyavailable.'</div>');
                
                echo "<script>window.location='".site_url('productout')."';</script>";
            }
        }
    }

    public function actComplete($id)
    {
        $get_detail = $this->m_productout->detail($id)->row();

        $noDoc = $get_detail->documentno;
        $idBarang = $get_detail->tbl_barang_id;
        $idInstansi = $get_detail->tbl_instansi_id;
        $datetrx = $get_detail->datetrx;
        //$statusA = $get_detail->status;
        $qty_out = $get_detail->qtyentered;
        $keterangan = $get_detail->keterangan;
        
            $param_permintaan = array(
                    'status' => 'CO'
                );

            $dataApi = array(
                'documentno' => $noDoc,
                'tbl_barang_id' => $idBarang,
                'tbl_instansi_id' => $idInstansi,
                'datetrx' => $datetrx,
                'status' => 'DR',
                'qtyentered' => $qty_out,
                'keterangan' => $keterangan,
                'key' => "inv123"
            );

            $where_permintaan = array('tbl_permintaan_id' => $id);

            $this->m_productout->update($param_permintaan, $where_permintaan);
            $this->m_productout->savePermintaanApi($dataApi);
            $data = array('success' => 'berhasil');
        
        echo json_encode($data);
    }

    public function delete($id)
    {
        $data = $this->m_productout->delete($id);
        echo json_encode($data);
    }
}