<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportController extends CI_Controller {

  public function __construct(){
    parent::__construct();
		$this->load->model(array(''));
    $this->load->helper(array('DataStructure', 'Validation'));
    $this->db->db_debug = TRUE;
  }

  public function realisasiPerKegiatan(){
    
  }
}