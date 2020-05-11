<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TerdampakModel extends CI_Model {
  var $CI = "";
  public function __construct(){
    parent::__construct();
    $this->CI =& get_instance();
    $this->CI->load->library('form_validation');
	}

  public function getAllPHK($filter){
    // var_dump($filter);
    $this->db->select("*");
    $this->db->from("terdampak_phk as ssk");
    $this->db->join("kd_kab as ks", "ks.id_kd_kab = ssk.kd_kab", "LEFT");
    // $this->db->where("ssk.NO", $filter['NO']);
    // $this->db->join("kegiatan_survei_attachment as ksa", "ksa.id_kegiatan_survei = ks.id_kegiatan_survei", "LEFT");
    if(!empty($filter['kd_perusahaan'])) $this->db->where("ssk.NAMA_PERUSAHAAN", $filter['kd_perusahaan']);
  
    if(!empty($filter['kd_kab'])) $this->db->where("ssk.kd_kab", $filter['kd_kab']);
    if(!empty($filter['NO'])) $this->db->where("ssk.NO", $filter['NO']);
    if(!empty($filter['id_kegiatan_renja'])) $this->db->where("ssk.id_kegiatan_renja", $filter['id_kegiatan_renja']);
    $res = $this->db->get();
    return $res->result_array();
   
  }


  public function getAllDirumahkan($filter){
    // var_dump($filter);
    $this->db->select("*");
    $this->db->from("terdampak_dirumahkan as ssk");
    $this->db->join("kd_kab as ks", "ks.id_kd_kab = ssk.kd_kab", "LEFT");
    // $this->db->where("ssk.NO", $filter['NO']);
    // $this->db->join("kegiatan_survei_attachment as ksa", "ksa.id_kegiatan_survei = ks.id_kegiatan_survei", "LEFT");

    if(!empty($filter['kd_kab'])) $this->db->where("ssk.kd_kab", $filter['kd_kab']);
    if(!empty($filter['NO'])) $this->db->where("ssk.NO", $filter['NO']);
    if(!empty($filter['kd_perusahaan'])) $this->db->where("ssk.NAMA_PERUSAHAAN", $filter['kd_perusahaan']);
    $res = $this->db->get();
    return $res->result_array();
    // return DataStructure::groupByRecursive2($res->result_array(), 
    //   ['id_kegiatan_renja', 'id_kegiatan_survei'], 
    //   ['id_kegiatan_survei', 'id_kegiatan_survei_attachment'], 
    //   [
    //     ['id_kegiatan_renja'], 
    //     ["id_kegiatan_survei", "tanggal", "pemeriksa", "kendala", "keterangan"], 
    //     ["id_kegiatan_survei_attachment", "type", "filename", "url", "size"], 
    //   ],
    //   ['survei', 'attachment']
    // );
  }

  
    
  public function getAllDataInduk($filter){
    // var_dump($filter);
    $this->db->select("*");
    $this->db->from("data_induk as ssk");
    // $this->db->join("kd_kab as ks", "ks.id_kd_kab = ssk.kd_kab", "LEFT");
    // $this->db->where("ssk.NO", $filter['NO']);
    // $this->db->join("kegiatan_survei_attachment as ksa", "ksa.id_kegiatan_survei = ks.id_kegiatan_survei", "LEFT");
    // if(!empty($filter['kd_perusahaan'])) $this->db->where("ssk.NAMA_PERUSAHAAN", $filter['kd_perusahaan']);
    
    // if(!empty($filter['kd_kab'])) $this->db->where("ssk.kd_kab", $filter['kd_kab']);
    if(!empty($filter['kd_kec'])) $this->db->where("ssk.KDKEC", $filter['kd_kec']);
    if(!empty($filter['kd_kel'])) $this->db->where("ssk.KDDESA", $filter['kd_kel']);
    if(!empty($filter['by_nik'])) $this->db->where("ssk.NIK", $filter['by_nik']);
    if(!empty($filter['by_nokk'])) $this->db->where("ssk.NoKK", $filter['by_nokk']);
    if(!empty($filter['ada_pkh'])) {
      if($filter['ada_pkh'] == '2') $filter['ada_pkh'] = '0';
        $this->db->where("ssk.ada_pkh", $filter['ada_pkh']);
     }
     $this->db->GROUP_BY("ssk.NoKK");
      $this->db->limit("500");
    $res = $this->db->get();
    return $res->result_array();
   
  }

  
    
  public function getAllDataUMKM($filter){
    // var_dump($filter);
    $this->db->select("*");
    $this->db->from("umkm_rt as ssk");
    // $this->db->join("kd_kab as ks", "ks.id_kd_kab = ssk.kd_kab", "LEFT");
    // $this->db->where("ssk.NO", $filter['NO']);
    // $this->db->join("kegiatan_survei_attachment as ksa", "ksa.id_kegiatan_survei = ks.id_kegiatan_survei", "LEFT");
    // if(!empty($filter['kd_perusahaan'])) $this->db->where("ssk.NAMA_PERUSAHAAN", $filter['kd_perusahaan']);
    
    // if(!empty($filter['kd_kab'])) $this->db->where("ssk.kd_kab", $filter['kd_kab']);
    if(!empty($filter['kd_kec'])) $this->db->where("ssk.KDKEC", $filter['kd_kec']);
    if(!empty($filter['kd_kel'])) $this->db->where("ssk.KDDESA", $filter['kd_kel']);
    if(!empty($filter['by_nik'])) $this->db->where("ssk.NIK", $filter['by_nik']);
    if(!empty($filter['by_nokk'])) $this->db->where("ssk.NoKK", $filter['by_nokk']);
    if(!empty($filter['ada_pkh'])) {
      if($filter['ada_pkh'] == '2') $filter['ada_pkh'] = '0';
        $this->db->where("ssk.ada_pkh", $filter['ada_pkh']);
     }
     $this->db->GROUP_BY("ssk.NoKK");
      $this->db->limit("500");
    $res = $this->db->get();
    return $res->result_array();
   
  }

  public function getAllPriorPHK($filter){
    // var_dump($filter);
    $this->db->select("*");
    $this->db->from("prior_phk_v2 as ssk");
    $this->db->join("kd_kab as ks", "ks.id_kd_kab = ssk.kd_kab", "LEFT");
    // $this->db->where("ssk.NO", $filter['NO']);
    // $this->db->join("kegiatan_survei_attachment as ksa", "ksa.id_kegiatan_survei = ks.id_kegiatan_survei", "LEFT");
    if(!empty($filter['kd_perusahaan'])) $this->db->where("ssk.NAMA_PERUSAHAAN", $filter['kd_perusahaan']);
  
    if(!empty($filter['kd_kab'])) $this->db->where("ssk.kd_kab", $filter['kd_kab']);
    if(!empty($filter['NO'])) $this->db->where("ssk.NO", $filter['NO']);
    if(!empty($filter['ada_pkh'])) {
      if($filter['ada_pkh'] == '2') $filter['ada_pkh'] = '0';
        $this->db->where("ssk.ada_pkh", $filter['ada_pkh']);
     }
    $res = $this->db->get();
    return $res->result_array();
   
  }

  public function getAllPriorDirumahkan($filter){
    // var_dump($filter);
    // var_dump($filter['ada_pkh']);
    $this->db->select("*");
    $this->db->from("prior_dirumahkan_v2 as ssk");
    $this->db->join("kd_kab as ks", "ks.id_kd_kab = ssk.kd_kab", "LEFT");
    // $this->db->where("ssk.NO", $filter['NO']);
    // $this->db->join("kegiatan_survei_attachment as ksa", "ksa.id_kegiatan_survei = ks.id_kegiatan_survei", "LEFT");
    if(!empty($filter['kd_perusahaan'])) $this->db->where("ssk.NAMA_PERUSAHAAN", $filter['kd_perusahaan']);
 
    if(!empty($filter['kd_kab'])) $this->db->where("ssk.kd_kab", $filter['kd_kab']);
    if(!empty($filter['NO'])) $this->db->where("ssk.NO", $filter['NO']);
    if(!empty($filter['ada_pkh'])) {
     if($filter['ada_pkh'] == '2') $filter['ada_pkh'] = '0';
       $this->db->where("ssk.ada_pkh", $filter['ada_pkh']);
    }
    $res = $this->db->get();
    return $res->result_array();
   
  }

  public function getNoKK($filter){
    $this->db->select("NoKK");
    $this->db->from("data_induk as ssk");
    // $this->db->join("kd_kab as ks", "ks.id_kd_kab = ssk.kd_kab", "LEFT");
    $this->db->where("ssk.NIK", $filter['NIK']);
    $noKK = $this->db->get();
    $noKK = $noKK->result_array();
    if(empty($noKK)) return null;
   return $noKK['0']['NoKK'];
  }
  
  public function getPerusahaanPHK($filter){
    // var_dump($filter);
    $this->db->select("NAMA_PERUSAHAAN");
    $this->db->distinct("NAMA_PERUSAHAAN");
    if(!empty($filter['prior'])){
      $this->db->from("prior_phk_v2 as ssk");  
    }else{
      $this->db->from("terdampak_phk as ssk");
    }
    if(!empty($filter['kd_kab'])) $this->db->where("ssk.kd_kab", $filter['kd_kab']);
    
    // $this->db->join("kd_kab as ks", "ks.id_kd_kab = ssk.kd_kab", "LEFT");
    // $this->db->where("ssk.NIK", $filter['NIK']);
    $res = $this->db->get();
    $res = $res->result_array();
   return $res;
  }

  public function getPerusahaanDirumahkan($filter){
    // var_dump($filter);
    $this->db->select("NAMA_PERUSAHAAN");
    $this->db->distinct("NAMA_PERUSAHAAN");
    
    if(!empty($filter['prior'])){
      $this->db->from("prior_dirumahkan_v2 as ssk");  
    }else{
      $this->db->from("terdampak_dirumahkan as ssk");
    }
    if(!empty($filter['kd_kab'])) $this->db->where("ssk.KD_KAB", $filter['kd_kab']);
    
    // $this->db->join("kd_kab as ks", "ks.id_kd_kab = ssk.kd_kab", "LEFT");
    // $this->db->where("ssk.NIK", $filter['NIK']);
    $res = $this->db->get();
    $res = $res->result_array();
   return $res;
  }
  

  public function getInfoKeluarga($filter){
    // $this->db->select("Nama,TmpLahir,TglLahir,NIK,NoKK,Umur");
    $this->db->select("*");
    
    $this->db->from("data_induk as ssk");
    // $this->db->join("kd_kab as ks", "ks.id_kd_kab = ssk.kd_kab", "LEFT");
    $this->db->where("ssk.NoKK", $filter);
    $res = $this->db->get();
    $res = $res->result_array();
    // var_dump($res);
    // $this->db->join("kegiatan_survei_attachment as ksa", "ksa.id_kegiatan_survei = ks.id_kegiatan_survei", "LEFT");

    // if(!empty($filter['kd_kab'])) $this->db->where("ssk.kd_kab", $filter['kd_kab']);
    // if(!empty($filter['NO'])) $this->db->where("ssk.NO", $filter['NO']);
    // if(!empty($filter['id_kegiatan_renja'])) $this->db->where("ssk.id_kegiatan_renja", $filter['id_kegiatan_renja']);
    // $res = $this->db->get();
    return $res;
   
  }
  
	public function get($id = NULL){
		$row = $this->getAll(['id_kegiatan_renja' => $id]);
		if (empty($row)){
			throw new UserException("Monev yang kamu cari tidak ditemukan", USER_NOT_FOUND_CODE);
		}
		return $row[$id];
  }
  
  public function add($data){
    $this->db->insert('kegiatan_survei', DataStructure::slice($data, ['id_kegiatan_renja', 'tanggal', 'pemeriksa', 'kendala', 'keterangan'], TRUE));
    ExceptionHandler::handleDBError($this->db->error(), "Tambah Kegiatan Monev", "kegiatan_survei");

    return $this->db->insert_id();
	}
	
	public function editDTKSRT($data){
    var_dump($data);
		// $this->db->set(DataStructure::slice($data, ['id_kegiatan_renja', 'tanggal', 'pemeriksa', 'kendala', 'keterangan'], TRUE));
    // $this->db->where('id_kegiatan_survei', $data['id_kegiatan_survei']);
    // $this->db->update('dtks_rt');

		// ExceptionHandler::handleDBError($this->db->error(), "Ubah Kegiatan Monev", "kegiatan_survei");
		
		return $data['id_kegiatan_survei'];
	}
	
  public function getAttachment($id){
    $this->db->select('*');
    $this->db->from('kegiatan_survei_attachment');
    $this->db->where('id_kegiatan_survei_attachment', $id);
    $row = $this->db->get()->result_array();
    if (empty($row)){
			throw new UserException("Attachment yang kamu cari tidak ditemukan", USER_NOT_FOUND_CODE);
		}
		return $row[0]; 
  }

	public function delete($data){
		$this->db->where('id_kegiatan_survei', $data['id_kegiatan_survei']);
		$this->db->delete('kegiatan_survei');

    ExceptionHandler::handleDBError($this->db->error(), "Hapus Kegiatan Monev", "id_kegiatan_survei");
  }
  
	public function addAttachment($data){
    $this->db->insert('kegiatan_survei_attachment', DataStructure::slice($data, ['type', 'filename', 'url', 'size'], TRUE));
		ExceptionHandler::handleDBError($this->db->error(), "Tambah Attachment gagal", "kegiatan_survei_attachment");
		
		return $this->db->insert_id();
  }

  public function updateAttachment($data){
    if(empty($data['attachment'])) return; 
    $attachment = DataStructure::broadcast(DataStructure::to2DArray($data['attachment'], 'id_kegiatan_survei_attachment'), [$data['id_kegiatan_survei']], ['id_kegiatan_survei'], FALSE);
    $this->db->update_batch('kegiatan_survei_attachment', $attachment, 'id_kegiatan_survei_attachment');
		ExceptionHandler::handleDBError($this->db->error(), "Edit Attachment gagal", "kegiatan_survei_attachment");
  }
  
	public function deleteAttachment($data){
		$this->db->where('id_kegiatan_survei_attachment', $data['id_kegiatan_survei_attachment']);
		$this->db->delete('kegiatan_survei_attachment');

    ExceptionHandler::handleDBError($this->db->error(), "Hapus Attachment", "id_kegiatan_survei_attachment");
  }
	
}
