<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RequestOut extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_requestout');
        $this->load->model('m_product');
        //$this->load->model('m_institute');
    }

    public function index()
    {
        $this->template->load('overview', 'request_out/vPOut');
    }

    public function getAll()
    {
        $list = $this->m_requestout->list();
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
            $row[] = date('d-m-Y', strtotime($value->datetrx));
            if ($value->nama_barang == "DANA") {
                $row[] = "-";
            } else {
                $row[] = $value->qtyentered;
            }
            $row[] = $value->amount;
            $row[] = $value->keterangan;

            if ($value->status == 'P') {
                $row[] = '<center><span class="label label-info">Proses</span></center>';
                $row[] = '';
            } else if ($value->status == 'CO') {
                $row[] = '<center><span class="label label-success">Complete</span></center>';
                $row[] = '';
            } else {
                $row[] = '<center><a href="javascript:void(0)" onclick="completeProductOut(' . "'" . $value->tbl_permintaan_id . "'" . ')" title="Proses"><span class="label label-warning">Drafted</span></a></center>';
                $row[] = '<center>            
                            <a class="btn btn-primary btn-xs" href="requestout/edit/' . $value->tbl_permintaan_id . '" title="Edit"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-danger btn-xs"  onclick="deleteProductOut(' . "'" . $value->tbl_permintaan_id . "'" . ')" title="Delete"><i class="fa fa-trash-o"></i></a>
                        </center>';
            }
            $data[] = $row;
        }
        $result = array('data' => $data);
        echo json_encode($result);
    }

    public function add()
    {
        $data['product'] = $this->m_requestout->listProductApi();
        $data['institute'] = $this->m_requestout->listInstituteApi();
        $data['code'] = $this->m_requestout->generateCode();
        $this->template->load('overview', 'request_out/addPOut', $data);
    }

    public function getProductType()
    {
        $id = $this->input->post('id');
        $data = $this->m_requestout->getDataApiByID($id);
        echo json_encode($data);
    }

    public function actAdd()
    {
        $this->form_validation->set_rules('request_out', 'product', 'required');
        $this->form_validation->set_rules('institute_out', 'institute', 'required');
        $this->form_validation->set_rules('datetrx_out', 'date transaction', 'required');

        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        $code = $this->input->post('code_out');
        $product = $this->input->post('request_out');
        $institute = $this->input->post('institute_out');
        $date = explode('/', $this->input->post('datetrx_out'));
        $qty = $this->input->post('qty_out');
        $unitprice = changeFormat($this->input->post('unitprice_out'));
        $total = changeFormat($this->input->post('total_out'));
        $budget = changeFormat($this->input->post('budget_out'));
        $desc = $this->input->post('desc_out');

        $trxDay =  $date[0];
        $trxMonth =  $date[1];
        $trxYear =  $date[2];
        $datetrx = ($trxYear . '-' . $trxMonth . '-' . $trxDay);

        $produtDetail = $this->m_requestout->getDataApiByID($product);
        $instansiDetail = $this->m_requestout->getInstansiByIdAPI($institute);

        $qtyAvailable = $produtDetail[0]['qtyavailable'];
        $type_id = $produtDetail[0]['jenis_id'];
        $namaProduct = $produtDetail[0]['name'];
        $namaInstansi = $instansiDetail[0]['name'];
        $budgetProduct = $produtDetail[0]['budget'];
        $budget_detail = $this->m_requestout->getBudgetApi($type_id, $trxYear);
        $sumBudgetOut = $this->m_requestout->totalBudgetQtyProductOut($product, $trxYear, 'amount');
        $sumQtyOut = $this->m_requestout->totalBudgetQtyProductOut($product, $trxYear, null);
        $sumRequestOut = $this->m_requestout->totalRequestOut(null, $product, $trxYear);
        $totalInstituteOut = $this->m_requestout->totalInstituteOut(null, $institute, $trxYear);
        $sumInstituteOut = $sumBudgetOut[0]['amount'] + $totalInstituteOut->amount;

        if ($type_id == 2) {
            $qtyOut = $qty = $unitprice = 0;
            $amount = $budget;
            $instituteOut = $budget + $sumInstituteOut;
            $budgetOut = $budget + $sumBudgetOut[0]['amount'];
        } else {
            $qtyOut = $qty + $sumQtyOut[0]['qtyentered'];
            $amount = $total;
            $instituteOut = $total + $sumInstituteOut;
            $budgetOut = $total;
        }

        $budgetIns = $instansiDetail[0]['budget'];

        if ($this->form_validation->run() == FALSE) {
            $data['product'] = $this->m_requestout->listProductApi();
            $data['institute'] = $this->m_requestout->listInstituteApi();
            $data['code'] = $this->m_requestout->generateCode();
            $this->template->load('overview', 'request_out/addPOut', $data);
        } else {

            if ($budget_detail != null) {
                $budgetYear = $budget_detail[0]['tahun'];
                $status = $budget_detail[0]['status'];
                if ($trxYear == $budgetYear && $status == 'O' && $budgetOut <= $budgetProduct && $instituteOut <= $budgetIns && $qtyOut <= $qtyAvailable) {
                    $param_out = array(
                        'documentno'        => $code,
                        'datetrx'           => $datetrx,
                        'tbl_barang_id'     => $product,
                        'nama_barang'       => $namaProduct,
                        'tbl_instansi_id'   => $institute,
                        'nama_instansi'     => $namaInstansi,
                        'qtyentered'        => $qty,
                        'unitprice'         => $unitprice,
                        'amount'            => $amount,
                        'status'            => 'DR',
                        'keterangan'        => $desc
                    );
                    $this->m_requestout->save($param_out);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade in" role="alert">' .
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>' .
                            '</button>' .
                            'Data berhasil disimpan</div>');
                    }
                    echo "<script>window.location='" . site_url('requestout') . "';</script>";
                } else {
                    if ($status == 'C') {
                        $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade in" role="alert">' .
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>' .
                            '</button>' .
                            'Closed period, silahkan buka periode budget ' . $budgetYear . '!</div>');
                    } else if ($budgetOut > $budgetProduct) {
                        $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade in" role="alert">' .
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>' .
                            '</button>' .
                            'Budget sudah melebihi : ' . rupiah($budgetProduct) . ' /Tahun </div>');
                    } else if ($instituteOut > $budgetIns) {
                        $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade in" role="alert">' .
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>' .
                            '</button>' .
                            'Budget Instansi sudah melebihi : ' . rupiah($budgetIns) . ' /Tahun </div>');
                    } else if ($qtyOut > $qtyAvailable) {
                        $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade in" role="alert">' .
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>' .
                            '</button>' .
                            'Quantity yang tersedia sekarang adalah : ' . $qtyAvailable . '</div>');
                    } else {
                        $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade in" role="alert">' .
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>' .
                            '</button>' .
                            'Error</div>');
                    }
                    echo "<script>window.location='" . site_url('requestout/add') . "';</script>";
                }
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible fade in" role="alert">' .
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>' .
                    '</button>' .
                    'Silahkan buat budget tahunan terlebih dahulu !</div>');
                echo "<script>window.location='" . site_url('requestout') . "';</script>";
            }
        }
    }

    public function edit($id)
    {
        $data['request_out_id'] = $id;
        $data['product'] = $this->m_requestout->listProductApi();
        $data['institute'] = $this->m_requestout->listInstituteApi();
        $this->template->load('overview', 'request_out/editPOut', $data);
    }

    public function get_data_edit()
    {
        $request_out_id = $this->input->post('id');
        $data = $this->m_requestout->detail($request_out_id)->result();
        echo json_encode($data);
    }

    public function actEdit()
    {
        $this->form_validation->set_rules('request_out', 'product', 'required');
        $this->form_validation->set_rules('institute_out', 'institute', 'required');
        $this->form_validation->set_rules('datetrx_out', 'date transaction', 'required');

        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        $id_barang_out = $this->input->post('id_barang_out');
        $code = $this->input->post('code_out');
        $product = $this->input->post('request_out');
        $institute = $this->input->post('institute_out');
        $date = explode('/', $this->input->post('datetrx_out'));
        $qty = $this->input->post('qty_out');
        $unitprice = changeFormat($this->input->post('unitprice_out'));
        $total = changeFormat($this->input->post('total_out'));
        $budget = changeFormat($this->input->post('budget_out'));
        $desc = $this->input->post('desc_out');

        $trxDay =  $date[0];
        $trxMonth =  $date[1];
        $trxYear =  $date[2];
        $datetrx = ($trxYear . '-' . $trxMonth . '-' . $trxDay);

        $produtDetail = $this->m_requestout->getDataApiByID($product);
        $instansiDetail = $this->m_requestout->getInstansiByIdAPI($institute);

        //$namaProduct = $produtDetail[0]['name'];
        //$namaInstansi = $instansiDetail[0]['name'];

        $qtyAvailable = $produtDetail[0]['qtyavailable'];
        $type_id = $produtDetail[0]['jenis_id'];
        $namaProduct = $produtDetail[0]['name'];
        $namaInstansi = $instansiDetail[0]['name'];
        $budgetProduct = $produtDetail[0]['budget'];
        $budget_detail = $this->m_requestout->getBudgetApi($type_id, $trxYear);
        $sumBudgetOut = $this->m_requestout->totalBudgetQtyProductOut($product, $trxYear, 'amount');
        $sumQtyOut = $this->m_requestout->totalBudgetQtyProductOut($product, $trxYear, null);
        $sumRequestOut = $this->m_requestout->totalRequestOut(null, $product, $trxYear);
        $totalInstituteOut = $this->m_requestout->totalInstituteOut($id_barang_out, $institute, $trxYear);
        $sumInstituteOut = $sumBudgetOut[0]['amount'] + $totalInstituteOut->amount;

        if ($type_id == 2) {
            $qtyOut = $qty = $unitprice = 0;
            $amount = $budget;
            $instituteOut = $budget + $sumInstituteOut;
            $budgetOut = $budget + $sumBudgetOut[0]['amount'];
        } else {
            $qtyOut = $qty + $sumQtyOut[0]['qtyentered'];
            $amount = $total;
            $instituteOut = $total + $sumInstituteOut;
            $budgetOut = $total;
        }

        $budgetIns = $instansiDetail[0]['budget'];

        if ($this->form_validation->run() == FALSE) {
            $data['product_out_id'] = $id_barang_out;
            $data['product'] = $this->m_requestout->listProductApi();
            $data['institute'] = $this->m_requestout->listInstituteApi();
            $this->template->load('overview', 'request_out/editPOut', $data);
        } else {
            if ($budget_detail != null) {
                $budgetYear = $budget_detail[0]['tahun'];
                $status = $budget_detail[0]['status'];
                if ($trxYear == $budgetYear && $status == 'O' && $budgetOut <= $budgetProduct && $instituteOut <= $budgetIns && $qtyOut <= $qtyAvailable) {
                    $param_out = array(
                        'documentno'        => $code,
                        'datetrx'           => $datetrx,
                        'tbl_barang_id'     => $product,
                        'nama_barang'       => $namaProduct,
                        'tbl_instansi_id'   => $institute,
                        'nama_instansi'     => $namaInstansi,
                        'qtyentered'        => $qty,
                        'unitprice'         => $unitprice,
                        'amount'            => $amount,
                        'status'            => 'DR',
                        'keterangan'        => $desc,
                        'updated'           => date('Y-m-d H:i:s')
                    );
                    $where_out = array('tbl_permintaan_id' => $id_barang_out);
                    $this->m_requestout->update($param_out, $where_out);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade in" role="alert">' .
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>' .
                            '</button>' .
                            'Data berhasil diubah</div>');
                    }
                    echo "<script>window.location='" . site_url('requestout') . "';</script>";
                } else {
                    if ($status == 'C') {
                        $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade in" role="alert">' .
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>' .
                            '</button>' .
                            'Closed period, silahkan buka periode budget ' . $budgetYear . '!</div>');
                    } else if ($budgetOut > $budgetProduct) {
                        $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade in" role="alert">' .
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>' .
                            '</button>' .
                            'Budget sudah melebihi : ' . rupiah($budgetProduct) . ' /Tahun </div>');
                    } else if ($instituteOut > $budgetIns) {
                        $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade in" role="alert">' .
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>' .
                            '</button>' .
                            'Budget Instansi sudah melebihi : ' . rupiah($budgetIns) . ' /Tahun </div>');
                    } else if ($qtyOut > $qtyAvailable) {
                        $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade in" role="alert">' .
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>' .
                            '</button>' .
                            'Quantity yang tersedia sekarang adalah : ' . $qtyAvailable . '</div>');
                    } else {
                        $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade in" role="alert">' .
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>' .
                            '</button>' .
                            'Error</div>');
                    }
                    echo "<script>window.location='" . site_url('requestout/edit/' . $id_barang_out) . "';</script>";
                }
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible fade in" role="alert">' .
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>' .
                    '</button>' .
                    'Silahkan buat budget tahunan terlebih dahulu !</div>');
                echo "<script>window.location='" . site_url('requestout') . "';</script>";
            }
        }
    }

    public function actComplete($id)
    {
        $get_detail = $this->m_requestout->detail($id)->row();

        $noDoc = $get_detail->documentno;
        $idBarang = $get_detail->tbl_barang_id;
        $idInstansi = $get_detail->tbl_instansi_id;
        $datetrx = $get_detail->datetrx;
        //$statusA = $get_detail->status;
        $qty_out = $get_detail->qtyentered;
        $keterangan = $get_detail->keterangan;
        $unitprice = $get_detail->unitprice;
        $amount = $get_detail->amount;

        $param_permintaan = array(
            'status' => 'P'
        );

        $dataApi = array(
            'documentno' => $noDoc,
            'tbl_barang_id' => $idBarang,
            'tbl_instansi_id' => $idInstansi,
            'datetrx' => $datetrx,
            'unitprice' => $unitprice,
            'amount' => $amount,
            'status' => 'DR',
            'qtyentered' => $qty_out,
            'keterangan' => $keterangan,
            'key' => "inv123"
        );

        $where_permintaan = array('tbl_permintaan_id' => $id);

        $this->m_requestout->update($param_permintaan, $where_permintaan);
        $this->m_requestout->savePermintaanApi($dataApi);
        $data = array('success' => 'berhasil');

        echo json_encode($data);
    }

    public function delete($id)
    {
        $data = $this->m_requestout->delete($id);
        echo json_encode($data);
    }
}
