<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterController extends CI_Controller {

  public function __construct(){
    parent::__construct();
		$this->load->model(array('RegisterModel'));
		$this->load->helper(array('DataStructure', 'Validation'));
		$this->db->db_debug = false;
	}

  public function index(){
		redirect('register');
  }

	public function login(){
		$this->SecurityModel->guestOnlyGuard();
		$pageData = array(
			'title' => 'Registrasi',
		);

		$this->load->view('RegisterPage', $pageData);
    }
    
}