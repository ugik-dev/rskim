<div class="wrapper wrapper-content animated fadeInRight" id="info_container">
  <div class="row">
    <div class="col-lg-8">
      <div class="ibox">
        <div class="ibox-content">
            <h5>Nama</h5>
            <p class="no-margins"><span id="nama">-</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="ibox">
        <div class="ibox-content">
            <h5>NIK</h5>
            <p class="no-margins"><span id="nik">-</span></p>
        </div>
      </div>
    </div>
    <div hidden class="col-lg-4">
      <div class="ibox">
        <div class="ibox-content">
          <h5>Status</h5>
          <p class="no-margins"><span id="status">-</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="ibox">
        <div class="ibox-content">
            <h5>Nomor Hp</h5>
            <p class="no-margins"><span id="nomorhp">-</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="ibox">
        <div class="ibox-content">
            <h5>Email</h5>
            <p class="no-margins"><span id="email">-</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="ibox">
        <div class="ibox-content">
            <h5>Jenis Kelamin</h5>
            <p class="no-margins"><span id="jenis_kelamin">-</span></p>
        </div>
      </div>
    </div>
   
      <div class="col-lg-4">
        <div class="ibox">
          <div class="ibox-content">
            <h5>Tempat Lahir</h5>
            <p class="no-margins"><span id="tempat_lahir">-</span></p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="ibox">
          <div class="ibox-content">
            <h5>Tanggal Lahir</h5>
            <p class="no-margins"><span id="tanggal_lahir">-</span></p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="ibox">
          <div class="ibox-content">
            <h5>Usia</h5>
            <p class="no-margins"><span id="usia">-</span></p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
      <div class="ibox">
        <div class="ibox-content">
            <h5>Nama Kepala Rumah Tangga</h5>
            <p class="no-margins"><span id="info_nama_krt">-</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="ibox">
        <div class="ibox-content">
            <h5>Pekerjaan</h5>
            <p class="no-margins"><span id="info_pekerjaan">-</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="ibox">
        <div class="ibox-content">
            <h5>Kewarganegaraan</h5>
            <p class="no-margins"><span id="info_kewarganegaraan">-</span></p>
        </div>
      </div>
    </div>
    <div hidden class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <h5>Tempat Cek Kesehatan</h5>
          <p class="no-margins"><span id="tempat_cek">-</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="ibox">
        <div class="ibox-content">
          <h5>Alamat</h5>
          <p class="no-margins"><span id="alamat">-</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
        <div class="ibox">
          <div class="ibox-content">
            <h5>Provinsi</h5>
            <p class="no-margins"><span id="nama_prov">-</span></p>
          </div>
        </div>
      </div>
 
 
    <div hidden class="col-lg-4">
      <div class="ibox">
        <div class="ibox-content">
          <h5>Total Cek</h5>
          <p class="no-margins"><span id="jumlah_cek">-</span></p>
        </div>
      </div>
    </div>
    <div hidden class="col-lg-4">
      <div class="ibox">
        <div class="ibox-content">
          <h5>Status Akun</h5>
          <p class="no-margins"><span id="active">-</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
    <div class="row">
      <div class="col-lg-4">
        <div class="ibox">
          <div class="ibox-content">
            <h5>Kabupaten</h5>
            <p class="no-margins"><span id="nama_kab">-</span></p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="ibox">
          <div class="ibox-content">
            <h5>Kecamatan</h5>
            <p class="no-margins"><span id="nama_kec">-</span></p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="ibox">
          <div class="ibox-content">
            <h5>Keluarahan / Desa</h5>
            <p class="no-margins"><span id="nama_kel">-</span></p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="ibox">
          <!-- <div class=""> -->
          <button class="btn btn-success my-1 mr-sm-2" id="edit_info_btn"><i class='fa fa-edit'></i> Edit Informasi</button>
          <button class="btn btn-success my-1 mr-sm-2" id="add_record_btn"><i class='fa fa-plus'></i> Tambah Data Medis</button>
   
          <!-- </div> -->
        </div>
      </div>
      </div>
    </div>
    <div class="row">
    <div class="col-lg-4">
     </div>
  </div>
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <h5>Riwayat Cek</h5>
          <div class="table-responsive">
            <table id="FDataTable" class="table table-bordered table-hover" style="padding:0px">
              <thead>
                <tr>
                  <th style="width: 12%; text-align:center!important">No Antri</th>
                  <th style="width: 24%; text-align:center!important">No Rekam Medis</th>
                  <th style="width: 16%; text-align:center!important">Tanggal</th>
                  <th style="width: 16%; text-align:center!important">Action</th>
                  
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal inmodal" id="record_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Tambah Data Rekam Medis</h4>
            <span class="info"></span>
        </div>
        <div class="modal-body" id="modal-body">              
          <form role="form" id="record_form" onsubmit="return false;" type="multipart">
            <input type="hidden" id="id_record" name="id_record">
            <input type="hidden" id="id_pasien_rec" name="id_pasien">
            <input type="hidden" id="berbayar" name="berbayar" value='Ya'>
            <div class="row">
              <div class="col-sm-12">
                  <div class="form-group">
                    <label for="tanggal_record">No Antri</label> 
                    <input type="text" class="form-control" id="no_antri" name="no_antri" required="required" >
                  </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="tanggal_record">Tanggal (Untuk input manual : YYYY-MM-DD HH:mm)</label> 
                  <input type="datetime-local" class="form-control" id="tanggal_record" name="tanggal_record" required="required" >
                </div>
              </div>
              <div hidden class="col-sm-12">
                  <div class ="form-group">
                    <label for="before_status">Status Awal</label>
                    <select class="form-control mr-sm-2" id="before_status" name="before_status" required="required" readonly>
                    </select>
                  </div>
              </div>
              
              <div class="col-sm-12">
                <div class="form-group">
                <label for="jenis_sampel">Jenis Uji</label> 
                  <select class="form-control mr-sm-2" id="jenis_sampel" name="jenis" required="required">
                  </select>
                </div>
              </div>
              <div hidden class="col-sm-12">
                <div class="form-group">
                  <label  for="tanggal_record">Nama Rumah Sakit</label> 
                  <input readonly="readonly" type="text" class="form-control" id="rumah_sakit" name="rumah_sakit" required="required" >
                </div>
              </div>
              <div hidden class="col-sm-12">
                <div class="form-group">
                  <label for="deskripsi">Deskripsi</label> 
                  <textarea disabled rows="4" type="text" placeholder="deskripsi" class="form-control" id="deskripsi" name="deskripsi" required="required"></textarea>
                  </div>
              </div>
              
            </div>
           
            <button class="btn btn-success my-1 mr-sm-2" type="submit" id="add_btn" data-loading-text="Loading..." onclick="this.form.target='add'"><strong>Tambah Data</strong></button>
            <button class="btn btn-success my-1 mr-sm-2" type="submit" id="save_edit_btn" data-loading-text="Loading..." onclick="this.form.target='edit'"><strong>Simpan Perubahan</strong></button>
     
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

<div class="modal inmodal" id="informasi_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Input Bantuan</h4>
            <span class="info"></span>
        </div>
        <div class="modal-body" id="modal-body">              
          <form role="form" id="informasi_form" onsubmit="return false;" type="multipart">
            <!-- <input type="hidden" id="NO" name="NO"> -->
            <input type="hidden"  id="ID_edit" name="ID">
            <div class="form-group">
            <select class="form-control mr-sm-2" name="jenis_bantuan" id="kd_jenis_bantuan"></select>
            </div>
            <button class="btn btn-success my-1 mr-sm-2" type="submit" id="save" data-loading-text="Loading..."><strong>Simpan</strong></button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>


<div class="modal inmodal" id="pasien_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Kelola Pasien</h4>
        <span class="info"></span>
      </div>
      <div class="modal-body" id="modal-body"> 
      <!-- <form role="form" id="user_form" onsubmit="return false;" type="multipart" autocomplete="off">  -->
      <form id="user_form" role="form" onsubmit="return false;" type="multipart" autocomplete="off">

          <input type="hidden" id="id_pasien" name="id_pasien">
          <!-- <input type="hidden" id="id_puskesmas" name="id_puskesmas"> -->
          <input type="hidden" id="id_user" name="id_user">
        
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
               <label for="terdata">Username</label> 
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required="required" autocomplete="username">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
              <label for="terdata">NIK (Sesuai KTP)</label> 
                  <input type="number" class="form-control" id="NIK" name="NIK" placeholder="NIK" required="required" autocomplete="current-password">
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
              <label for="terdata">Password</label> 
                <input type="password" class="form-control"  id="password" name="password" placeholder="Kosongkan Jika Tidak Diganti" required="required" autocomplete="current-password">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="terdata">Nama (Sesuai KTP)</label> 
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required="required" autocomplete="">
              </div>
            </div>
          </div>
         
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="terdata">Re-Password</label> 
                  <input disabled type="password" class="form-control"  id="repassword" name="repassword" placeholder="Re-Password" required="required" autocomplete="current-repassword">
                </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="terdata">Jenis Kelamin</label> 
                <select class="form-control mr-sm-2" id="sl_kelamin" name="jenis_kelamin" required="required">
              </select>
               </div>
            </div>
            
          </div>
          <div class="row">
          <div class="col-lg-6">
              <div class="form-group">
              <label for="terdata">Nama Kepala Rumah Tangga</label> 
                  <input type="text" class="form-control" id="nama_krt" name="nama_krt" placeholder="Nama Kepala Rumah Tangga" required="required" autocomplete="current-password">
                </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
              <label for="terdata">Hamil / Pasca Melahirkan</label> 
              <select class="form-control mr-sm-2" id="sl_hamil" name="pasca_hamil" required="required">
              </select>  </div>
            </div>
          </div>
          <div class="row">
          <div class="col-lg-6">
              <div class="form-group">
              <label for="terdata">Nomor Hp</label> 
                  <input type="number" class="form-control"  id="nomorhp" name="nomorhp" placeholder="Nomor Hp" required="required" autocomplete="current-password">
                </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
              <label for="terdata">Tempat Lahir</label> 
                  <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" required="required" autocomplete="">
                </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
              <label for="terdata">Email</label> 
                <input type="text" class="form-control" id="email" name="email" placeholder="Email" required="required" autocomplete="username">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
              <label for="terdata">Tanggal Lahir (YYYY-MM-DD)</label> 
                  <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" required="required" autocomplete="">
                </div>
            </div>
          
          </div>
          <div class="row">
          <div class="col-lg-6">
              <div class="form-group">
              <label for="terdata">Pekerjaan</label> 
                  <input type="text" class="form-control"  id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan" required="required" autocomplete="current-password">
                </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
              <label for="terdata">Kewarganegaraan</label> 
              <select class="form-control mr-sm-2" id="sl_kewarganegaraan" name="kewarganegaraan" required="required">
            </select>
                </div>
            </div>
          </div>
          <div class="row">
          <div class="col-lg-6">
              <div class="form-group">
              <label for="terdata">Kategori Pasien</label> 
              <select class="form-control mr-sm-2" id="sl_kategori" name="kategori" required="required">
            </select>
                </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
              <label for="terdata">Status Perkawinan</label> 
              <input type="text" class="form-control" id="st_perkawinan" name="st_perkawinan" placeholder="Status Perkawinan" required="required" autocomplete="">
              </div>
            </div>
          </div>
          <div hidden class="form-group">
            <label for="terdata">Instansi Pengurus</label> 
            <select disabled class="form-control mr-sm-2" id="sl_puskesmas" name="id_puskesmas" required="required">
            </select>
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label> 
            <textarea rows="4" type="text" placeholder="Alamat" class="form-control" id="alamat" name="alamat" required="required"></textarea>
               </div>
               <div class="form-group">
            <label for="terdata">Provinsi</label> 
            <select class="form-control mr-sm-2" id="sl_prov" name="sl_prov" required="required">
            </select>
          </div>
          <div class="form-group">
            <label for="terdata">Kabupaten / Kota</label> 
            <select class="form-control mr-sm-2" id="sl_kab" name="KDKAB" required="required">
            </select>
          </div>
          <div class="form-group">
            <label for="terdata">Kecamatan</label> 
            <select class="form-control mr-sm-2" id="sl_kec" name="KDKEC" required="required">
            </select>
          </div>
          <div class="form-group">
            <label for="terdata">Desa / Keluarahan</label> 
            <select class="form-control mr-sm-2" id="sl_kel" name="KDKEL" required="required">
            </select>
          </div>
          <input hidden type="text" class="form-control"  id="kode_wilayah" name="kode_wilayah" placeholder="kode_wilayah" required="required" autocomplete="current-password">
     
          <button class="btn btn-success my-1 mr-sm-2" type="submit" id="add_btn" data-loading-text="Loading..." onclick="this.form.target='add'"><strong>Tambah Data</strong></button>
          <button class="btn btn-success my-1 mr-sm-2" type="submit" id="save_edit_btn" data-loading-text="Loading..." onclick="this.form.target='edit'"><strong>Simpan Perubahan</strong></button>
          </form>             
        <!-- <form role="form" id="user_form" onsubmit="return false;" type="multipart" autocomplete="off">
          <input type="hidden" id="id_pasien" name="id_pasien">
          <div class="form-group">
            <label for="nama">Nama </label> 
            <input type="text" placeholder="Nama" class="form-control" id="nama" name="nama" required="required">
          </div>
          <div class="form-group">
            <label for="nik">NIK </label> 
            <input type="number" placeholder="NIK" class="form-control" id="nik" name="NIK" required="required">
          </div>
          <div class="form-group">
            <label for="terdata">Kabupaten</label> 
            <select class="form-control mr-sm-2" id="sl_kab" name="KDKAB" required="required">
            </select>
          </div>
          <div class="form-group">
            <label for="terdata">Kecamatan</label> 
            <select class="form-control mr-sm-2" id="sl_kec" name="KDKEC" required="required">
            </select>
          </div>
          <div class="form-group">
            <label for="terdata">Desa / Keluarahan</label> 
            <select class="form-control mr-sm-2" id="sl_kel" name="KDKEL" required="required">
            </select>
          </div>
          <div class="form-group">
            <label for="id_status">Status</label> 
            <select class="form-control mr-sm-2" id="id_status" name="status" required="required">
            </select>
          </div>
          <div class="form-group">
            <label for="email">Email</label> 
            <input type="text" placeholder="email" class="form-control" id="email" name="email" required="required">
          </div>
          <div class="form-group">
            <label for="nomorhp">Nomor HP </label> 
            <input type="number" placeholder="Nomor HP" class="form-control" id="nomorhp" name="nomorhp" required="required">
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label> 
            <textarea rows="4" type="text" placeholder="Alamat" class="form-control" id="alamat" name="alamat" required="required"></textarea>
               </div>
          <button class="btn btn-success my-1 mr-sm-2" type="submit" id="add_btn" data-loading-text="Loading..." onclick="this.form.target='add'"><strong>Tambah Data</strong></button>
          <button class="btn btn-success my-1 mr-sm-2" type="submit" id="save_edit_btn" data-loading-text="Loading..." onclick="this.form.target='edit'"><strong>Simpan Perubahan</strong></button>
        </form> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  var sessionData = JSON.parse(`<?=json_encode(DataStructure::slice($this->session->userdata(), ['id_role']))?>`);
  $('#data_pasien').addClass('active');
  var id_pasien = `<?=$contentData['id_pasien']?>`;
  var GlobalTemp = [];
console.log(sessionData)
  var swalSaveConfigure = {
    title: "Konfirmasi simpan",
    text: "Yakin akan menyimpan data ini?",
    type: "info",
    showCancelButton: true,
    confirmButtonColor: "#18a689",
    confirmButtonText: "Ya, Simpan!",
  };

  var swalPembayaranConfigure = {
    title: "Konfirmasi Pembayaran",
    text: "Yakin akan konfirmasi pembayaran ini?",
    type: "info",
    showCancelButton: true,
    confirmButtonColor: "#18a689",
    confirmButtonText: "Ya!",
  };


  console.log(id_pasien)
  var info = {
    'self': $('#info_container'),
    'nama': $('#info_container').find('#nama'),
    'nik': $('#info_container').find('#nik'),
    'nomorhp': $('#info_container').find('#nomorhp'),
    'email': $('#info_container').find('#email'),
    'alamat': $('#info_container').find('#alamat'),
    'tempat_cek': $('#info_container').find('#tempat_cek'),
    'jumlah_cek': $('#info_container').find('#jumlah_cek'),
    'status': $('#info_container').find('#status'),
    'active': $('#info_container').find('#active'),
    'nama_kab': $('#info_container').find('#nama_kab'),
    'nama_kec': $('#info_container').find('#nama_kec'),
    'nama_prov': $('#info_container').find('#nama_prov'),
    'nama_kel': $('#info_container').find('#nama_kel'),
    'jenis_kelamin': $('#info_container').find('#jenis_kelamin'),
    'tempat_lahir': $('#info_container').find('#tempat_lahir'),
    'tanggal_lahir': $('#info_container').find('#tanggal_lahir'),
    'usia': $('#info_container').find('#usia'),
    'edit_info_btn': $('#edit_info_btn'),
    'add_record_btn': $('#add_record_btn'),
    'info_nama_krt': $('#info_container').find('#info_nama_krt'),
    'info_pekerjaan': $('#info_container').find('#info_pekerjaan'),
    'info_kewarganegaraan': $('#info_container').find('#info_kewarganegaraan')
  }

  if(sessionData['id_role'] == 3 ){
    // info.edit_info_btn.hide();
    info.add_record_btn.hide();
  }

  

    $('#edit_bantuan').on('click', function(){
        informasiModal.self.modal('show');
        informasiModal.ID_edit.val(dataInfo['ID']);
        informasiModal.kd_jenis_bantuan.val(dataInfo['jenis_bantuan']);
    });
  var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [{ targets: [0, 3], className: 'text-center'}, ],
    deferRender: true,
    'ordering': false,
    'paging': false,
    'searching': false
  });

  var recordModal = {
    self: $('#record_modal'),
    form: $('#record_form'),
    NO: $('#record_modal').find('#NO'),
    id_pasien_rec: $('#record_modal').find('#id_pasien_rec'),
    id_record: $('#record_modal').find('#id_record'),
    tanggal_record: $('#record_modal').find('#tanggal_record'),
    before_status: $('#record_modal').find('#before_status'),
    no_antri: $('#record_modal').find('#no_antri'),
    rumah_sakit: $('#record_modal').find('#rumah_sakit'),
    deskripsi: $('#record_modal').find('#deskripsi'),
    info: $('#record_modal').find('#info'),
    'addBtn': $('#record_modal').find('#add_btn'),
    'saveEditBtn': $('#record_modal').find('#save_edit_btn'),
    jenis_sampel: $('#record_modal').find('#jenis_sampel'),
  }

  var informasiModal = {
    self: $('#informasi_modal'),
    form: $('#informasi_form'),
    ID_edit: $('#informasi_modal').find('#ID_edit'),
    kd_jenis_bantuan: $('#informasi_modal').find('#kd_jenis_bantuan'),
    info: $('#informasi_modal').find('#info'),
    save_btn: $('#informasi_modal').find('#save'),
  }

  var PasienModal = {
    'self': $('#pasien_modal'),
    'info': $('#pasien_modal').find('.info'),
    'form': $('#pasien_modal').find('#user_form'),
    'addBtn': $('#pasien_modal').find('#add_btn'),
    'saveEditBtn': $('#pasien_modal').find('#save_edit_btn'),
    'id_pasien': $('#pasien_modal').find('#id_pasien'),
    'id_user': $('#pasien_modal').find('#id_user'),
  
    'username': $('#pasien_modal').find('#username'),
    'password': $('#pasien_modal').find('#password'),
    'repassword': $('#pasien_modal').find('#repassword'),
    'NIK': $('#pasien_modal').find('#NIK'),
    'nama': $('#pasien_modal').find('#nama'),
    'tempat_lahir': $('#pasien_modal').find('#tempat_lahir'),
    'tanggal_lahir': $('#pasien_modal').find('#tanggal_lahir'),
    'pekerjaan': $('#pasien_modal').find('#pekerjaan'),
    'sl_kelamin': $('#pasien_modal').find('#sl_kelamin'),
    'sl_kewarganegaraan': $('#pasien_modal').find('#sl_kewarganegaraan'),
    'sl_kategori': $('#pasien_modal').find('#sl_kategori'),
    'st_perkawinan': $('#pasien_modal').find('#st_perkawinan'),
    'sl_hamil': $('#pasien_modal').find('#sl_hamil'),
    'nama_krt': $('#pasien_modal').find('#nama_krt'),
    'id_status': $('#pasien_modal').find('#id_status'),
    'sl_puskesmas': $('#pasien_modal').find('#sl_puskesmas'),
    'sl_kab': $('#pasien_modal').find('#sl_kab'),
    'sl_prov': $('#pasien_modal').find('#sl_prov'),
    'kode_wilayah': $('#pasien_modal').find('#kode_wilayah'),
 
    'sl_kec': $('#pasien_modal').find('#sl_kec'),
    'sl_kel': $('#pasien_modal').find('#sl_kel'),
    'nik': $('#pasien_modal').find('#nik'),
    'email': $('#pasien_modal').find('#email'),
    'nomorhp': $('#pasien_modal').find('#nomorhp'),
    'alamat': $('#pasien_modal').find('#alamat'),
  }

  var dataInfo = {};
  var dataJabatanTim = {};
  var dataUser = {};
  
  var swalDeleteConfigure = {
    title: "Konfirmasi hapus",
    text: "Yakin akan menghapus data ini?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya, Hapus!",
  };

  getInfo();
  function getInfo(){
    return $.ajax({
        url: `<?php echo site_url('DinkesController/getAllPasienProv/')?>`, 'type': 'GET',
       data : {id_pasien: id_pasien},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataInfo = json['data'][id_pasien];
        // console.log(dataInfo)
        renderInfo();
        getTim() 
      },
      error: function(e) {}
    });
  }

  function colorBantuan(realisasi, na = false){
  // var realisasi = parseFloat(realisasi);
  if(realisasi == '0')
     return `<span class="label label-danger"> Belum Ada Bantuan </span>`;
  else if (realisasi == '1')
    return `<span class="label label-info"> Jenis Bantuan 1 (PKH dan BPNT) </span>`;
  else if (realisasi == '2')
    return `<span class="label label-info"> Jenis Bantuan 2 (BPNT) </span>`;
  else if (realisasi == '3')
    return `<span class="label label-info"> Jenis Bantuan 3 (Non PKH - Non BPNT) </span>`;
  return `<span class="label label-success">${realisasi}%</span>`;
}

function convStatus(status){
  // var realisasi = parseFloat(realisasi);
  if(status == '1')
     return `<span class="label label-info"> Orang Tanpa Gejala </span>`;
  else if (status == '2')
    return `<span class="label label-warning"> Orang Dalam Pemantauan </span>`;
  else if (status == '3')
    return `<span class="label label-warning"> Pasien Dalam Pemantauan </span>`;
  else if (status == '4')
    return `<span class="label label-danger"> POSITIF COVID-19 </span>`;
  return `<span class="label label-success"> NEGATIF COVID-19 </span>`;  
}

function getAge(date) {
  var d = Date.parse(date);
    e = Date.parse(Date());
    f = Math.floor((e-d)/86400000/365);
    g = (e-d)/1000/86400%365;
    g = Math.floor(g/30)
    hasil = " "+f+ " Tahun "+g+" Bulan";
    return hasil;
}

  function renderInfo(){
    // info.jenis_bantuan.html(`${colorBantuan(dataInfo['jenis_bantuan'])}`);
    info.nama.html(`${dataInfo['nama']}`);
    info.nik.html(`${dataInfo['NIK']}`);
    info.alamat.html(`${dataInfo['alamat'] }`);
    info.tempat_cek.html(`${dataInfo['nama_puskesmas'] ? dataInfo['nama_puskesmas'] : 'Belum ada'}`);
  
    info.jumlah_cek.html(`${dataInfo['jumlah_cek']}`);
    info.status.html(`${convStatus(dataInfo['status'])}`);
    info.active.html(`${dataInfo['active'] == 0 ? 'Belum Aktif' : 'Aktif'}`);
    info.nama_kab.html(`${dataInfo['nama_kab']}`);
    info.nama_kec.html(`${dataInfo['nama_kec']}`);
    info.nama_kel.html(`${dataInfo['nama_kel']}`);
    info.nama_prov.html(`${dataInfo['nama_prov']}`);
    info.info_nama_krt.html(`${dataInfo['nama_krt']}`);
    info.info_pekerjaan.html(`${dataInfo['pekerjaan']}`);
    info.info_kewarganegaraan.html(`${dataInfo['kewarganegaraan']}`);
    info.nomorhp.html(`${dataInfo['nomorhp']}`);
    info.email.html(`${dataInfo['email']}`);
    recordModal.id_pasien_rec.val(dataInfo['id_pasien']);
    info.jenis_kelamin.html(`${dataInfo['jenis_kelamin'] == 'L' ? 'Laki-Laki' : 'Perempuan'}` + `${dataInfo['pasca_hamil'] == 'Ya' ? ' (Hamil / Pasca melahirkan)' : ''}`);
    info.tempat_lahir.html(`${dataInfo['tempat_lahir']}`);
    info.tanggal_lahir.html(`${dataInfo['tanggal_lahir']}`);
   
    info.usia.html(getAge(dataInfo['tanggal_lahir']));

    // info.Nama_KRT.html(`${dataInfo['NO_KTP_NIK_PEKERJA']}`);
    // info.kontak.html(`${dataInfo['NO_HP']+'  <br>'+dataInfo['email']}`);
    // info.Alamat.html(`<a href="<?=site_url()?>OPPerencanaanController/detail?id_opd${dataInfo['id_opd']}">${dataInfo['Alamat']}</a>`);
  }

  function renderRecord(data){
    if(data == null || typeof data != "object"){
      console.log("User::UNKNOWN DATA");
      return;
    }
    var i = 0;
    
    var renderData = [];
    Object.values(data).forEach((record) => {
      var detailButton = `<a class="btn btn-success" href="<?=site_url("RSController/DetailRecord/")?>?id_record=${record['id_record']}" class="dropdown-item"><i class='fa fa-pencil'></i>Form Rekam Medis</a>`;
      var pembayaranButton = `<button class="pembayaran btn btn-warning" data-id='${record['id_record']}'><i class='fa fa-note'></i> Konfirmasi Pembayaran</button>
      <button class="delete btn btn-danger" data-id='${record['id_record']}'><i class='fa fa-trash'></i></button>
      
      `;
      if(sessionData['id_role'] == 3 ){
        pembayaranButton = `<button class="btn btn-warning"><i class='fa fa-note'></i>Belum Konfirmasi Pembayaran</button>`;
      
      }
      var deleteButton = `
        <a class="delete dropdown-item" data-id='${record['id_record']}'><i class='fa fa-trash'></i> Hapus Record</a>
      `;

      var editButton = `
        <a class="edit dropdown-item" data-id='${record['id_record']}'><i class='fa fa-pencil'></i> Edit Record</a>
      `;
      var button = `
        <div class="btn-group" opd="group">
          <button id="action" type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='fa fa-bars'></i></button>
          <div class="dropdown-menu" aria-labelledby="action">
            ${detailButton}
            ${editButton}
            ${deleteButton}
          </div>
        </div>
      `;
    //   var no_hp = record['no_hp_tim'] ? record['no_hp_tim'] : 'Tidak Ada';
    //   var photo = record['photo_tim'] ? `<img src="<?=base_url('uploads/photo/')?>${record['photo_tim']}" class="img-sm">` : 'Tidak Ada';
      renderData.push([record['no_antri'],record['no_rekam'], record['tanggal_record'].substring(0,16),record['status_bayar'] == '0' ? pembayaranButton : detailButton  ]);
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
  }

  recordModal.form.submit(function(event){
    event.preventDefault();
    switch(recordModal.form[0].target){
      case 'add':
        addRecord();
        break;
      case 'edit':
        editRecord();
        break;
    }
  });

  PasienModal.form.submit(function(event){
    swal(swalSaveConfigure).then((result) => {
      if(!result.value){ return; }
      buttonLoading(PasienModal.saveEditBtn);
      $.ajax({
        url: `<?=site_url('DinkesController/editPasien_v2')?>`, 'type': 'POST',
        data: PasienModal.form.serialize(),
        success: function (data){
          buttonIdle(PasienModal.saveEditBtn);
          var json = JSON.parse(data);
          if(json['error']){
            swal("Simpan Gagal", json['message'], "error");
            return;
          }
          var pasien = json['data']
          dataInfo = pasien;
          swal("Simpan Berhasil", "", "success");
          renderInfo();
          PasienModal.self.modal('hide');
        },
        error: function(e) {}
      });
  });
});

      function addRecord(){
      swal('Tambah Record').then((result) => {
        if(!result.value){ return; }
        buttonLoading(recordModal.addBtn);
        $.ajax({
          url: "<?=site_url('DinkesController/addRecord_berbayar')?>", 'type': 'POST',
          data: recordModal.form.serialize(),
          success: function (data){
            buttonIdle(recordModal.addBtn);
            var json = JSON.parse(data);
            if(json['error']){
              swal("Simpan Gagal", json['message'], "error");
              return;
            }
            var record = json['data']
            // console.log(record)
            dataRecord[record['id_record']] = record;
            swal("Simpan Berhasil", "", "success");
            renderRecord(dataRecord);
            getInfo();
            recordModal.self.modal('hide');
          },
          error: function(e) {}
        });
      });
    }

    function editRecord(){
      swal('Edit Record').then((result) => {
        if(!result.value){ return; }
        buttonLoading(recordModal.saveEditBtn);
        $.ajax({
          url: "<?=site_url('DinkesController/editRecord')?>", 'type': 'POST',
          data: recordModal.form.serialize(),
          success: function (data){
            buttonIdle(recordModal.saveEditBtn);
            var json = JSON.parse(data);
            if(json['error']){
              swal("Simpan Gagal", json['message'], "error");
              return;
            }
            var record = json['data']
            // console.log(record)
            dataRecord[record['id_record']] = record;
            swal("Simpan Berhasil", "", "success");
            renderRecord(dataRecord);
            getInfo();
            recordModal.self.modal('hide');
          },
          error: function(e) {}
        });
      });
    }
  

  FDataTable.on('click','.delete', function(){
    event.preventDefault();
    var id = $(this).data('id');
    swal(swalDeleteConfigure).then((result) => {
      if(!result.value){ return; }
      $.ajax({
        url: "<?=site_url('DinkesController/deleteRecord')?>", 'type': 'POST',
        data: {'id_record': id},
        success: function (data){
          var json = JSON.parse(data);
          if(json['error']){
            swal("Delete Gagal", json['message'], "error");
            return;
          }
          delete dataRecord[id];
          swal("Delete Berhasil", "", "success");
          renderRecord(dataRecord);
        },
        error: function(e) {}
      });
    });
  });

  FDataTable.on('click','.edit', function(){
    recordModal.form.trigger('reset');
    recordModal.self.modal('show');
    recordModal.id_pasien_rec.val(dataInfo['id_pasien']);
    recordModal.saveEditBtn.show();
    recordModal.addBtn.hide();
    var id = $(this).data('id');
    var current = dataRecord[id];
    console.log(current);
    recordModal.id_record.val(current['id_record']);
    recordModal.deskripsi.val(current['deskripsi']);
    recordModal.before_status.val(current['before_status']);
    recordModal.no_antri.val(current['no_antri']);
    recordModal.rumah_sakit.val(current['rumah_sakit']);
    var datecur = current['tanggal_record']
    var res = datecur.substr(0,10);
    var res2 = datecur.substr(11,5);
    console.log(res+'T'+res2)
    recordModal.tanggal_record.val(res+'T'+res2);

  });

  FDataTable.on('click','.pembayaran', function(){
   console.log('act pembayaran')
   event.preventDefault();
    var id = $(this).data('id');
    swal(swalPembayaranConfigure).then((result) => {
      if(!result.value){ return; }
      $.ajax({
        url: "<?=site_url('DinkesController/editRecord')?>", 'type': 'POST',
        data: {'id_record': id, status_bayar : '1'},
        success: function (data){
          var json = JSON.parse(data);
          if(json['error']){
            swal("Konfirmasi Pembayaran Gagal", json['message'], "error");
            return;
          }
          var record = json['data']
          dataRecord[record['id_record']] = record;
          swal("Konfirmasi Pembayaran Berhasil", "", "success");
          renderRecord(dataRecord);
        },
        error: function(e) {}
      });
    });
   
  });

  // getJenisBantuan()
  function getJenisBantuan(){
    return $.ajax({
        url: `<?php echo site_url('SharedController/getJenisBantuan/')?>`, 
        data : {},
        type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        data = json['data'];
        renderJenisBantuan(data)
      },
      error: function(e) {}, 
    });
  }

  function renderJenisBantuan(data){
    informasiModal.kd_jenis_bantuan.empty();
    informasiModal.kd_jenis_bantuan.append($('<option>', { value: "0", text: "Pilih Jenis Bantuan"}));
    Object.values(data).forEach((d) => {
        informasiModal.kd_jenis_bantuan.append($('<option>', {
        value: d['id_jenis_bantuan'],
        text:  d['id_jenis_bantuan'] + " :: " + d['nama_jenis_bantuan'] ,
      }));
    });
  }

  getAllStatus();  
  function getAllStatus(){
    return $.ajax({
      url: `<?php echo site_url('SharedController/getAllStatusOption/')?>`, 'type': 'GET',
      data: {},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataJenis = json['data'];
        renderStatusSelection(dataJenis);
      },
      error: function(e) {}
    });
  }

  function renderStatusSelection(data){
    PasienModal.id_status.empty();
    PasienModal.id_status.append($('<option>', { value: "", text: "-- Pilih Jenis --"}));
    Object.values(data).forEach((d) => {
      PasienModal.id_status.append($('<option>', {
        value: d['id_status'],
        text: d['id_status'] + ' :: ' + d['nama_status'],
      }));
    });

    recordModal.before_status.empty();
    recordModal.before_status.append($('<option>', { value: "", text: "-- Pilih Jenis --"}));
    Object.values(data).forEach((d) => {
      recordModal.before_status.append($('<option>', {
        value: d['id_status'],
        text: d['id_status'] + ' :: ' + d['nama_status'],
      }));
    });
  }

  function getTim(){
    return $.ajax({
        url: `<?php echo site_url('DinkesController/getAllRecord/')?>`, 
        data : {id_pasien: id_pasien},
        type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataRecord = json['data'];
        if(dataRecord != 'NULL'){
            console.log('run')
        
        // info.st_terdata.html(`Terdata`);
        renderRecord(dataRecord);
        }else{
        //   info.st_terdata.html(`Tidak Terdata`);
        }
      },
      error: function(e) {}, 
    });
  }

  function renderRecordSelection(data){
    if(data == null || typeof data != "object") return;
    recordModal.list_tim.typeahead({ 
      source: Object.values(data).map((e) => {
        return `${e['nama']} (${e['nip']}) -- ${e['id_user']}`;
      }),
      afterSelect: function(data){
        var id = data.split(" -- ")[1];
        var user = dataUser[id];
        recordModal.id_user.val(user['id_user']);
        recordModal.photo_tim.attr('src', user['photo']);
      }
    });
    recordModal.list_tim.on('blur', function(e){
      if(empty(recordModal.list_tim.val())) {
        recordModal.id_user.val('');
        recordModal.photo_tim.attr('src', null);
      }
    });
  }

  info.add_record_btn.on('click', function(){
    recordModal.form.trigger('reset');
    recordModal.self.modal('show');
    recordModal.id_pasien_rec.val(dataInfo['id_pasien']);
    recordModal.saveEditBtn.hide();
    recordModal.addBtn.show();
    recordModal.before_status.val(dataInfo['status']);
    recordModal.rumah_sakit.val(dataInfo['nama_puskesmas']);
    // recordModal.NO.val(dataInfo['NO']);
  });
  renderJenisTahap();
  function renderJenisTahap(data){
    
    recordModal.jenis_sampel.empty();
    recordModal.jenis_sampel.append($('<option>', { value: "", text: "Pilih Jenis Uji"}));
    recordModal.jenis_sampel.append($('<option>', { value: "SWAP", text: "SWAP"}));
    recordModal.jenis_sampel.append($('<option>', { value: "RAPID", text: "RAPID"}));
  }
  info.edit_info_btn.on('click', function(){
    // informasiModal.self.modal('show');
    // informasiModal.NO.val(dataInfo['NO']);
    // informasiModal.lokasi.val(dataInfo['lokasi']);

    event.preventDefault();
    PasienModal.form.trigger('reset');
    PasienModal.self.modal('show');
    PasienModal.addBtn.hide();
    PasienModal.saveEditBtn.show();
    PasienModal.username.prop('readonly',true);
    PasienModal.password.prop('disabled',false);
    PasienModal.password.prop('required',false);
    PasienModal.repassword.prop('disabled',true);
    PasienModal.saveEditBtn.show();

    PasienModal.id_pasien.val(dataInfo['id_pasien']);
    PasienModal.nama.val(dataInfo['nama']);
    PasienModal.id_status.val(dataInfo['status']);
    PasienModal.id_user.val(dataInfo['id_user']);
    // reset_pasienmodal();
    // PasienModal.sl_kec.val(pasien['KDKEC']).trigger('change');
    PasienModal.nama_krt.val(dataInfo['nama_krt']);
    PasienModal.NIK.val(dataInfo['NIK']);
    PasienModal.username.val(dataInfo['username']);
    PasienModal.email.val(dataInfo['email']);
    PasienModal.nomorhp.val(dataInfo['nomorhp']);
    PasienModal.alamat.val(dataInfo['alamat']);
    PasienModal.sl_kelamin.val(dataInfo['jenis_kelamin']);
    PasienModal.tempat_lahir.val(dataInfo['tempat_lahir']);
    PasienModal.tanggal_lahir.val(dataInfo['tanggal_lahir']);
    PasienModal.pekerjaan.val(dataInfo['pekerjaan']);
    PasienModal.sl_kewarganegaraan.val(dataInfo['kewarganegaraan']);
    PasienModal.sl_kategori.val(dataInfo['kategori']);
    PasienModal.st_perkawinan.val(dataInfo['st_perkawinan']);
    PasienModal.sl_puskesmas.val(dataInfo['id_puskesmas']);
    // PasienModal.sl_prov.val(dataInfo['sl_prov']);
    GlobalTemp = dataInfo['kode_wilayah'].split(".");
    PasienModal.sl_prov.val(GlobalTemp[0]).trigger('change');
    // PasienModal.sl_kab.val(dataInfo['KDKAB']).trigger('change');
    PasienModal.kode_wilayah.val(dataInfo['kode_wilayah']);
    if(dataInfo['jenis_kelamin'] == 'P'){
        PasienModal.sl_hamil.prop('disabled',false)
        PasienModal.sl_hamil.val(dataInfo['pasca_hamil']); 
      }else{
        PasienModal.sl_hamil.val(''); 
        PasienModal.sl_hamil.prop('disabled',true)     
      }


  });
  PasienModal.sl_kelamin.on('change', (e) => {
        if(PasienModal.sl_kelamin.val() == 'P'){
          PasienModal.sl_hamil.prop('disabled',false)
      }else{
           PasienModal.sl_hamil.val('')  
          PasienModal.sl_hamil.prop('disabled',true)     
      }
    });
  PasienModal.sl_prov.on('change', (e) => {
    if(PasienModal.sl_prov.val() != ''){
      PasienModal.sl_kab.empty();
    PasienModal.sl_kec.empty();
    PasienModal.sl_kel.empty();
    PasienModal.sl_kab.val(null);
    PasienModal.sl_kec.val(null);
    PasienModal.sl_kel.val(null);
      getAllKabOption()
    }else{
      PasienModal.sl_kab.empty();
    PasienModal.sl_kec.empty();
    PasienModal.sl_kel.empty();
    PasienModal.sl_kab.val(null);
    PasienModal.sl_kec.val(null);
    PasienModal.sl_kel.val(null);
    }
  });

  PasienModal.sl_kab.on('change', (e) => {
    if(PasienModal.sl_kab.val() != ''){
    PasienModal.sl_kec.empty();
    PasienModal.sl_kel.empty();
    PasienModal.sl_kec.val(null);
    PasienModal.sl_kel.val(null);
      getAllKecOption()
    }else{
    PasienModal.sl_kec.empty();
    PasienModal.sl_kel.empty();
    PasienModal.sl_kec.val(null);
    PasienModal.sl_kel.val(null);
    }
  });
  PasienModal.sl_kec.on('change', (e) => {
    if(PasienModal.sl_kec.val() != ''){
    PasienModal.sl_kel.empty();
    PasienModal.sl_kel.val(null);
    getAllKelOption()
    }else{
    PasienModal.sl_kel.empty();
    PasienModal.sl_kel.val(null);
    }
  });
  PasienModal.sl_kel.on('change', (e) => {
    
    PasienModal.kode_wilayah.val(PasienModal.sl_kel.val());
   
  });
  getAllProv();
  function getAllProv(){
    return $.ajax({
      url: `<?php echo site_url('SharedController/getAllProv/')?>`, 'type': 'POST',
      data: {},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataRole = json['data'];
        // renderKabSelectionFilter(dataRole);
        renderProvOptionFilter(dataRole);
      },
      error: function(e) {}
    });
  }

  function getAllKabOption(){
    kd_prov = PasienModal.sl_prov.val();
    return $.ajax({
      url: `<?php echo site_url('SharedController/getAllKabProv/')?>`, 'type': 'POST',
      data: {kd_prov : kd_prov},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataRole = json['data'];
        // renderKabSelectionFilter(dataRole);
        renderKabOptionFilter(dataRole);
      },
      error: function(e) {}
    });
  }

  
  getAllPuskesmas();
  function getAllPuskesmas(){
    return $.ajax({
      url: `<?php echo site_url('SharedController/getAllPuskesmas/')?>`, 'type': 'POST',
      data: {},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataRole = json['data'];
        // renderKabSelectionFilter(dataRole);
          renderPuskesmas(dataRole);
      },
      error: function(e) {}
    });
  }

  function getAllKecOption(){
    kd_kab = PasienModal.sl_kab.val();
     $.ajax({
      url: `<?php echo site_url('SharedController/getAllKecProv/')?>`, 'type': 'POST',
      data: {kd_kab : kd_kab},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataRole = json['data'];
        renderKecOptionFilter(dataRole);
        return;
      },
      error: function(e) {}
    });
  }

  function getAllKelOption(){
      kd_kec = PasienModal.sl_kec.val();
      kd_kab = PasienModal.sl_kab.val();
      return $.ajax({
        url: `<?php echo site_url('SharedController/getAllKelProv/')?>`, 'type': 'POST',
        data: {kd_kec : kd_kec, kd_kab : kd_kab},
        success: function (data){
          var json = JSON.parse(data);
          if(json['error']){
            return;
          }
          dataRole = json['data'];
          renderKelOptionFilter(dataRole);
        },
        error: function(e) {}
      });
    }

    function renderProvOptionFilter(data){
      PasienModal.sl_kelamin.append($('<option>', { value: "", text: "-- Pilih Jenis Kelamin"}));
      PasienModal.sl_kelamin.append($('<option>', { value: "L", text: "Laki-laki"}));
      PasienModal.sl_kelamin.append($('<option>', { value: "P", text: "Perempuan"}));

      PasienModal.sl_kategori.append($('<option>', { value: "", text: "-- Pilih Kategori --"}));
      PasienModal.sl_kategori.append($('<option>', { value: "1", text: "Pasien Mandiri"}));
      PasienModal.sl_kategori.append($('<option>', { value: "2", text: "Pasien Asuransi / Perusahaan"}));
      PasienModal.sl_kategori.append($('<option>', { value: "3", text: "Pasien SATGAS"}));

      PasienModal.sl_kewarganegaraan.append($('<option>', { value: "", text: "-- Pilih Kewarganegaraan --"}));
      PasienModal.sl_kewarganegaraan.append($('<option>', { value: "WNI", text: "Warga Negara Indonesia"}));
      PasienModal.sl_kewarganegaraan.append($('<option>', { value: "WNA", text: "Warga Negara Asing"}));

      PasienModal.sl_hamil.append($('<option>', { value: "", text: ""}));
      PasienModal.sl_hamil.append($('<option>', { value: "Ya", text: "Ya"}));
      PasienModal.sl_hamil.append($('<option>', { value: "Tidak", text: "Tidak"}));


      PasienModal.sl_prov.empty();
      PasienModal.sl_prov.append($('<option>', { value: "", text: "-- Pilih Provinsi --"}));

      Object.values(data).forEach((d) => {
        PasienModal.sl_prov.append($('<option>', {
          value: d['kode'],
          text:  d['nama'],
          // text: d['id_kd_kab'] + ' :: ' + d['nama_kab'],

        }));
      });


      if(GlobalTemp != undefined){
        PasienModal.sl_prov.val(GlobalTemp['KDKAB']).trigger('change')
      }
  }

  function renderKabOptionFilter(data){
      
      PasienModal.sl_kab.empty();
      PasienModal.sl_kab.append($('<option>', { value: "", text: "-- Pilih Kabupaten --"}));

      Object.values(data).forEach((d) => {
        PasienModal.sl_kab.append($('<option>', {
          value: d['kode'],
          text:  d['nama'],
          // text: d['id_kd_kab'] + ' :: ' + d['nama_kab'],

        }));
      });


      if(GlobalTemp != undefined){
        PasienModal.sl_kab.val(GlobalTemp[0]+'.'+GlobalTemp[1]).trigger('change')
      }
  }

function renderPuskesmas(data){
    PasienModal.sl_puskesmas.empty();
    PasienModal.sl_puskesmas.append($('<option>', { value: "", text: "-- Pilih Instansi --"}));

    Object.values(data).forEach((d) => {
      PasienModal.sl_puskesmas.append($('<option>', {
        value: d['id_puskesmas'],
        text:  d['nama_puskesmas'],
        // text: d['id_kd_kab'] + ' :: ' + d['nama_kab'],
    
      }));
    });
  };
function renderKecOptionFilter(data){
PasienModal.sl_kec.empty();
PasienModal.sl_kec.append($('<option>', { value: "", text: "-- Pilih Kecamatan --"}));
Object.values(data).forEach((d) => {
  PasienModal.sl_kec.append($('<option>', {
    value: d['kode'],
    text:  d['nama'],
    // text: d['id_kd_kab'] + ' :: ' + d['nama_kab'],
  }));
});

if(GlobalTemp != undefined){
  PasienModal.sl_kec.val(GlobalTemp[0]+'.'+GlobalTemp[1]+'.'+GlobalTemp[2]).trigger('change')
}
}

function renderKelOptionFilter(data){
PasienModal.sl_kel.empty();
PasienModal.sl_kel.append($('<option>', { value: "", text: "-- Pilih Kelurahan --"}));
Object.values(data).forEach((d) => {
  PasienModal.sl_kel.append($('<option>', {
    value: d['kode'],
    text:  d['nama'],
  }));
});
if(GlobalTemp != undefined){
  PasienModal.sl_kel.val(GlobalTemp[0]+'.'+GlobalTemp[1]+'.'+GlobalTemp[2]+'.'+GlobalTemp[3])
}
}

  informasiModal.form.on('submit', (ev) => {
    ev.preventDefault();
    buttonLoading(informasiModal.save_btn);
    $.ajax({
      url: "<?=site_url('DTKSController/editDTKSRT/')?>",
      type: "POST",
      data: informasiModal.form.serialize(),
      success: (data) => {
        buttonIdle(informasiModal.save_btn);
        json = JSON.parse(data);
        if(json['error']){
          swal("Tambah Bantuan Gagal", json['message'], "error");
          return;
        } 
        dataInfo = json['data']['0'];
        renderInfo();
        getTim();
        swal("Berhasil Tambah Bantuan", 'Input Informasi Berhasil', "success");
        informasiModal.self.modal('hide');
      },
      error: () => {
        buttonIdle(informasiModal.save_btn);
      },
    });
  });
});
</script>