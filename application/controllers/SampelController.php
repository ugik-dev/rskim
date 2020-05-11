<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SampelController extends CI_Controller {

  public function __construct(){
    parent::__construct();
		$this->load->model(array('PasienModel'));
    $this->load->helper(array('DataStructure', 'Validation'));
  }
  
  public function index(){
    $this->SecurityModel->roleOnlyGuard('petugas_sampel');
		$pageData = array(
			'title' => 'Beranda',
      'content' => 'petugassampel/DashboardPage',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }

  public function request_sampel(){
    $this->SecurityModel->roleOnlyGuard('petugas_sampel');
		$pageData = array(
			'title' => 'Daftar Request',
      'content' => 'petugassampel/Sampel',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }

  public function terjadwal_sampel(){
    $this->SecurityModel->roleOnlyGuard('petugas_sampel');
		$pageData = array(
			'title' => 'Daftar Request',
      'content' => 'petugassampel/SampelTerjadwal',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }

  public function finis_sampel(){
    $this->SecurityModel->roleOnlyGuard('petugas_sampel');
		$pageData = array(
			'title' => 'Daftar Request',
      'content' => 'petugassampel/SampelFinis',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }

  public function balasan_sampel(){
    $this->SecurityModel->roleOnlyGuard('petugas_sampel');
		$pageData = array(
			'title' => 'Daftar Request',
      'content' => 'petugassampel/SampelBalasan',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }


}