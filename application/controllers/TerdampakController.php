<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TerdampakController extends CI_Controller {

  public function __construct(){
    parent::__construct();
		$this->load->model(array("TerdampakModel", "SyncModel"));
    $this->load->helper(array('DataStructure', 'Validation'));
    $this->db->db_debug = TRUE;
  }

  public function getAllPHK(){
    try{
      $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->TerdampakModel->getAllPHK($this->input->get());
			echo json_encode(array("data" => $data));
    } catch (Exception $e){
      ExceptionHandler::handle($e);
    }
  }

  public function getAllPriorPHK(){
    try{
      $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->TerdampakModel->getAllPriorPHK($this->input->get());
			echo json_encode(array("data" => $data));
    } catch (Exception $e){
      ExceptionHandler::handle($e);
    }
  }

  public function getAllPriorDirumahkan(){
    try{
      $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->TerdampakModel->getAllPriorDirumahkan($this->input->get());
			echo json_encode(array("data" => $data));
    } catch (Exception $e){
      ExceptionHandler::handle($e);
    }
  }



  public function getPHK(){
    try{
      $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->TerdampakModel->getAllPHK($this->input->get());
			echo json_encode(array("data" => $data));
    } catch (Exception $e){
      ExceptionHandler::handle($e);
    }
  }

  public function getPerusahaanPHK(){
    try{
      $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->TerdampakModel->getPerusahaanPHK($this->input->post());
			echo json_encode(array("data" => $data));
    } catch (Exception $e){
      ExceptionHandler::handle($e);
    }
  }

  public function getPerusahaanDirumahkan(){
    try{
      $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->TerdampakModel->getPerusahaanDirumahkan($this->input->post());
			echo json_encode(array("data" => $data));
    } catch (Exception $e){
      ExceptionHandler::handle($e);
    }
  }

  

  public function getAllDirumahkan(){
    try{
      $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->TerdampakModel->getAllDirumahkan($this->input->get());
			echo json_encode(array("data" => $data));
    } catch (Exception $e){
      ExceptionHandler::handle($e);
    }
  }

  
  public function getAllDataInduk(){
    try{
      $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->TerdampakModel->getAllDataInduk($this->input->get());
			echo json_encode(array("data" => $data));
    } catch (Exception $e){
      ExceptionHandler::handle($e);
    }
  }

  public function getAllDataUMKM(){
    try{
      $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->TerdampakModel->getAllDataUMKM($this->input->get());
			echo json_encode(array("data" => $data));
    } catch (Exception $e){
      ExceptionHandler::handle($e);
    }
  }
  public function getDirumahkan(){
    try{
      $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->TerdampakModel->getAllDirumahkan($this->input->get());
			echo json_encode(array("data" => $data));
    } catch (Exception $e){
      ExceptionHandler::handle($e);
    }
  }


  public function getInfoKeluarga(){
    try{
      $this->SecurityModel->userOnlyGuard(TRUE);
      $noKK = $this->TerdampakModel->getNoKK($this->input->get());
      if(!empty($noKK)){
      $data = $this->TerdampakModel->getInfoKeluarga($noKK);
      }else{
      $data = "NULL";
      }
			echo json_encode(array("data" => $data));
    } catch (Exception $e){
      ExceptionHandler::handle($e);
    }
  }
  
  public function setFisik(){
    try{
      $this->SecurityModel->userOnlyGuard(TRUE);
      $id = $this->FisikModel->set($this->input->post());
      $data = $this->FisikModel->get($id);
			echo json_encode(array("data" => $data));
    } catch (Exception $e){
      ExceptionHandler::handle($e);
    }
  }

  public function getRealisasiFisikBulan(){
    try{
      // $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->FisikModel->getRealisasiFisikBulan($this->input->get());
			echo json_encode(array("data" => $data, "error" => false));
    } catch (Exception $e){
      ExceptionHandler::handle($e);
    }
  }
}
