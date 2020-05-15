<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpWord\PhpWord;
class WordController extends CI_Controller {

  public function __construct(){
    parent::__construct();
      $this->load->model(array('DinkesModel','PasienModel','DTKSModel'));
       $this->load->helper(array('DataStructure', 'Validation'));
    $this->db->db_debug = FALSE;
  }
  function converRomawi($mm){
    if($mm == '01') return 'I';
    if($mm == '02') return 'II';
    if($mm == '03') return 'III';
    if($mm == '04') return 'IV';
    if($mm == '05') return 'V';
    if($mm == '06') return 'VI';
    if($mm == '07') return 'VII';
    if($mm == '08') return 'VIII';
    if($mm == '09') return 'IX';
    if($mm == '10') return 'X';
    if($mm == '11') return 'XI';
    if($mm == '12') return 'XII';
  }
  function convStatus($mm){
    if($mm == '1') return 'OTG (Orang Tanpa Gejala)';
    if($mm == '2') return 'ODP (Orang Dalam Pengawasan)';
    if($mm == '3') return 'PDP (Pasien Dalam Pengawasan)';
    if($mm == '4') return 'POSITIVE COVID-19';
    if($mm == '5') return 'NEGATIVE COVID-19';
    if($mm == '6') return 'SEMBUH DARI COVID-19';
    if($mm == '99') return 'SEHAT';
  }

  function convertDateTime2($date,$cetak_hari){
    ;
    $hari = array ( 1 => 'Senin', 'Selasa', 'Rabu',
          'Kamis', 'Jumat', 'Sabtu','Minggu'
        );
    $bulan = array (1 => 'Januari', 'Februari', 'Maret',
          'April', 'Mei', 'Juni',	'Juli',	'Agustus',
          'September', 'Oktober',	'November',	'Desember'
        );
    $tanggal = explode(' ', $date);
  
    $tanggal = $tanggal[0];
     
    $split 	  = explode('-', $tanggal);
    $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
    
    if ($cetak_hari) {
      $num = date('N', strtotime($tanggal));
      return $hari[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
  }
  public function getSKRS(){
      // try{
      $this->SecurityModel->userOnlyGuard(TRUE);
      ini_set('date.timezone', 'Asia/Jakarta');
      $tanggal = date('Y-m-d');
      $no_tanggal = explode('-',$tanggal);
      $get = $this->input->get();
      $data = $this->DinkesModel->getAllRecord($this->input->get());
      $data = $data[$get['id_record']];
      $dataPasien = $this->DinkesModel->getAllPasienProv(array('id_pasien' => $data['id_pasien']));
      $dataPasien = $dataPasien[$data['id_pasien']];
      $phpWord = new PhpOffice\PhpWord\PhpWord();
      $phpWord->addFontStyle('h3', array('name' => 'Times New Roman', 'size' => 12, 'color' => '000000', 'bold' => true));
      $phpWord->addFontStyle('paragraph', array('name' => 'Times New Roman', 'size' => 12, 'color' => '000000'));
      $phpWord->addFontStyle('paragraph_bold', array('name' => 'Times New Roman', 'size' => 12, 'color' => '000000', 'bold' => true));
      $phpWord->addParagraphStyle('center_p', array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 100));

      $fontStyleName = 'rStyle';
      $phpWord->addFontStyle($fontStyleName, array('bold' => true, 'italic' => false, 'size' => 16, 'allCaps' => true));
      $phpWord->addFontStyle('cen_f', array('bold' => false, 'italic' => false, 'size' => 12, 'allCaps' => false));
      
      $paragraphStyleName = 'pStyle';
      $phpWord->addParagraphStyle($paragraphStyleName, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 16, 'spaceBefore' => 0));
      $phpWord->addParagraphStyle('jus_p', array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT, 'spaceAfter' => 1, 'spaceBefore' => 1));


      $section = $phpWord->addSection();
      $section->addImage(base_url('assets/img/head_rskim_hd.jpg'),array(
        'height'           => round(\PhpOffice\PhpWord\Shared\Converter::cmToPixel(2.6)),
        'positioning'      => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
        'posHorizontal' => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
        'posVertical' => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
        'marginLeft'       => round(\PhpOffice\PhpWord\Shared\Converter::cmToPixel(-0.5)),
        'marginTop'        => round(\PhpOffice\PhpWord\Shared\Converter::cmToPixel(-0.5)),
      ));

      if(file_exists('./assets/qrcode/'.$data['id_record'].'.png')){
        // $pdf->Image(base_url('assets/qrcode/'.$data['id_record'].'.png'), 170, 160, -300);
        $section->addImage(base_url('assets/qrcode/'.$data['id_record'].'.png'),array(
          'height'           => round(\PhpOffice\PhpWord\Shared\Converter::cmToPixel(2.6)),
          'positioning'      => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
          'posHorizontal' => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
          'posVertical' => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
          'marginLeft'       => round(\PhpOffice\PhpWord\Shared\Converter::cmToPixel(1)),
          'marginTop'        => round(\PhpOffice\PhpWord\Shared\Converter::cmToPixel(10.8)),
        ));
      }else{
        
      }

      $section->addTextBreak();
      $section->addTextBreak();
      $section->addTextBreak();
      $section->addTextBreak();
      $section->addText('SURAT KETERANGAN', $fontStyleName, $paragraphStyleName);
      $section->addText('Nomor :        /RSKIM/'.($this->converRomawi($no_tanggal[1])).'/2020 ', 'cen_f', $paragraphStyleName);

  

      $textrun = $section->addTextRun();
      // $textrun->addText('SURAT KETERANGAN', $fontStyleName, $paragraphStyleName);
      // $textrun->addText('Nomor :        /RSKIM/'.($this->converRomawi($no_tanggal[1])).'/2020 ', 'cen_f', $paragraphStyleName);

      $textrun->addTextBreak();
      $textrun->addTextBreak();

      $textrun->addText("Yang bertanda tangan di bawah ini, Dokter ".$data['dokter_nama']." menerangkan dengan sesungguhnya bahwa :", 'paragraph', 'jus_p');
      $textrun->addTextBreak();
      $textrun->addTextBreak();
      $textrun->addText("\tNama\t\t\t\t: ".$dataPasien['nama'], 'paragraph');
      $textrun->addTextBreak();
      $textrun->addText("\tNIK\t\t\t\t: ".$dataPasien['NIK'],'paragraph', 'jus_p');
      $textrun->addTextBreak();
      $textrun->addText("\tTempat/Tanggal Lahir\t: ".$dataPasien['tempat_lahir'].' ,'.( $this->convertDateTime2($dataPasien['tanggal_lahir'],false) ),'paragraph', 'jus_p');
      $textrun->addTextBreak();
      $textrun->addText("\tJenis Kelamin\t\t\t: ".($dataPasien['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ),'paragraph', 'jus_p');
      $textrun->addTextBreak();
      $textrun->addText("\tPekerjaan\t\t\t: ".$dataPasien['pekerjaan'],'paragraph', 'jus_p');
      $textrun->addTextBreak();
      $textrun->addText("\tAlamat Lengkap\t\t: ".$dataPasien['alamat'].' , ','paragraph', 'jus_p');
    $textrun->addTextBreak();
    $textrun->addText("\t\t\t\t\t ".$dataPasien['nama_kel'].' , '.$dataPasien['nama_kec'].' , ','paragraph', 'jus_p');
    $textrun->addTextBreak();
    $textrun->addText("\t\t\t\t\t ".$dataPasien['nama_kab'].' , ','paragraph', 'jus_p');
    $textrun->addTextBreak();
    $textrun->addText("\t\t\t\t\t ".$dataPasien['nama_prov'],'paragraph', 'jus_p');
    $textrun->addTextBreak();
      $textrun->addTextBreak();
      $textrun->addText("Telah kami rapid test Antobody dengan hasil ", 'paragraph', 'jus_p');
      
      $textrun->addText("IgM : ".($data['hasil_igm'] == 'reaktif' ? 'Reaktif' : 'Non Reaktif' ) , 'paragraph_bold', 'jus_p');
      $textrun->addText(" - ", 'paragraph', 'jus_p');
      $textrun->addText(" IgG : ".($data['hasil_igg'] == 'reaktif' ? 'Reaktif' : 'Non Reaktif'  ), 'paragraph_bold', 'jus_p');

      $textrun->addText(" dan kami lampirkan hasil pemeriksaan Rapid Test. ", 'paragraph', 'jus_p');
      $textrun->addTextBreak();
      $textrun->addTextBreak();
      $textrun->addText("Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya ", 'paragraph', 'jus_p');
      $textrun->addTextBreak();
      $textrun->addTextBreak();
      $textrun->addText("\t\t\t\t\t\t\tPangkalpinang, ".$this->convertDateTime2($tanggal,false),'paragraph', 'jus_p');
      $textrun->addTextBreak();
      $textrun->addText("\t\t\t\t\t\t\tDokter Pemeriksa RS KIM",'paragraph', 'jus_p');
      $textrun->addTextBreak();
      $textrun->addTextBreak();
      $textrun->addTextBreak();
      $textrun->addTextBreak();
      $textrun->addTextBreak();
      $textrun->addText("\t\t\t\t\t\t\t(  ".$data['dokter_nama']."  )",'paragraph', 'jus_p');
  
      $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
      // FileIO::headerDownloadDocx('Form Pengajuan Mutu - ' . $pengiriman['nama_pengiriman']);
      FileIO::headerDownloadDocx('SK_'.$dataPasien['nama']);
      
      $objWriter->save("php://output");
      // } catch(Exception $e){
      //   ExceptionHandler::handle($e);
      // }
  }
 
  public function getSKSehat(){
    // try{
    $this->SecurityModel->userOnlyGuard(TRUE);
    ini_set('date.timezone', 'Asia/Jakarta');
    $tanggal = date('Y-m-d');
    $no_tanggal = explode('-',$tanggal);
    $get = $this->input->get();
    $data = $this->DinkesModel->getAllRecord($this->input->get());
    $data = $data[$get['id_record']];
    $dataPasien = $this->DinkesModel->getAllPasienProv(array('id_pasien' => $data['id_pasien']));
    $dataPasien = $dataPasien[$data['id_pasien']];
    $phpWord = new PhpOffice\PhpWord\PhpWord();
    $phpWord->addFontStyle('h3', array('name' => 'Times New Roman', 'size' => 12, 'color' => '000000', 'bold' => true));
    $phpWord->addFontStyle('paragraph', array('name' => 'Times New Roman', 'size' => 12, 'color' => '000000'));
    $phpWord->addFontStyle('paragraph_bold', array('name' => 'Times New Roman', 'size' => 12, 'color' => '000000', 'bold' => true));
    $phpWord->addParagraphStyle('center_p', array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 100));

    $fontStyleName = 'rStyle';
    $phpWord->addFontStyle($fontStyleName, array('bold' => true, 'italic' => false, 'size' => 16, 'allCaps' => true));
    $phpWord->addFontStyle('cen_f', array('bold' => false, 'italic' => false, 'size' => 12, 'allCaps' => false));
    
    $paragraphStyleName = 'pStyle';
    $phpWord->addParagraphStyle($paragraphStyleName, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 16, 'spaceBefore' => 0));
    $phpWord->addParagraphStyle('jus_p', array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT, 'spaceAfter' => 1, 'spaceBefore' => 1));


    $section = $phpWord->addSection();
    $section->addImage(base_url('assets/img/head_rskim2.jpg'),array( 'height'           => round(\PhpOffice\PhpWord\Shared\Converter::cmToPixel(2.7)),
    'positioning'      => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
    'posHorizontal' => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
'posVertical' => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
 'marginLeft'       => round(\PhpOffice\PhpWord\Shared\Converter::cmToPixel(-0.5)),
    'marginTop'        => round(\PhpOffice\PhpWord\Shared\Converter::cmToPixel(-0.5)),
  ));

  if(file_exists('./assets/qrcode/'.$data['id_record'].'.png')){
    // $pdf->Image(base_url('assets/qrcode/'.$data['id_record'].'.png'), 170, 160, -300);
    $section->addImage(base_url('assets/qrcode/'.$data['id_record'].'.png'),array(
      'height'           => round(\PhpOffice\PhpWord\Shared\Converter::cmToPixel(2.6)),
      'positioning'      => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
      'posHorizontal' => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
      'posVertical' => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
      'marginLeft'       => round(\PhpOffice\PhpWord\Shared\Converter::cmToPixel(10.1)),
      'marginTop'        => round(\PhpOffice\PhpWord\Shared\Converter::cmToPixel(4.2)),
    ));
  }else{
    
  }

  $section->addTextBreak();
  $section->addTextBreak();
  $section->addTextBreak();
  $section->addTextBreak();
  
      
  
    $section->addText('SURAT KETERANGAN SEHAT', $fontStyleName, $paragraphStyleName);
    $section->addText('Nomor :        /KIM-RM5/'.($this->converRomawi($no_tanggal[1])).'/2020 ', 'cen_f', $paragraphStyleName);



    $textrun = $section->addTextRun();
    $textrun->addTextBreak();
    $textrun->addTextBreak();

    $textrun->addText("Yang bertanda tangan di bawah ini :", 'paragraph', 'jus_p');
    $textrun->addTextBreak();
    $textrun->addText("\tNama\t\t: ".$data['dokter_nama'], 'paragraph', 'jus_p');
    $textrun->addTextBreak();
    $textrun->addText("\tJabatan\t: Dokter RS Kalbu Intan Medika", 'paragraph', 'jus_p');
    $textrun->addTextBreak();
    $textrun->addTextBreak();
    $textrun->addText("Dengan ini menerangkan bahwa :", 'paragraph', 'jus_p');
  
    $textrun->addTextBreak();
    $textrun->addText("\tNama\t\t\t\t: ".$dataPasien['nama'], 'paragraph');
    $textrun->addTextBreak();
    $textrun->addText("\tNIK/Paspor\t\t\t: ".$dataPasien['NIK'],'paragraph', 'jus_p');
    $textrun->addTextBreak();
    $textrun->addText("\tTempat/Tanggal Lahir\t: ".$dataPasien['tempat_lahir'].' ,'.( $this->convertDateTime2($dataPasien['tanggal_lahir'],false) ),'paragraph', 'jus_p');
    $textrun->addTextBreak();
    $textrun->addText("\tJenis Kelamin\t\t\t: ".($dataPasien['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ),'paragraph', 'jus_p');
    $textrun->addTextBreak();
    $textrun->addText("\tPekerjaan\t\t\t: ".$dataPasien['pekerjaan'],'paragraph', 'jus_p');
    $textrun->addTextBreak();
    $textrun->addText("\tAlamat Lengkap\t\t: ".$dataPasien['alamat'].' , ','paragraph', 'jus_p');
    $textrun->addTextBreak();
    $textrun->addText("\t\t\t\t\t ".$dataPasien['nama_kel'].' , '.$dataPasien['nama_kec'].' , ','paragraph', 'jus_p');
    $textrun->addTextBreak();
    $textrun->addText("\t\t\t\t\t ".$dataPasien['nama_kab'].' , ','paragraph', 'jus_p');
    $textrun->addTextBreak();
    $textrun->addText("\t\t\t\t\t ".$dataPasien['nama_prov'],'paragraph', 'jus_p');
    $textrun->addTextBreak();
    $textrun->addText("\tTekanan Darah\t\t: ".$data['tekanan_darah'].' mm/Hg','paragraph', 'jus_p');
    $textrun->addTextBreak();
    $textrun->addText("\tTinggi Badan\t\t\t: ".$data['tinggi_badan'].' cm','paragraph', 'jus_p');
    $textrun->addTextBreak();
    $textrun->addText("\tBerat Badan\t\t\t: ".$data['berat_badan'].' kg','paragraph', 'jus_p');
    $textrun->addTextBreak();
    $textrun->addTextBreak();
    $textrun->addText("Pada pemeriksaan saat ini, dalam keadaan ", 'paragraph', 'jus_p'); 
    $textrun->addText( $this->convStatus($data['after_status']).'.' , 'paragraph_bold', 'jus_p');
    $textrun->addTextBreak();
    $textrun->addTextBreak();
    $textrun->addText("Demikian surat keterangan ini kami buat agar dapat dipergunakan sebagaimana mestinya ", 'paragraph', 'jus_p');
    $textrun->addTextBreak();
    $textrun->addTextBreak();
    $textrun->addText("\t\t\t\t\t\t\tPangkalpinang, ".$this->convertDateTime2($tanggal,false),'paragraph', 'jus_p');
    $textrun->addTextBreak();
    $textrun->addText("\t\t\t\t\t\t\tDokter Pemeriksa RS KIM",'paragraph', 'jus_p');
    $textrun->addTextBreak();
    $textrun->addTextBreak();
    $textrun->addTextBreak();
    $textrun->addTextBreak();
    $textrun->addTextBreak();
    $textrun->addText("\t\t\t\t\t\t\t(  ".$data['dokter_nama']."  )",'paragraph', 'jus_p');

    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    // FileIO::headerDownloadDocx('Form Pengajuan Mutu - ' . $pengiriman['nama_pengiriman']);
    FileIO::headerDownloadDocx('SK_Sehat_'.$dataPasien['nama']);
    
    $objWriter->save("php://output");
    // } catch(Exception $e){
    //   ExceptionHandler::handle($e);
    // }
  }

}