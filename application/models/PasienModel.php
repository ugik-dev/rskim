<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PasienModel extends CI_Model {
  var $CI = "";
  public function __construct(){
    parent::__construct();
    $this->CI =& get_instance();
    $this->CI->load->library('form_validation');
    }
    
    public function getAllSampel($filter){
      
      if($this->session->userdata('nama_role') == 'petugas_labor'){
        $this->db->select("ssk.* , ks.* , dp.email as email");
        $this->db->where("ssk.no_sampel !=", '');
      }else{
        $this->db->select("ssk.* , ks.* , dp.nama as nama_pasien,  dp.email as email, dp.NIK as nik , kd.Kabupaten as nama_kab, kd.KECAMATAN as nama_kec , kd.Kelurahan as nama_kel");
      }
       $this->db->from("data_sampel as ssk");
      $this->db->join("instansi as ks", "ks.id_instansi = ssk.instansi", "LEFT");
       $this->db->join("data_pasien as dp", "dp.id_pasien = ssk.id_pasien", "LEFT");
    
      $this->db->join("kd_area_v2 as kd", "kd.KodeKab = dp.KDKAB AND kd.KodeKec = dp.KDKEC AND kd.KodeKel = dp.KDKEL", "LEFT");
      // $idSub = $this->session->userdata('id_sub');
      // if(!empty($filter['id_pasien'])) $this->db->where("ssk.id_pasien", $filter['id_pasien']);
      if(!empty($filter['sta'])) $this->db->where("ssk.status_sampel", $filter['sta']);
      if(!empty($filter['id_pasien'])) $this->db->where("ssk.id_pasien", $filter['id_pasien']);
      if(!empty($filter['id_sampel'])) $this->db->where("ssk.id_sampel", $filter['id_sampel']);
      if(!empty($filter['id_instansi'])) $this->db->where("ssk.instansi", $filter['id_instansi']);
        $this->db->limit("1000");
      $res = $this->db->get();
      return DataStructure::keyValue($res->result_array(), 'id_sampel');
     
    }

    public function getAllSampelForLabor($filter){
      
      
      $this->db->select("ssk.* , ks.* , dp.nama as nama_pasien,  dp.email as email, dp.NIK as nik , kd.Kabupaten as nama_kab, kd.KECAMATAN as nama_kec , kd.Kelurahan as nama_kel");
      
       $this->db->from("data_sampel as ssk");
       $this->db->join("instansi as ks", "ks.id_instansi = ssk.instansi", "LEFT");
       $this->db->join("data_pasien as dp", "dp.id_pasien = ssk.id_pasien", "LEFT");
    
      $this->db->join("kd_area_v2 as kd", "kd.KodeKab = dp.KDKAB AND kd.KodeKec = dp.KDKEC AND kd.KodeKel = dp.KDKEL", "LEFT");
       if(!empty($filter['id_pasien'])) $this->db->where("ssk.id_pasien", $filter['id_pasien']);
      if(!empty($filter['id_sampel'])) $this->db->where("ssk.id_sampel", $filter['id_sampel']);
      if(!empty($filter['id_instansi'])) $this->db->where("ssk.instansi", $filter['id_instansi']);
        $this->db->limit("1000");
      $res = $this->db->get();
      return DataStructure::keyValue($res->result_array(), 'id_sampel');
     
    }

    public function getAllKontak($filter){
      
      $this->db->select("*");
      $this->db->from("data_kontak as ssk");
      if(!empty($filter['id_pasien'])) $this->db->where("ssk.id_pasien", $filter['id_pasien']);
      if(!empty($filter['id_data_kontak'])) $this->db->where("ssk.id_data_kontak", $filter['id_data_kontak']);
        $this->db->limit("1000");
      $res = $this->db->get();
      return DataStructure::keyValue($res->result_array(), 'id_data_kontak');
     
    }


    public function getAllTracking($filter){
      
      $this->db->select("*");
      $this->db->from("data_tracking as ssk");
      if(!empty($filter['id_pasien'])) $this->db->where("ssk.id_pasien", $filter['id_pasien']);
      if(!empty($filter['id_data_tracking'])) $this->db->where("ssk.id_data_tracking", $filter['id_data_tracking']);
        $this->db->limit("1000");
      $res = $this->db->get();
      return DataStructure::keyValue($res->result_array(), 'id_data_tracking');
     
    }
    public function getAllPasien_v2($filter){
      // var_dump($filter);
      $this->db->select("ssk.*, sp.nama_status as nama_status, ks.Kabupaten as nama_kab, ks.KECAMATAN as nama_kec, ks.Kelurahan as nama_kel ");
      $this->db->from("data_pasien as ssk");
      $this->db->join("kd_area_v2 as ks", "ks.KodeKab = ssk.KDKAB AND ks.KodeKec = ssk.KDKEC AND ks.KodeKel = ssk.KDKEL", "LEFT");
      
      $this->db->join("status_pasien as sp", "sp.id_status = ssk.status", "LEFT");
      // $this->db->where("ssk.NO", $filter['NO']);
      // $this->db->join("kegiatan_survei_attachment as ksa", "ksa.id_kegiatan_survei = ks.id_kegiatan_survei", "LEFT");
      // if(!empty($filter['kd_perusahaan'])) $this->db->where("ssk.NAMA_PERUSAHAAN", $filter['kd_perusahaan']);
       // $idSub = $this->session->userdata('id_sub');
      if(!empty($this->session->userdata('id_sub'))) $this->db->where("ssk.id_pasien", $this->session->userdata('id_sub'));
      if(!empty($filter['id_pasien'])) $this->db->where("ssk.id_pasien", $filter['id_pasien']);
      if(!empty($filter['IDBDT'])) $this->db->where("ssk.IDBDT", $filter['IDBDT']);
      if(!empty($filter['kd_kab'])) $this->db->where("ssk.KDKAB", $filter['kd_kab']);
      if(!empty($filter['kd_kec'])) $this->db->where("ssk.KDKEC", $filter['kd_kec']);
      if(!empty($filter['kd_kel'])) $this->db->where("ssk.KDKEL", $filter['kd_kel']);
      if(!empty($filter['by_nik'])) $this->db->where("ssk.NIK", $filter['by_nik']);
      if(!empty($filter['by_nokk'])) $this->db->where("ssk.NoKK", $filter['by_nokk']);
      if(!empty($filter['sta_pkh'])) $this->db->where("ssk.sta_pkh", $filter['sta_pkh']);
      if(!empty($filter['sta_rastra'])) $this->db->where("ssk.sta_rastra", $filter['sta_rastra']);
      //  $this->db->GROUP_BY("ssk.NoKK");
        $this->db->limit("1000");
      $res = $this->db->get();
      return $res->result_array();
     
    }

    public function getAllRecord($filter){
      // var_dump($filter);
      $this->db->select("ssk.* ,sp.nama_status");
      $this->db->from("record_pasien as ssk");
      $this->db->join("status_pasien as sp", "ssk.before_status = sp.id_status", "LEFT");
      if(!empty($this->session->userdata('id_sub'))) $this->db->where("ssk.id_pasien", $this->session->userdata('id_sub'));
     
      // $this->db->where("ssk.NO", $filter['NO']);
      // $this->db->join("kegiatan_survei_attachment as ksa", "ksa.id_kegiatan_survei = ks.id_kegiatan_survei", "LEFT");
      // if(!empty($filter['kd_perusahaan'])) $this->db->where("ssk.NAMA_PERUSAHAAN", $filter['kd_perusahaan']);
      if(!empty($filter['id_pasien'])) $this->db->where("ssk.id_pasien", $filter['id_pasien']);
      if(!empty($filter['id_record'])) $this->db->where("ssk.id_record", $filter['id_record']);
      if(!empty($filter['is_self'])) $this->db->where("ssk.id_record != ", $filter['is_self']);

     $this->db->limit("1000");
      $res = $this->db->get();
      return DataStructure::keyValue($res->result_array(), 'id_record');
     
 
     
    }

     public function requestSampel($data){
    
      if(!empty($data['hasil'])){
        ini_set('date.timezone', 'Asia/Jakarta');
        $data['tanggal_pengambilan_sampel'] = date('Y-m-d H:i:s');
       }
      // $data['status'] = $data['id_status'];
      $this->db->insert('data_sampel', DataStructure::slice($data, [
        'id_pasien','jenis','instansi','hasil','tanggal_pengambilan_sampel','no_sampel','status_sampel'
      ], TRUE));
      ExceptionHandler::handleDBError($this->db->error(), "Tambah Data Pasien", "data_sampel");
  
      return $this->db->insert_id();
    }


      public function editPasien($data){
       
        // $this->db->set(DataStructure::slice($data, ['ID', 'jenis_bantuan'], TRUE));
        // $this->db->set('jenis_bantuan', $data['jenis_bantuan']);
        $this->db->set(DataStructure::slice($data, [
          'nama', 'NIK', 'KDKAB', 'KDKEC', 'KDKEL', 'status', 'email', 'nomorhp', 'alamat'
        ], TRUE));
  
        $this->db->where('id_pasien', $data['id_pasien']);
        $this->db->update('data_pasien');
        ExceptionHandler::handleDBError($this->db->error(), "Ubah Jenis Bantuan", "data_pasien");
        return $data['id_pasien'];
      }

      
      public function editSampel($data){

           if(!empty($data['hasil'])){
            ini_set('date.timezone', 'Asia/Jakarta');
            $data['tanggal_pengambilan_sampel'] = date('Y-m-d H:i:s');
           }

        $this->db->set(DataStructure::slice($data, [
         'tanggal_pengambilan_sampel','status_sampel','hasil','no_sampel','tanggal_hasil_labor','hasil_labor'
        ], TRUE));
        $this->db->where('id_sampel', $data['id_sampel']);
        $this->db->update('data_sampel');
        ExceptionHandler::handleDBError($this->db->error(), "Edit Sampel", "data_sampel");
        return $data['id_sampel'];
      }

      public function addTracking($data){
  
        // $data['status'] = $data['id_status'];
        $this->db->insert('data_tracking', DataStructure::slice($data, [
          'id_pasien', 'negara','kota','tanggal_pergi','tanggal_pulang'
        ], TRUE));
        ExceptionHandler::handleDBError($this->db->error(), "Tambah Data Pasien", "data_tracking");
    
        return $this->db->insert_id();
      }
      public function editTracking($data){
           
      $this->db->set(DataStructure::slice($data, [
         'negara','kota','tanggal_pergi','tanggal_pulang'
        ], TRUE));
        $this->db->where('id_data_tracking', $data['id_data_tracking']);
        $this->db->update('data_tracking');
        ExceptionHandler::handleDBError($this->db->error(), "Edit Sampel", "data_tracking");
        return $data['id_data_tracking'];
      }

      public function deleteTracking($data){
        $this->db->where('id_data_tracking', $data['id_data_tracking']);
        $this->db->delete('data_tracking');
    
        ExceptionHandler::handleDBError($this->db->error(), "Hapus Data Tracking", "data_tracking");
      }

      
      public function addKontak($data){
  
        // $data['status'] = $data['id_status'];
        $this->db->insert('data_kontak', DataStructure::slice($data, [
          'id_pasien', 'id_pasien', 'nama', 'alamat', 'hubungan', 'tanggal_pertama', 'tanggal_terakhir', 'pneunomia_berat', 'sakit_sama'
        ], TRUE));
        ExceptionHandler::handleDBError($this->db->error(), "Tambah Data Pasien", "data_kontak");
    
        return $this->db->insert_id();
      }
      public function editKontak($data){
           
      $this->db->set(DataStructure::slice($data, [
        'nama', 'alamat', 'hubungan', 'tanggal_pertama', 'tanggal_terakhir', 'pneunomia_berat', 'sakit_sama'
        ], TRUE));
        $this->db->where('id_data_kontak', $data['id_data_kontak']);
        $this->db->update('data_kontak');
        ExceptionHandler::handleDBError($this->db->error(), "Edit Sampel", "data_kontak");
        return $data['id_data_kontak'];
      }

      public function deleteKontak($data){
        $this->db->where('id_data_kontak', $data['id_data_kontak']);
        $this->db->delete('data_kontak');
    
        ExceptionHandler::handleDBError($this->db->error(), "Hapus Data Tracking", "data_kontak");
      }

      public function editRecord($data){
        if(!empty($data['del_rs'])) $data['pengirim_spesimen_rs'] = '1';
        if(!empty($data['del_dinkes'])) $data['pengirim_spesimen_dinkes'] = '1';
        // $this->db->set(DataStructure::slice($data, ['ID', 'jenis_bantuan'], TRUE));
        // $this->db->set('jenis_bantuan', $data['jenis_bantuan']);
        // 'tanggal_record', 'before_status', 'deskripsi', 'no_rekam', 'rumah_sakit','after_status'
       
        $this->db->set(DataStructure::slice($data, [
          'before_status', 'after_status', 'tanggal_record', 'deskripsi', 'no_rekam',
          'pengirim_spesimen_rs', 'pengirim_spesimen_dinkes', 'dinkes_prov', 'dinkes_kab',
          'rumah_sakit', 'rumah_sakit_kab', 'dokter_nama', 'dokter_nomorhp', 'tanggal_onset', 
          'panas', 'batuk', 'sakit_tenggorokan', 'sesak_napas', 'pilek', 'lesu', 'sakit_kepala', 
          'diare', 'mual_muntah', 'xray', 'hasil_xray', 'lekousit', 'limposit', 'trombosit',
           'ventilator', 'status_kesehatan', 'usap_nasofaring', 'date_usap_nasofaring',
            'usap_orofaring', 'date_usap_orofaring', 'sputum', 'date_sputum', 'serum',
             'date_serum', 'lainnya1', 'lainnya1_text', 'date_lainnya1', 'lainnya2', 
             'lainnya2_text', 'date_lainnya2', 'kesimpulan'
        ], TRUE));
        $this->db->where('id_record', $data['id_record']);
        $this->db->update('record_pasien');
        ExceptionHandler::handleDBError($this->db->error(), "Ubah Jenis Bantuan", "record_pasien");
        return $data['id_record'];
      }

      public function deletePasien($data){
        $this->db->where('id_pasien', $data['id_pasien']);
        $this->db->delete('data_pasien');
    
        ExceptionHandler::handleDBError($this->db->error(), "Hapus Pasien", "data_pasien");
      }

      public function deleteRecord($data){
        $this->db->where('id_record', $data['id_record']);
        $this->db->delete('record_pasien');
    
        ExceptionHandler::handleDBError($this->db->error(), "Hapus Pasien", "record_pasien");
      }
    }
    
