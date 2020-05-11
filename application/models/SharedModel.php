<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SharedModel extends CI_Model {
 
  
  public function getAllKab($filter = []){
    $this->db->select('*');
    $this->db->from('kd_kab');
    // if(!empty($filter['curr_only']) && !empty($this->session->userdata('s_id_opd'))) $this->db->where('id_opd', $this->session->userdata('s_id_opd'));
    $res = $this->db->get();
    return DataStructure::keyValue($res->result_array(), 'id_kd_kab');
  }

  public function getAllPuskesmas($filter = []){
    $this->db->select('*');
    $this->db->from('puskesmas');
    // if(!empty($filter['curr_only']) && !empty($this->session->userdata('s_id_opd'))) $this->db->where('id_opd', $this->session->userdata('s_id_opd'));
    $this->db->ORDER_BY('id_puskesmas','ASC');
    $res = $this->db->get();
    return DataStructure::keyValue($res->result_array(), 'id_puskesmas');
  }

  public function getAllKec($filter = []){
    $this->db->select('*');
    $this->db->from('kd_kec');
    if(!empty($filter['kd_kab'])) $this->db->where('KodeKab', $filter['kd_kab']);
    $res = $this->db->get();
    return DataStructure::keyValue($res->result_array(), 'KodeKec');
  }

  public function getAllKel($filter = []){
    $this->db->select('*');
    $this->db->from('kd_area');
    if(!empty($filter['kd_kec'])) $this->db->where('KodeKec', $filter['kd_kec']);
    if(!empty($filter['kd_kab'])) $this->db->where('KodeKab', $filter['kd_kab']);  
    $res = $this->db->get();
    return DataStructure::keyValue($res->result_array(), 'KodeKel');
  }

  

  public function getInformasi($filter = []){
    $this->db->select('count(*) as k1');
    $this->db->from('dtks_rt');
    $this->db->where('sta_pkh', '1');
    $this->db->where('sta_rastra', '3');
    $res = $this->db->get();
    $res = $res->result_array();
    $info['kriteria1'] = $res['0']['k1'];

 

    $this->db->select('count(*) as k1');
    $this->db->from('dtks_rt');
    $this->db->where('sta_pkh', '2');
    $this->db->where('sta_rastra', '3');
    $res = $this->db->get();
    $res = $res->result_array();
    $info['kriteria2'] = $res['0']['k1'];

    $this->db->select('count(*) as k1');
    $this->db->from('dtks_rt');
    $this->db->where('sta_pkh', '2');
    $this->db->where('sta_rastra', '4');
    $res = $this->db->get();
    $res = $res->result_array();
    $info['kriteria3'] = $res['0']['k1'];

    $this->db->select('count(*) as k1');
    $this->db->from('dtks_rt');
    $this->db->where('jenis_bantuan', '1');
    $res = $this->db->get();
    $res = $res->result_array();
    $info['kriteria1ok'] = $res['0']['k1'];

    $this->db->select('count(*) as k1');
    $this->db->from('dtks_rt');
    $this->db->where('jenis_bantuan', '2');
    $res = $this->db->get();
    $res = $res->result_array();
    $info['kriteria2ok'] = $res['0']['k1'];

    $this->db->select('count(*) as k1');
    $this->db->from('dtks_rt');
    $this->db->where('jenis_bantuan', '3');
    $res = $this->db->get();
    $res = $res->result_array();
    $info['kriteria3ok'] = $res['0']['k1'];

    $this->db->select('count(*) as k1');
    $this->db->from('terdampak_phk');
    // $this->db->where('jenis_bantuan', '3');
    $res = $this->db->get();
    $res = $res->result_array();
    $info['phk'] = $res['0']['k1'];

    $this->db->select('count(*) as k1');
    $this->db->from('terdampak_dirumahkan');
    // $this->db->where('jenis_bantuan', '3');
    $res = $this->db->get();
    $res = $res->result_array();
    $info['dirumahkan'] = $res['0']['k1'];

    return  $info;

  }

  public function getAllStatusOption($filter = []){
    $this->db->select('*');
    $this->db->from('status_pasien');
    $res = $this->db->get();
    return DataStructure::keyValue($res->result_array(), 'id_status');
  }
  
  public function getJenisBantuan($filter = []){
    $this->db->select('*');
    $this->db->from('kd_jenis_bantuan');
    $res = $this->db->get();
    return DataStructure::keyValue($res->result_array(), 'id_jenis_bantuan');
  }


  public function getAllRole($filter = []){
    $this->db->select('*');
    $this->db->from('role');
    if(!empty($filter['id_role'])) $this->db->where('id_role', $filter['id_role']);
    if(isset($filter['except_ids'])) $this->db->where_not_in('id_role', $filter['except_ids']);
    $res = $this->db->get();
    return DataStructure::keyValue($res->result_array(), 'id_role');
  }

  public function getAllBulanOption($filter = []){
    $this->db->select('*');
    $this->db->from('bulan');
    $res = $this->db->get();
    return DataStructure::keyValue($res->result_array(), 'id_bulan');
  }

  public function getAllTahun($filter = []){
    $this->db->select('*');
    $this->db->from('tahun as t');
    $res = $this->db->get();
    return DataStructure::keyValue($res->result_array(), 'tahun');
  }

  public function getInformasidDinkes($filter = []){
    $this->db->select('count(*) as k1');
    $this->db->from('data_pasien');
    $this->db->where('status', '1');
    // $this->db->where('sta_rastra', '3');
    $res = $this->db->get();
    $res = $res->result_array();
    $info['OTG'] = $res['0']['k1'];

    $this->db->select('count(*) as k1');
    $this->db->from('data_pasien');
    $this->db->where('status', '2');
    $res = $this->db->get();
    $res = $res->result_array();
    $info['ODP'] = $res['0']['k1'];

    $this->db->select('count(*) as k1');
    $this->db->from('data_pasien');
    $this->db->where('status', '3');
    $res = $this->db->get();
    $res = $res->result_array();
    $info['PDP'] = $res['0']['k1'];

    $this->db->select('count(*) as k1');
    $this->db->from('data_pasien');
    $this->db->where('status', '4');
    $res = $this->db->get();
    $res = $res->result_array();
    $info['POSITIF'] = $res['0']['k1'];

    $this->db->select('count(*) as k1');
    $this->db->from('data_pasien');
    $this->db->where('status', '5');
    $res = $this->db->get();
    $res = $res->result_array();
    $info['NEGATIF'] = $res['0']['k1'];
    $kd = array('1','2','3','4','5','6','71');
    foreach ($kd as $key){ 
      $query = "SELECT
    (SELECT count(id_pasien) FROM data_pasien WHERE status = 1 AND KDKAB = ".$key.") as OTG,
    (SELECT count(id_pasien) FROM data_pasien WHERE status = 2 AND KDKAB = ".$key.") as ODP,
    (SELECT count(id_pasien) FROM data_pasien WHERE status = 3 AND KDKAB = ".$key.") as PDP,
    (SELECT count(id_pasien) FROM data_pasien WHERE status = 4 AND KDKAB = ".$key.") as POSITIF,
    (SELECT count(id_pasien) FROM data_pasien WHERE status = 5 AND KDKAB = ".$key.") as NEGATIF
    from data_pasien
    limit 1
    ";
    $res = $this->db->query($query);
    $alpa[$key] = $res->result_array();
    } 
    
    // $query = "SELECT
    // (SELECT count(id_pasien) FROM data_pasien WHERE status = 1 AND KDKAB = 71) as OTG,
    // (SELECT count(id_pasien) FROM data_pasien WHERE status = 2 AND KDKAB = 71) as ODP,
    // (SELECT count(id_pasien) FROM data_pasien WHERE status = 3 AND KDKAB = 71) as PDP,
    // (SELECT count(id_pasien) FROM data_pasien WHERE status = 4 AND KDKAB = 71) as POSITIF,
    // (SELECT count(id_pasien) FROM data_pasien WHERE status = 5 AND KDKAB = 71) as NEGATIF
    // from data_pasien
    // limit 1
    // ";
    // $res = $this->db->query($query);
    // $res = $res->result_array();
    $info['Detail'] = $alpa;

    return  $info;

  }

}
