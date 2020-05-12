<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SharedController extends CI_Controller {

  public function __construct(){
    parent::__construct();
		$this->load->model(array('SharedModel'));
		$this->load->helper(array('DataStructure', 'Validation'));
  }
  
  public function getAllProv(){
	try{
		// $this->SecurityModel->userOnlyGuard(FALSE);
		  $data = $this->SharedModel->getAllProv($this->input->post());
		echo json_encode(array("data" => $data));
	} catch (Exception $e) {
		ExceptionHandler::handle($e);
	}
}

  public function getAllKabProv(){
	try{
		// $this->SecurityModel->userOnlyGuard(FALSE);
		  $data = $this->SharedModel->getAllKabProv($this->input->post());
		echo json_encode(array("data" => $data));
	} catch (Exception $e) {
		ExceptionHandler::handle($e);
	}
}


public function getAllKecProv(){
	try{
		// $this->SecurityModel->userOnlyGuard(TRUE);
		  $data = $this->SharedModel->getAllKecProv($this->input->post());
		echo json_encode(array("data" => $data));
	} catch (Exception $e) {
		ExceptionHandler::handle($e);
	}
}

public function getAllKelProv(){
	try{
		// $this->SecurityModel->userOnlyGuard(TRUE);
		  $data = $this->SharedModel->getAllKelProv($this->input->post());
		echo json_encode(array("data" => $data));
	} catch (Exception $e) {
		ExceptionHandler::handle($e);
	}
}


	public function getAllKab(){
		try{
			// $this->SecurityModel->userOnlyGuard(FALSE);
      		$data = $this->SharedModel->getAllKab($this->input->post());
			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
	}

	
	public function getAllPuskesmas(){
		try{
			// $this->SecurityModel->userOnlyGuard(FALSE);
      		$data = $this->SharedModel->getAllPuskesmas($this->input->post());
			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
	}
	
	public function getAllKec(){
		try{
			// $this->SecurityModel->userOnlyGuard(TRUE);
      		$data = $this->SharedModel->getAllKec($this->input->post());
			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
	}
	
	public function getAllKel(){
		try{
			// $this->SecurityModel->userOnlyGuard(TRUE);
      		$data = $this->SharedModel->getAllKel($this->input->post());
			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
	}

	public function getInformasi(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
      		$data = $this->SharedModel->getInformasi($this->input->post());
			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
	}

	public function getInformasidDinkes(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
      		$data = $this->SharedModel->getInformasidDinkes($this->input->post());
			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
	}

	public function getJenisBantuan(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
      		$data = $this->SharedModel->getJenisBantuan($this->input->get());
			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
	}
	
	public function getAllStatusOption(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
     		$data = $this->SharedModel->getAllStatusOption($this->input->get());
			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}		
	}
	
	public function getAllRole(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->SharedModel->getAllRole($this->input->post());
			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
	}


	public function getBulanOption(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->SharedModel->getAllBulanOption($this->input->get());
			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
	}

	public function getAllTahun(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->SharedModel->getAllTahun($this->input->get());
			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
	}
	
}
