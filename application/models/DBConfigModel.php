<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DBConfigModel extends CI_Model{

  public function __construct() {
    parent::__construct();
  }

  public function getAllDBConfig($filter = []){
    $this->db->select('dc.*');
    $this->db->from('db_config as dc');
    if(isset($filter['id_db_config'])) $this->db->where('dc.id_db_config', $filter['id_db_config']);
    $res = $this->db->get();
    return DataStructure::keyValue($res->result_array(), 'id_db_config');
  }

  public function getDBConfig($idDBConfig){
    $row = $this->getAllDBConfig(['id_db_config' => $idDBConfig]);
    if(empty($row)) throw new UserException('DB Config tidak ditemukan', 0);
    return $row[$idDBConfig];
  }

  public function editDBConfig($data){
    $this->db->set(DataStructure::slice($data, ['hostname', 'username', 'password', 'database']));
    $this->db->where('id_db_config', $data['id_db_config']);
    $this->db->update('db_config');
    ExceptionHandler::handleDBError($this->db->error(), "Update Konfigurasi DB Gagal", "db_config");
    return True;
  }
}
