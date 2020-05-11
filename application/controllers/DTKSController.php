<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DTKSController extends CI_Controller {

  public function __construct(){
    parent::__construct();
		$this->load->model(array("DTKSModel"));
    $this->load->helper(array('DataStructure', 'Validation'));
    $this->db->db_debug = TRUE;
  }

  public function getAllDTKSRT(){
    try{
      $this->SecurityModel->userOnlyGuard(TRUE);
      // var_dump($this->input->get());
      $data = $this->DTKSModel->getAllDTKSRT($this->input->get());
      $info = $this->DTKSModel->getAllDTKSRT_info($this->input->get());
			echo json_encode(array("data" => $data,"info" => $info));
    } catch (Exception $e){
      ExceptionHandler::handle($e);
    }
  }

  public function getAllUMKM(){
    try{
      $this->SecurityModel->userOnlyGuard(TRUE);
      // var_dump($this->input->get());
      $data = $this->DTKSModel->getAllUMKM($this->input->get());
      $info = $this->DTKSModel->getAllUMKM_info($this->input->get());
      // var_dump($data);
      // return $data;
      // echo
			echo json_encode(array("data" => $data,"info" => $info));
    } catch (Exception $e){
      ExceptionHandler::handle($e);
    }
  }
  public function getAllUMKM2(){
    try{
      $this->SecurityModel->userOnlyGuard(TRUE);
      // var_dump($this->input->get());
      $data = $this->DTKSModel->getAllUMKM($this->input->get());
      // $info = $this->DTKSModel->getAllUMKM_info($this->input->get());
      // var_dump($data);
      // return $data;
      // echo
			echo json_encode(array("data" => $data));
    } catch (Exception $e){
      ExceptionHandler::handle($e);
    }
  }


  public function getAllDTKSRT_v2(){
    try{
      $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->DTKSModel->getAllDTKSRT_v2($this->input->get());
			echo json_encode(array("data" => $data));
    } catch (Exception $e){
      ExceptionHandler::handle($e);
    }
  }

  public function getAllUMKM_v2(){
    try{
      $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->DTKSModel->getAllUMKM_v2($this->input->get());
			echo json_encode(array("data" => $data));
    } catch (Exception $e){
      ExceptionHandler::handle($e);
    }
  }

  public function getAllDTKSART(){
    try{
      $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->DTKSModel->getAllDTKSART($this->input->get());
			echo json_encode(array("data" => $data));
    } catch (Exception $e){
      ExceptionHandler::handle($e);
    }
  }
  public function editDTKSRT(){
    try{
      $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->DTKSModel->editDTKSRT($this->input->post());
      $data = $this->DTKSModel->getAllDTKSRT_v2($this->input->post());
      echo json_encode(array("data" => $data));
    } catch (Exception $e){
      ExceptionHandler::handle($e);
    }
  }

  public function editUMKM(){
    try{
      $this->SecurityModel->userOnlyGuard(TRUE);
      $filter = $this->input->post();
      $data = $this->DTKSModel->editDTKSRT($this->input->post());
      $data = $this->DTKSModel->getAllUMKM($this->input->post());
      $data = $data[$filter['IDUMKM']];
      echo json_encode(array("data" => $data));
    } catch (Exception $e){
      ExceptionHandler::handle($e);
    }
  }
}
