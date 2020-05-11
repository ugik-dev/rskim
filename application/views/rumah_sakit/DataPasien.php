<div class="wrapper wrapper-content animated fadeInRight">
<div hidden class="ibox ssection-container">
    <div class="ibox-content">
      <form class="form-inline" id="toolbar_search" onsubmit="return false;">
        <input type="hidden" id="is_not_self2" name="is_not_self2" value="1">
        <input type="text" placeholder="NIK" class="form-control my-1 mr-sm-2" id="by_nik" name="by_nik" style="max-width:300px">
        <input type="text" placeholder="No KK" class="form-control my-1 mr-sm-2" id="by_nokk" name="by_nokk" style="max-width:300px">      
        <!-- <select class="form-control mr-sm-2" name="kd_perusahaan" id="kd_perusahaan" ></select> -->
        <button type="button" class="btn btn-success my-1 mr-sm-2" id="src_btn" ><i class="fal fa-search"></i> Cari</button>
      </form>
    </div>
  </div>

  <div class="ibox ssection-container">
    <div class="ibox-content">
      <form class="form-inline" id="toolbar_form" onsubmit="return false;">
        <select class="form-control mr-sm-2" name="kd_kab" id="kd_kab"></select>
        <select class="form-control mr-sm-2" name="kd_kec" id="kd_kec"></select>
        <select class="form-control mr-sm-2" name="kd_kel" id="kd_kel"></select>
        <!-- <select class="form-control mr-sm-2" name="sta_pkh" id="sta_pkh"></select>
        <select class="form-control mr-sm-2" name="sta_rastra" id="sta_rastra"></select> -->
   
        <button type="submit" class="btn btn-success my-1 mr-sm-2" id="show_btn"  data-loading-text="Loading..." onclick="this.form.target='show'"><i class="fal fa-eye"></i> Tampilkan</button>
        <button type="submit" class="btn btn-primary my-1 mr-sm-2" id="add_btn"  data-loading-text="Loading..." onclick="this.form.target='add'"><i class="fal fa-plus"></i> Tambah</button>
        <a hidden type="" class="btn btn-light my-1 mr-sm-2" id="export_btn"  data-loading-text="Loading..."><i class="fal fa-download"></i> Export PDF</a>
   
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <div class="table-responsive">
            <table id="FDataTable" class="table table-bordered table-hover" style="padding:0px">
              <thead>
                <tr>
      
                  <th style="width: 15%; text-align:center!important">Nama</th>
                  <th style="width: 12%; text-align:center!important">NIK</th>
                  <th style="width: 12%; text-align:center!important">Kab/Kecamatan</th>
                  
                  
                  <!-- <th style="width: 10%; text-align:center!important">Status</th> -->
                  <th style="width: 7%; text-align:center!important">Action</th>
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
            <select class="form-control mr-sm-2" id="sl_puskesmas" name="id_puskesmas" required="required">
            </select>
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label> 
            <textarea rows="4" type="text" placeholder="Alamat" class="form-control" id="alamat" name="alamat" required="required"></textarea>
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
 
  $('#pasien').addClass('active');
 
  var GlobalTemp = [];
  var toolbar = {
    'form': $('#toolbar_form'),
    'showBtn': $('#show_btn'),
    'addBtn': $('#show_btn'),
    'kd_kab': $('#toolbar_form').find('#kd_kab'),
    'kd_kec': $('#toolbar_form').find('#kd_kec'),
    'kd_kel': $('#toolbar_form').find('#kd_kel'),
    'sta_pkh': $('#toolbar_form').find('#sta_pkh'),
    'sta_rastra': $('#toolbar_form').find('#sta_rastra'),

  }

 

  var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [],
    deferRender: true,
    "order": [[ 0, "desc" ]]
  });


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
 
    'sl_kec': $('#pasien_modal').find('#sl_kec'),
    'sl_kel': $('#pasien_modal').find('#sl_kel'),
    'nik': $('#pasien_modal').find('#nik'),
    'email': $('#pasien_modal').find('#email'),
    'nomorhp': $('#pasien_modal').find('#nomorhp'),
    'alamat': $('#pasien_modal').find('#alamat'),
  }

  var swalSaveConfigure = {
    title: "Konfirmasi simpan",
    text: "Yakin akan menyimpan data ini?",
    type: "info",
    showCancelButton: true,
    confirmButtonColor: "#18a689",
    confirmButtonText: "Ya, Simpan!",
  };

  var swalDeleteConfigure = {
    title: "Konfirmasi hapus",
    text: "Yakin akan menghapus data ini?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya, Hapus!",
  };

  var dataPasien = {};
  var dataJenis = {};

  toolbar.form.submit(function(event){
    event.preventDefault();
    switch(toolbar.form[0].target){
      case 'show':
        getPasien();
        break;
      case 'add':
        reset_pasienmodal();
        GlobalTemp = undefined;
        showPasienModal();
        PasienModal.sl_puskesmas.val('2');
        PasienModal.username.prop('readonly',false);
        PasienModal.password.prop('disabled',false);
        PasienModal.repassword.prop('disabled',false);
        PasienModal.password.prop('required',true);
        
        break;
    }
  });
  getAllKab();
  function getAllKab(){
    return $.ajax({
      url: `<?php echo site_url('SharedController/getAllKab/')?>`, 'type': 'POST',
      data: {},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataRole = json['data'];
        renderKabSelectionFilter(dataRole);
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

  function getAllKec(){
    return $.ajax({
      url: `<?php echo site_url('SharedController/getAllKec/')?>`, 'type': 'POST',
      data: toolbar.form.serialize(),
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataRole = json['data'];
        renderKecSelectionFilter(dataRole);
      },
      error: function(e) {}
    });
  }

  function getAllKel(){
    return $.ajax({
      url: `<?php echo site_url('SharedController/getAllKel/')?>`, 'type': 'POST',
      data: toolbar.form.serialize(),
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataRole = json['data'];
        renderKelSelectionFilter(dataRole);
      },
      error: function(e) {}
    });
  }

  function getAllKecOption(){
    kd_kab = PasienModal.sl_kab.val();
     $.ajax({
      url: `<?php echo site_url('SharedController/getAllKec/')?>`, 'type': 'POST',
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
      url: `<?php echo site_url('SharedController/getAllKel/')?>`, 'type': 'POST',
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
  function reset_pasienmodal(){
    PasienModal.sl_kab.val(null);
    PasienModal.sl_kec.empty();
    PasienModal.sl_kel.empty();
  }
  function reset_toolbar(){
    toolbar.kd_kab.val(null);
    toolbar.kd_kec.val(null);
    toolbar.kd_kel.val(null);
    toolbar.kd_kec.empty();
    toolbar.kd_kel.empty();
  }
  PasienModal.sl_kelamin.on('change', (e) => {
        if(PasienModal.sl_kelamin.val() == 'P'){
          PasienModal.sl_hamil.prop('disabled',false)
      }else{
           PasienModal.sl_hamil.val('')  
          PasienModal.sl_hamil.prop('disabled',true)     
      }
    });
  toolbar.kd_kab.on('change', (e) => {
    if(toolbar.kd_kab.val() != ''){
      getAllKec()
      toolbar.kd_kel.empty();
    }else{
      reset_toolbar()
    }
 
  });
  toolbar.kd_kec.on('change', (e) => {
    if(toolbar.kd_kec.val() != ''){
      getAllKel()
    }else{
      toolbar.kd_kel.empty();
    }
  });
  toolbar.kd_kel.on('change', (e) => {
    // $('#total_data_kel').html('-');
    getPasien();
  });
  toolbar.sta_pkh.on('change', (e) => {
    reset_toolbar()
    getPasien()
  });
  toolbar.sta_rastra.on('change', (e) => {
    reset_toolbar()
    getPasien()
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

  // renderStaSelectionFilter();
  function renderStaSelectionFilter(data){
    toolbar.sta_pkh.empty();
    toolbar.sta_pkh.append($('<option>', { value: "", text: "Semua PKH"}));
    toolbar.sta_pkh.append($('<option>', { value: "1", text: "Ada PKH"}));
    toolbar.sta_pkh.append($('<option>', { value: "2", text: "Non PKH"}));
    toolbar.sta_rastra.empty();
    toolbar.sta_rastra.append($('<option>', { value: "", text: "Semua BPNT"}));
    toolbar.sta_rastra.append($('<option>', { value: "3", text: "Ada BPNT"}));
    toolbar.sta_rastra.append($('<option>', { value: "4", text: "Non BPNT"}));
   
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

  function renderKabSelectionFilter(data){
    toolbar.kd_kab.empty();
    toolbar.kd_kab.append($('<option>', { value: "", text: "Semua Kabupaten"}));

    Object.values(data).forEach((d) => {
      toolbar.kd_kab.append($('<option>', {
        value: d['id_kd_kab'],
        text:  d['nama_kab'],
        // text: d['id_kd_kab'] + ' :: ' + d['nama_kab'],
    
      }));
    });  
  }

  function renderKecSelectionFilter(data){
    toolbar.kd_kec.empty();
    toolbar.kd_kec.append($('<option>', { value: "", text: "Semua Kecamatan"}));
    Object.values(data).forEach((d) => {
      toolbar.kd_kec.append($('<option>', {
        value: d['KodeKec'],
        text:  d['Kecamatan'],
        // text: d['id_kd_kab'] + ' :: ' + d['nama_kab'],
      }));
    });
  }

  function renderKelSelectionFilter(data){
    toolbar.kd_kel.empty();
    toolbar.kd_kel.append($('<option>', { value: "", text: "Semua Kelurahan"}));
    Object.values(data).forEach((d) => {
      toolbar.kd_kel.append($('<option>', {
        value: d['KodeKel'],
        text:  d['Kelurahan'],
      }));
    });
  }

  function renderKabOptionFilter(data){

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


    PasienModal.sl_kab.empty();
    PasienModal.sl_kab.append($('<option>', { value: "", text: "-- Pilih Kabupaten --"}));

    Object.values(data).forEach((d) => {
      PasienModal.sl_kab.append($('<option>', {
        value: d['id_kd_kab'],
        text:  d['nama_kab'],
        // text: d['id_kd_kab'] + ' :: ' + d['nama_kab'],
    
      }));
    });
    if(GlobalTemp != undefined){
      PasienModal.sl_kab.val(GlobalTemp['KDKAB']).trigger('change')
    }
  }

  function renderKecOptionFilter(data){
    PasienModal.sl_kec.empty();
    PasienModal.sl_kec.append($('<option>', { value: "", text: "-- Pilih Kecamatan --"}));
    Object.values(data).forEach((d) => {
      PasienModal.sl_kec.append($('<option>', {
        value: d['KodeKec'],
        text:  d['Kecamatan'],
        // text: d['id_kd_kab'] + ' :: ' + d['nama_kab'],
      }));
    });

    if(GlobalTemp != undefined){
      PasienModal.sl_kec.val(GlobalTemp['KDKEC']).trigger('change')
    }
  }

  function renderKelOptionFilter(data){
    PasienModal.sl_kel.empty();
    PasienModal.sl_kel.append($('<option>', { value: "", text: "-- Pilih Kelurahan --"}));
    Object.values(data).forEach((d) => {
      PasienModal.sl_kel.append($('<option>', {
        value: d['KodeKel'],
        text:  d['Kelurahan'],
      }));
    });
    if(GlobalTemp != undefined){
      PasienModal.sl_kel.val(GlobalTemp['KDKEL'])
    }
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
  }
  

  function getPasien(){
    buttonLoading(toolbar.showBtn);
    $.ajax({
      url: `<?=site_url('DinkesController/getAllPasien')?>`, 'type': 'GET',
      data: toolbar.form.serialize(),
      success: function (data){
        buttonIdle(toolbar.showBtn);
        var json = JSON.parse(data);
        if(json['error']){
          swal("Simpan Gagal", json['message'], "error");
          return;
        }
        dataPasien = json['data'];
        renderPasien(dataPasien);
      },
      error: function(e) {}
    });
  }
    function renderPasien(data){
    if(data == null || typeof data != "object"){
      console.log("User::UNKNOWN DATA");
      return;
    }
    var i = 0;
    
    var renderData = [];
    Object.values(data).forEach((pasien) => {
           var detailButton =`
      <a class="detail dropdown-item" href='<?=site_url()?>RSController/DetailPasien?id_pasien=${pasien['id_pasien']}'><i class='fa fa-share'></i> Detail Pasien</a>
      `; 
      var editButton = `
        <a class="edit dropdown-item" data-id='${pasien['id_pasien']}'><i class='fa fa-pencil'></i> Edit Pasien</a>
      `;
      // var deleteButton = `
      //   <a class="delete dropdown-item" data-id='${pasien['id_pasien']}'><i class='fa fa-trash'></i> Hapus Pasien</a>
      // `;
      var button = `
        <div class="btn-group" role="group">
          <button id="action" type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='fa fa-bars'></i></button>
          <div class="dropdown-menu" aria-labelledby="action">
            ${detailButton}
            ${editButton}
          </div>
        </div>
      `;
      renderData.push([pasien['nama'],pasien['NIK'],pasien['nama_kab']+'<br>'+pasien['nama_kec']+'<br>'+pasien['nama_kel'], button]);
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
  }

  function convStatus(status){
  // var realisasi = parseFloat(realisasi);
  if(status == '1')
     return `<span class="label label-info"> OTG </span>`;
  else if (status == '2')
    return `<span class="label label-warning"> ODP </span>`;
  else if (status == '3')
    return `<span class="label label-warning"> PDP </span>`;
  else if (status == '4')
    return `<span class="label label-danger"> POSITIF </span>`;
  return `<span class="label label-success"> NEGATIF </span>`;  
}
  // getTahun();  
  //   function getTahun(){
  //   return $.ajax({
  //     url: `<?php echo site_url('DetailDinkesController/getTahun/')?>`, 'type': 'GET',
  //     data: {},
  //     success: function (data){
  //       var json = JSON.parse(data);
  //       if(json['error']){
  //         return;
  //       }
  //       dataTahun = json['data'];
  //       renderTahunTerdataSelection(dataTahun);
  //     },
  //     error: function(e) {}
  //   });
  // }

  // function renderTahunTerdataSelection(data){

  //   PasienModal.terdata.empty();
  //   PasienModal.terdata.append($('<option>', { value: "", text: "-- Pilih Tahun --"}));
  //   data.forEach((d) => {
  //     PasienModal.terdata.append($('<option>', {
  //       value: d['tahun'],
  //       text: d['tahun'],
  //     }));  
  //   });
  //  }


  
  FDataTable.on('click','.edit', function(){
    event.preventDefault();
    reset_pasienmodal();
    PasienModal.form.trigger('reset');
    PasienModal.self.modal('show');
    PasienModal.addBtn.hide();
    PasienModal.username.prop('readonly',true);
    PasienModal.password.prop('disabled',false);
    PasienModal.password.prop('required',false);
    PasienModal.repassword.prop('disabled',true);
    PasienModal.saveEditBtn.show();
    var id = $(this).data('id');
    var pasien = dataPasien[id];
    PasienModal.id_pasien.val(pasien['id_pasien']);
    PasienModal.nama.val(pasien['nama']);
    PasienModal.id_status.val(pasien['status']);
    PasienModal.id_user.val(pasien['id_user']);
  
    PasienModal.sl_kab.val(pasien['KDKAB']).trigger('change');
    GlobalTemp = pasien;
    console.log(GlobalTemp)
    // PasienModal.sl_kec.val(pasien['KDKEC']).trigger('change');

    PasienModal.NIK.val(pasien['NIK']);
    PasienModal.username.val(pasien['username']);
    PasienModal.email.val(pasien['email']);
    PasienModal.nomorhp.val(pasien['nomorhp']);
    PasienModal.alamat.val(pasien['alamat']);
    PasienModal.sl_kelamin.val(pasien['jenis_kelamin']);
    PasienModal.tempat_lahir.val(pasien['tempat_lahir']);
    PasienModal.tanggal_lahir.val(pasien['tanggal_lahir']);
    PasienModal.pekerjaan.val(pasien['pekerjaan']);
    PasienModal.sl_kewarganegaraan.val(pasien['kewarganegaraan']);
    PasienModal.sl_kategori.val(pasien['kategori']);
    PasienModal.nama_krt.val(pasien['nama_krt']);
    PasienModal.st_perkawinan.val(pasien['st_perkawinan']);
    PasienModal.sl_puskesmas.val(pasien['id_puskesmas']);
    if(pasien['jenis_kelamin'] == 'P'){
        PasienModal.sl_hamil.prop('disabled',false)
        PasienModal.sl_hamil.val(pasien['pasca_hamil']); 
      }else{
        PasienModal.sl_hamil.val(''); 
        PasienModal.sl_hamil.prop('disabled',true)     
      }
  });
  
  document.getElementById("export_btn").href = '<?= site_url('DinkesController/PdfAllPasien')?>';


  FDataTable.on('click','.delete', function(){
    event.preventDefault();
    var id = $(this).data('id');
    swal(swalDeleteConfigure).then((result) => {
      if(!result.value){ return; }
      $.ajax({
        url: "<?=site_url('DinkesController/deletePasien')?>", 'type': 'POST',
        data: {'id_pasien': id},
        success: function (data){
          var json = JSON.parse(data);
          if(json['error']){
            swal("Delete Gagal", json['message'], "error");
            return;
          }
          delete dataPasien[id];
          swal("Delete Berhasil", "", "success");
          renderPasien(dataPasien);
        },
        error: function(e) {}
      });
    });
  });

  FDataTable.on('click','.mail', function(){
    event.preventDefault();
    var id = $(this).data('id');
    swal(swalDeleteConfigure).then((result) => {
      if(!result.value){ return; }
      $.ajax({
        url: "<?=site_url('UserTempController/SendActivation')?>", 'type': 'POST',
        data: {'id_pasien': id},
        success: function (data){
          var json = JSON.parse(data);
          if(json['error']){
            swal("Delete Gagal", json['message'], "error");
            return;
          }
          delete dataPasien[id];
          swal("Delete Berhasil", "", "success");
          renderPasien(dataPasien);
        },
        error: function(e) {}
      });
    });
  });

  function showPasienModal(){
    PasienModal.self.modal('show');
    PasienModal.addBtn.show();
    PasienModal.saveEditBtn.hide();
    PasienModal.form.trigger('reset');
  
  }

  PasienModal.form.submit(function(event){
    event.preventDefault();
    switch(PasienModal.form[0].target){
      case 'add':
        addPasien();

        break;
      case 'edit':
        editPasien();
        break;
    }
  });

  function addPasien(){
    swal(swalSaveConfigure).then((result) => {
      if(!result.value){ return; }
      if(PasienModal.password.val() != PasienModal.repassword.val()){
                swal("Salah", 'Pengulangan Password Salah', "error");
     }else{
      buttonLoading(PasienModal.addBtn);
      $.ajax({
        url: `<?=site_url('DinkesController/addPasien_v2')?>`, 'type': 'POST',
        data: PasienModal.form.serialize(),
        success: function (data){
          buttonIdle(PasienModal.addBtn);
          var json = JSON.parse(data);
          if(json['error']){
            swal("Simpan Gagal", json['message'], "error");
            return;
          }
          var pasien = json['data']
          console.log(pasien)
          dataPasien[pasien['id_pasien']] = pasien;
          swal("Simpan Berhasil", "", "success");
          renderPasien(dataPasien);
          PasienModal.self.modal('hide');
        },
        error: function(e) {}
      });
     }
    });
  }

  
  function editPasien(){
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
          dataPasien[pasien['id_pasien']] = pasien;
          swal("Simpan Berhasil", "", "success");
          renderPasien(dataPasien);
          PasienModal.self.modal('hide');
        },
        error: function(e) {}
      });
    });
  }
});
</script>