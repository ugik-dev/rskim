<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RSController extends CI_Controller {

  public function __construct(){
    parent::__construct();
		$this->load->model(array('DinkesModel'));
    $this->load->helper(array('DataStructure', 'Validation'));
  }
  

  public function index(){
    $this->SecurityModel->roleOnlyGuard(TRUE);
		$pageData = array(
			'title' => 'Beranda',
      'content' => 'rumah_sakit/DashboardPage',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }
  
  public function data_pasien(){
    $this->SecurityModel->roleOnlyGuard(TRUE);
		$pageData = array(
			'title' => 'Data Pasien',
      'content' => 'rumah_sakit/DataPasien',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }

  public function data_record(){
    $this->SecurityModel->roleOnlyGuard(TRUE);
		$pageData = array(
			'title' => 'Data Rekam Medis',
      'content' => 'rumah_sakit/DataRecord',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }

  public function DetailPasien(){
    $this->SecurityModel->roleOnlyGuard(TRUE);
		$pageData = array(
			'title' => 'Detail Data Pasien', 
      'content' => 'rumah_sakit/DetailPasien',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
			'contentData' => $this->input->get(),
		);
    $this->load->view('Page', $pageData);
  }

  public function DetailRecord(){
    $this->SecurityModel->roleOnlyGuard(TRUE);
		$pageData = array(
			'title' => 'Detail Record', 
      'content' => 'rumah_sakit/DetailRecord',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
			'contentData' => $this->input->get(),
		);
    $this->load->view('Page', $pageData);
  }
  public function panduan(){
    $this->SecurityModel->roleOnlyGuard(TRUE);
		$pageData = array(
			'title' => 'Beranda',
      'content' => 'puskesmas/PanduanPage',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }

  public function getAllPasien(){
    try{
      $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->DinkesModel->getAllPasien($this->input->get());
			echo json_encode(array("data" => $data));
    } catch (Exception $e){
      ExceptionHandler::handle($e);
    }
  }
}