<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

	public function __construct() {
        parent::__construct();
        //$this->load->model('m_product');
        $this->load->model('m_productin');
        //$this->load->model('m_productout');
    }

    public function index() 
    {	
    	//$data['product'] = $this->m_product->totalProductActive();
    	$data['productin'] = $this->m_productin->totalProductIn();
    	//$data['productout'] = $this->m_productout->totalProductOut();
    	$this->template->load('overview', 'web/dashboard', $data);
    }

}