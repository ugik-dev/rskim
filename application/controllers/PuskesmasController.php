<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PuskesmasController extends CI_Controller {

  public function __construct(){
    parent::__construct();
		$this->load->model(array('DinkesModel'));
    $this->load->helper(array('DataStructure', 'Validation'));
  }
  

  public function index(){
    $this->SecurityModel->roleOnlyGuard(TRUE);
		$pageData = array(
			'title' => 'Beranda',
      'content' => 'puskesmas/DashboardPage',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }
  
  public function data_pasien(){
    $this->SecurityModel->roleOnlyGuard(TRUE);
		$pageData = array(
			'title' => 'Data Puskesmas',
      'content' => 'puskesmas/DataPasien',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }

  public function DetailData(){
    $this->SecurityModel->roleOnlyGuard(TRUE);
		$pageData = array(
			'title' => 'Detail Data', 
      'content' => 'puskesmas/DetailData',
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