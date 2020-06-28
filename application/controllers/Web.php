<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

	public function __construct() {
        parent::__construct();
        //$this->load->model('m_product');
        $this->load->model('m_productin');
        $this->load->model('m_requestout');
    }

    public function index() 
    {	
        $year = date("Y");
        $spend = $this->m_productin->budgetProductIn($year);
        $budget_ins = $this->m_requestout->getInstansiByIdAPI(3);
        foreach($budget_ins as $row) {
            $budget = $row['budget'];
        }
        $remain = $budget - $spend->amount;
    	$data['remain'] = $remain;
        $data['productin'] = $this->m_productin->totalProductIn();
    	$data['requestout'] = $this->m_requestout->countRequestOut();
    	$data['budget_inst'] = $budget;
        $this->template->load('overview', 'web/dashboard', $data);
    }

    public function tutup() {
        $data = $this->m_requestout->getInstansiByIdAPI(3);
        echo json_encode($data->budget);
    }
}