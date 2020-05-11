<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaborController extends CI_Controller {

  public function __construct(){
    parent::__construct();
		$this->load->model(array('PasienModel'));
    $this->load->helper(array('DataStructure', 'Validation'));
  }
  
  public function index(){
    $this->SecurityModel->roleOnlyGuard('petugas_labor');
		$pageData = array(
			'title' => 'Beranda',
      'content' => 'petugaslabor/DashboardPage',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }

  public function request_labor(){
    $this->SecurityModel->roleOnlyGuard('petugas_labor');
		$pageData = array(
			'title' => 'Daftar Request',
      'content' => 'petugaslabor/Labor',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }


}