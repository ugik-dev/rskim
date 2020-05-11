<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DTKSModel extends CI_Model {
  var $CI = "";
  public function __construct(){
    parent::__construct();
    $this->CI =& get_instance();
    $this->CI->load->library('form_validation');
    }
    
    public function getAllDTKSART($filter){
      // var_dump($filter);
      $this->db->select("*");
      $this->db->from("dtks_art as ssk");
      // $this->db->join("kd_kab as ks", "ks.id_kd_kab = ssk.kd_kab", "LEFT");
      // $this->db->where("ssk.NO", $filter['NO']);
      // $this->db->join("kegiatan_survei_attachment as ksa", "ksa.id_kegiatan_survei = ks.id_kegiatan_survei", "LEFT");
      // if(!empty($filter['kd_perusahaan'])) $this->db->where("ssk.NAMA_PERUSAHAAN", $filter['kd_perusahaan']);
      if(!empty($filter['ID'])) $this->db->where("ssk.ID", $filter['ID']);
      if(!empty($filter['IDBDT'])) $this->db->where("ssk.IDBDT", $filter['IDBDT']);
      if(!empty($filter['kd_kab'])) $this->db->where("ssk.KDKAB", $filter['kd_kab']);
      if(!empty($filter['kd_kec'])) $this->db->where("ssk.KDKEC", $filter['kd_kec']);
      if(!empty($filter['kd_kel'])) $this->db->where("ssk.KDDESA", $filter['kd_kel']);
      if(!empty($filter['by_nik'])) $this->db->where("ssk.NIK", $filter['by_nik']);
      if(!empty($filter['by_nokk'])) $this->db->where("ssk.NoKK", $filter['by_nokk']);
      if(!empty($filter['sta_pkh'])) $this->db->where("ssk.sta_pkh", $filter['sta_pkh']);
      if(!empty($filter['sta_rastra'])) $this->db->where("ssk.sta_rastra", $filter['sta_rastra']);
      //  $this->db->GROUP_BY("ssk.NoKK");
        $this->db->limit("300");
      $res = $this->db->get();
      return $res->result_array();
     
    }

    public function getAllDTKSRT($filter){
        // var_dump($filter);
        // $this->db->select("*");
        $this->db->select("IDBDT,Nama_KRT,Alamat,NoPesertaPBDT,Nama_SLS,jenis_bantuan");
     
        $this->db->from("dtks_rt as ssk");
        // $this->db->join("kd_kab as ks", "ks.id_kd_kab = ssk.kd_kab", "LEFT");
        // $this->db->where("ssk.NO", $filter['NO']);
        // $this->db->join("kegiatan_survei_attachment as ksa", "ksa.id_kegiatan_survei = ks.id_kegiatan_survei", "LEFT");
        // if(!empty($filter['kd_perusahaan'])) $this->db->where("ssk.NAMA_PERUSAHAAN", $filter['kd_perusahaan']);
        // if(!empty($filter['ID'])) $this->db->where("ssk.ID", $filter['ID']);
        if(!empty($filter['IDBDT'])) $this->db->where("ssk.IDBDT", $filter['IDBDT']);
        if(!empty($filter['kd_kab'])) $this->db->where("ssk.KDKAB", $filter['kd_kab']);
        if(!empty($filter['kd_kec'])) $this->db->where("ssk.KDKEC", $filter['kd_kec']);
        if(!empty($filter['kd_kel'])) $this->db->where("ssk.KDDESA", $filter['kd_kel']);
        if(!empty($filter['by_nik'])) $this->db->where("ssk.NIK", $filter['by_nik']);
        if(!empty($filter['by_nokk'])) $this->db->where("ssk.NoKK", $filter['by_nokk']);
        if(!empty($filter['sta_pkh'])) $this->db->where("ssk.sta_pkh", $filter['sta_pkh']);
        if(!empty($filter['sta_rastra'])) $this->db->where("ssk.sta_rastra", $filter['sta_rastra']);
        //  $this->db->GROUP_BY("ssk.NoKK");
        $this->db->limit("2700");
        $res = $this->db->get();
        return DataStructure::keyValue($res->result_array(), 'IDBDT');
       
      }

      public function getAllUMKM($filter){
        // var_dump($filter);
        $this->db->select("ssk.*,kr.jenis_bantuan as jenis_bantuan");
        $this->db->from("umkm_rt as ssk");
        // $this->db->join("dtks_art as ks", "ks.NIK = ssk.NIK", "LEFT");
        $this->db->join("dtks_rt as kr", "ssk.IDBDT = kr.IDBDT", "LEFT");
    
        // if(!empty($filter['IDBDT'])) $this->db->where("ssk.IDBDT", $filter['IDBDT']);
        if(!empty($filter['IDUMKM'])) $this->db->where("ssk.IDUMKM", $filter['IDUMKM']);
        if(!empty($filter['kd_kab'])) $this->db->where("ssk.KDKAB", $filter['kd_kab']);
        if(!empty($filter['kd_kec'])) $this->db->where("ssk.KDKEC", $filter['kd_kec']);
        if(!empty($filter['kd_kel'])) $this->db->where("ssk.KDDESA", $filter['kd_kel']);
        // if(!empty($filter['by_nik'])) $this->db->where("ssk.NIK", $filter['by_nik']);
        // if(!empty($filter['by_nokk'])) $this->db->where("ssk.NoKK", $filter['by_nokk']);
        if(!empty($filter['sta_pkh'])) $this->db->where("ssk.sta_pkh", $filter['sta_pkh']);
        if(!empty($filter['sta_rastra'])) $this->db->where("ssk.sta_rastra", $filter['sta_rastra']);
        //  $this->db->GROUP_BY("ssk.NoKK");
          // $this->db->limit("300");
        $res = $this->db->get();
        return DataStructure::keyValue($res->result_array(), 'IDUMKM');
       
      }

      public function getAllDTKSRT_v2($filter){
        // var_dump($filter);
        $this->db->select("ssk.* , ks.Kabupaten as nama_kab, ks.KECAMATAN as nama_kec, ks.Kelurahan as nama_kel ");
        $this->db->from("dtks_rt as ssk");
        $this->db->join("kd_area_v2 as ks", "ks.KodeKab = ssk.KDKAB AND ks.KodeKec = ssk.KDKEC AND ks.KodeKel = ssk.KDDESA", "LEFT");
        // $this->db->where("ssk.NO", $filter['NO']);
        // $this->db->join("kegiatan_survei_attachment as ksa", "ksa.id_kegiatan_survei = ks.id_kegiatan_survei", "LEFT");
        // if(!empty($filter['kd_perusahaan'])) $this->db->where("ssk.NAMA_PERUSAHAAN", $filter['kd_perusahaan']);
        if(!empty($filter['IDARTBDT'])) $this->db->where("ssk.IDARTBDT", $filter['IDARTBDT']);
        if(!empty($filter['IDBDT'])) $this->db->where("ssk.IDBDT", $filter['IDBDT']);
        if(!empty($filter['kd_kab'])) $this->db->where("ssk.KDKAB", $filter['kd_kab']);
        if(!empty($filter['kd_kec'])) $this->db->where("ssk.KDKEC", $filter['kd_kec']);
        if(!empty($filter['kd_kel'])) $this->db->where("ssk.KDDESA", $filter['kd_kel']);
        if(!empty($filter['by_nik'])) $this->db->where("ssk.NIK", $filter['by_nik']);
        if(!empty($filter['by_nokk'])) $this->db->where("ssk.NoKK", $filter['by_nokk']);
        if(!empty($filter['sta_pkh'])) $this->db->where("ssk.sta_pkh", $filter['sta_pkh']);
        if(!empty($filter['sta_rastra'])) $this->db->where("ssk.sta_rastra", $filter['sta_rastra']);
        //  $this->db->GROUP_BY("ssk.NoKK");
          $this->db->limit("300");
        $res = $this->db->get();
        return $res->result_array();
       
      }

      public function getAllUMKM_v2($filter){
        // var_dump($filter);
        // $this->db->select("ssk.* , ks.Kabupaten as nama_kab, ks.KECAMATAN as nama_kec, ks.Kelurahan as nama_kel ");
        $this->db->select("*");

        $this->db->from("umkm_rt as ssk");
        $this->db->join("umkm_induk as ks", "ks.NO_KTP = ssk.NIK", "LEFT");
        // $this->db->where("ssk.NO", $filter['NO']);
        // $this->db->join("kegiatan_survei_attachment as ksa", "ksa.id_kegiatan_survei = ks.id_kegiatan_survei", "LEFT");
        // if(!empty($filter['kd_perusahaan'])) $this->db->where("ssk.NAMA_PERUSAHAAN", $filter['kd_perusahaan']);
        if(!empty($filter['IDARTBDT'])) $this->db->where("ssk.IDARTBDT", $filter['IDARTBDT']);
        if(!empty($filter['IDUMKM'])) $this->db->where("ssk.IDUMKM", $filter['IDUMKM']);
        if(!empty($filter['kd_kab'])) $this->db->where("ssk.KDKAB", $filter['kd_kab']);
        if(!empty($filter['kd_kec'])) $this->db->where("ssk.KDKEC", $filter['kd_kec']);
        if(!empty($filter['kd_kel'])) $this->db->where("ssk.KDDESA", $filter['kd_kel']);
        if(!empty($filter['by_nik'])) $this->db->where("ssk.NIK", $filter['by_nik']);
        if(!empty($filter['by_nokk'])) $this->db->where("ssk.NoKK", $filter['by_nokk']);
        if(!empty($filter['sta_pkh'])) $this->db->where("ssk.sta_pkh", $filter['sta_pkh']);
        if(!empty($filter['sta_rastra'])) $this->db->where("ssk.sta_rastra", $filter['sta_rastra']);
        //  $this->db->GROUP_BY("ssk.NoKK");
          $this->db->limit("300");
        $res = $this->db->get();
        return $res->result_array();
       
      }

      public function getAllDTKSRT_info($filter){
        // var_dump($filter);
        $this->db->select("count(*) as total");
        $this->db->from("dtks_rt as ssk");
        // $this->db->join("kd_kab as ks", "ks.id_kd_kab = ssk.kd_kab", "LEFT");
        // $this->db->where("ssk.NO", $filter['NO']);
        // $this->db->join("kegiatan_survei_attachment as ksa", "ksa.id_kegiatan_survei = ks.id_kegiatan_survei", "LEFT");
        // if(!empty($filter['kd_perusahaan'])) $this->db->where("ssk.NAMA_PERUSAHAAN", $filter['kd_perusahaan']);
        // if(!empty($filter['IDARTBDT'])) $this->db->where("ssk.IDARTBDT", $filter['IDARTBDT']);
        if(!empty($filter['IDBDT'])) $this->db->where("ssk.IDBDT", $filter['IDBDT']);
        if(!empty($filter['kd_kab'])) $this->db->where("ssk.KDKAB", $filter['kd_kab']);
        if(!empty($filter['kd_kec'])) $this->db->where("ssk.KDKEC", $filter['kd_kec']);
        if(!empty($filter['kd_kel'])) $this->db->where("ssk.KDDESA", $filter['kd_kel']);
        if(!empty($filter['by_nik'])) $this->db->where("ssk.NIK", $filter['by_nik']);
        if(!empty($filter['by_nokk'])) $this->db->where("ssk.NoKK", $filter['by_nokk']);
        if(!empty($filter['sta_pkh'])) $this->db->where("ssk.sta_pkh", $filter['sta_pkh']);
        if(!empty($filter['sta_rastra'])) $this->db->where("ssk.sta_rastra", $filter['sta_rastra']);
        //  $this->db->GROUP_BY("ssk.NoKK");
        $res = $this->db->get();
        $res = $res->result_array();
        $res['0']['jenis']='provinsi';
        if(!empty($filter['kd_kab'])) $res['0']['jenis']='kabupaten';
        if(!empty($filter['kd_kec'])) $res['0']['jenis']='kecamatan';
        if(!empty($filter['kd_kel'])) $res['0']['jenis']='kelurahan';

        return $res['0'];
      }

      
      public function getAllUMKM_info($filter){
        // var_dump($filter);
        $this->db->select("count(*) as total");
        $this->db->from("umkm_rt as ssk");
        // $this->db->join("kd_kab as ks", "ks.id_kd_kab = ssk.kd_kab", "LEFT");
        // $this->db->where("ssk.NO", $filter['NO']);
        // $this->db->join("kegiatan_survei_attachment as ksa", "ksa.id_kegiatan_survei = ks.id_kegiatan_survei", "LEFT");
        // if(!empty($filter['kd_perusahaan'])) $this->db->where("ssk.NAMA_PERUSAHAAN", $filter['kd_perusahaan']);
        // if(!empty($filter['IDARTBDT'])) $this->db->where("ssk.IDARTBDT", $filter['IDARTBDT']);
        if(!empty($filter['IDBDT'])) $this->db->where("ssk.IDBDT", $filter['IDBDT']);
        if(!empty($filter['kd_kab'])) $this->db->where("ssk.KDKAB", $filter['kd_kab']);
        if(!empty($filter['kd_kec'])) $this->db->where("ssk.KDKEC", $filter['kd_kec']);
        if(!empty($filter['kd_kel'])) $this->db->where("ssk.KDDESA", $filter['kd_kel']);
        if(!empty($filter['by_nik'])) $this->db->where("ssk.NIK", $filter['by_nik']);
        if(!empty($filter['by_nokk'])) $this->db->where("ssk.NoKK", $filter['by_nokk']);
        if(!empty($filter['sta_pkh'])) $this->db->where("ssk.sta_pkh", $filter['sta_pkh']);
        if(!empty($filter['sta_rastra'])) $this->db->where("ssk.sta_rastra", $filter['sta_rastra']);
        //  $this->db->GROUP_BY("ssk.NoKK");
        $res = $this->db->get();
        $res = $res->result_array();
        $res['0']['jenis']='provinsi';
        if(!empty($filter['kd_kab'])) $res['0']['jenis']='kabupaten';
        if(!empty($filter['kd_kec'])) $res['0']['jenis']='kecamatan';
        if(!empty($filter['kd_kel'])) $res['0']['jenis']='kelurahan';

        return $res['0'];
      }

      public function editDTKSRT($data){
       
        // $this->db->set(DataStructure::slice($data, ['ID', 'jenis_bantuan'], TRUE));
        $this->db->set('jenis_bantuan', $data['jenis_bantuan']);
	
        $this->db->where('IDBDT', $data['IDBDT']);
        $this->db->update('dtks_rt');
        ExceptionHandler::handleDBError($this->db->error(), "Ubah Jenis Bantuan", "dtks_rt");
        return $data['IDBDT'];
      }
    }
