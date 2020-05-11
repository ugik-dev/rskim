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
        <input type="hidden" id="is_not_self" name="is_not_self" value="1">
        <input type="hidden" id="sta_pkh" name="sta_pkh" value="2">
        <input type="hidden" id="sta_rastra" name="sta_rastra" value="4">
       
        <select class="form-control mr-sm-2" name="kd_kab" id="kd_kab"></select>
        <select class="form-control mr-sm-2" name="kd_kec" id="kd_kec"></select>
        <select class="form-control mr-sm-2" name="kd_kel" id="kd_kel"></select>
        <!-- <select class="form-control mr-sm-2" name="sta_pkh" id="sta_pkh"></select> -->
        <!-- <select class="form-control mr-sm-2" name="sta_rastra" id="sta_rastra"></select> -->
        <button hidden type="button" class="btn btn-success my-1 mr-sm-2" id="new_btn" disabled="disabled"><i class="fal fa-plus"></i> Tambah User Baru</button>
      </form>
    </div>
  </div>
  <div class="ibox ssection-container">

    <div class="ibox-content">
    <h5>Banyak Data</h5>
    <div class="row">
      <div class="col-lg-3">
        <div class="ibox">
          <!-- <div class="ibox-content"> -->
            <h5>Provinsi <span class="total_data_prov"></span></h5>
            <h2 class="no-margins"><span id="total_data_prov">-</span></h2>
            <!-- <div class="stat-percent font-bold"><span id="total_kegiatan_underperformed">0</span></div> -->
          </div>
        <!-- </div> -->
      </div>
      <div class="col-lg-3">
        <div class="ibox">
          <!-- <div class="ibox-content"> -->
            <h5>Kabupaten <span class="total_data_kab"></span></h5>
            <h2 class="no-margins"><span id="total_data_kab">-</span></h2>
            <!-- <div class="stat-percent font-bold"><span id="total_kegiatan_underperformed">0</span></div> -->
          <!-- </div> -->
        </div>
      </div>
      <div class="col-lg-3">
        <div class="ibox">
          <!-- <div class="ibox-content"> -->
            <h5>Kecamatan <span class="total_data_kec"></span></h5>
            <h2 class="no-margins"><span id="total_data_kec">-</span></h2>
            <!-- <div class="stat-percent font-bold"><span id="total_kegiatan_underperformed">0</span></div> -->
          <!-- </div> -->
        </div>
      </div>
      <div class="col-lg-3">
        <div class="ibox">
          <!-- <div class="ibox-content"> -->
            <h5>Keluarahan <span class="total_data_kel"></span></h5>
            <h2 class="no-margins"><span id="total_data_kel">-</span></h2>
            <!-- <div class="stat-percent font-bold"><span id="total_kegiatan_underperformed">0</span></div> -->
          <!-- </div> -->
        </div>
      </div>
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
                  <th style="width: 14%; text-align:center!important">ID BDT</th>
                  <th style="width: 24%; text-align:center!important">NAMA KK</th>
                  <th style="width: 24%; text-align:center!important">ALAMAT</th>
                  <th style="width: 24%; text-align:center!important">NO PBDT</th>
                  <th style="width: 16%; text-align:center!important">SLS</th>
                  <th style="width: 24%; text-align:center!important">Bantuan</th>
                  <th style="width: 5%; text-align:center!important">Action</th>
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
            <input type="hidden" id="IDBDT_edit" name="IDBDT">
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

<script>
$(document).ready(function() {
  $('#kategori').addClass('active');
  $('#kategori3').addClass('active');
 

  var toolbar = {
    'form': $('#toolbar_form'),
    'kd_kab': $('#toolbar_form').find('#kd_kab'),
    'kd_kec': $('#toolbar_form').find('#kd_kec'),
    'kd_kel': $('#toolbar_form').find('#kd_kel'),
    'sta_pkh': $('#toolbar_form').find('#sta_pkh'),
    'sta_rastra': $('#toolbar_form').find('#sta_rastra'),
    
    'newBtn': $('#new_btn'),
  }

  var toolbar_search = {
    'form': $('#toolbar_search'),
    'by_nik': $('#toolbar_search').find('#by_nik'),
    'by_nokk': $('#toolbar_search').find('#by_nokk'),
    'kd_perusahaan': $('#toolbar_search').find('#kd_perusahaan'),
    'srcBtn': $('#src_btn'),
  }

  var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [],
    deferRender: true,
    "order": [[ 0, "desc" ]]
  });

  var informasiModal = {
    self: $('#informasi_modal'),
    form: $('#informasi_form'),
    IDBDT_edit: $('#informasi_modal').find('#IDBDT_edit'),
    kd_jenis_bantuan: $('#informasi_modal').find('#kd_jenis_bantuan'),
    info: $('#informasi_modal').find('#info'),
    save_btn: $('#informasi_modal').find('#save'),
  }

  getJenisBantuan()
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
        dataUser[dataInfo['IDBDT']] = dataInfo;
        renderUser(dataUser);
        swal("Berhasil Tambah Bantuan", 'Input Informasi Berhasil', "success");
        informasiModal.self.modal('hide');
      },
      error: () => {
        buttonIdle(informasiModal.save_btn);
      },
    });
  });

  function colorBantuan(realisasi, na = false){
  // var realisasi = parseFloat(realisasi);
  if(realisasi == '0')
     return `<span class="label label-danger"> Belum Ada </span>`;
  else if (realisasi == '1')
    return `<span class="label label-info"> PKH dan BPNT</span>`;
  else if (realisasi == '2')
    return `<span class="label label-info"> BPNT </span>`;
  else if (realisasi == '3')
    return `<span class="label label-info"> Non PKH - Non BPNT </span>`;
  return `<span class="label label-danger"> Belum Ada </span>`;
}

  var dataRole = {}
  var dataOPD = {}
  var dataUser = {}

  var swalSaveConfigure = {
    title: "Konfirmasi simpan",
    text: "Yakin akan menyimpan data ini?",
    type: "info",
    showCancelButton: true,
    confirmButtonColor: "#18a689",
    confirmButtonText: "Ya, Simpan!",
  };

  
  var swalSearchNULL = {
    title: "Tidak Ada Kata Kunci",
    text: "Yakin akan menyimpan data ini?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#18a689",
    // confirmButtonText: "Ya, Simpan!",
  };

  var swalDeleteConfigure = {
    title: "Konfirmasi hapus",
    text: "Yakin akan menghapus data ini?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya, Hapus!",
  };

  // $.when(getAllRole(), getAllOPD(), getAllData()).then((e) =>{
  // $.when(getAllKab(),getAllData()).then((e) =>{
  $.when(getAllKab(),getAllData()).then((e) =>{

    toolbar.newBtn.prop('disabled', false);
  }).fail((e) => { console.log(e) });

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
  function reset_toolbar(){
    $('#total_data_prov').html('-');
    $('#total_data_kab').html('-');
    $('#total_data_kec').html('-');
    $('#total_data_kel').html('-');
    toolbar.kd_kab.val(null).trigger('change');
  }
  toolbar.kd_kab.on('change', (e) => {

    $('#total_data_kab').html('-');
    $('#total_data_kec').html('-');
    $('#total_data_kel').html('-');
    toolbar.kd_kec.val(null).trigger('change');
    getAllKec()
  });
  toolbar.kd_kec.on('change', (e) => {
    $('#total_data_kec').html('-');
    $('#total_data_kel').html('-');
    toolbar.kd_kel.val(null).trigger('change');
    getAllKel()
  });
  toolbar.kd_kel.on('change', (e) => {
    $('#total_data_kel').html('-');
    getAllData();
  });
  toolbar.sta_pkh.on('change', (e) => {
    reset_toolbar()
    getAllData()
  });
  toolbar.sta_rastra.on('change', (e) => {
    reset_toolbar()
    getAllData()
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
  
  function getAllData(){
    console.log('run')
    swal({title: 'Loading user...', allowOutsideClick: false});
    swal.showLoading();
    return $.ajax({
      url: `<?php echo site_url('DTKSController/getAllDTKSRT/')?>`, 'type': 'GET',
      data: toolbar.form.serialize(),
      success: function (data){
        swal.close();
        var json = JSON.parse(data);
        
        if(json['error']){
          return;
        }
        dataUser = json['data'];
        info = json['info'];
        if(info['jenis'] == 'provinsi') $('#total_data_prov').html(info['total']);
        if(info['jenis'] == 'kabupaten') $('#total_data_kab').html(info['total']);
        if(info['jenis'] == 'kecamatan') $('#total_data_kec').html(info['total']);
        if(info['jenis'] == 'kelurahan') $('#total_data_kel').html(info['total']);
        renderUser(dataUser);
      },
      error: function(e) {}
    });
  }

  
  function renderUser(data){
    if(data == null || typeof data != "object"){
      console.log("User::UNKNOWN DATA");
      return;
    }
    var i = 0;
    
    var renderData = [];
    Object.values(data).forEach((user) => {
      var editButton = `
        <a class="edit dropdown-item" data-id='${user['IDBDT']}'><i class='fa fa-pencil'></i> Atur Jenis Bantuan</a>
      `;
      var deleteButton = `
        <a class="delete dropdown-item" data-id='${user['IDBDT']}'><i class='fa fa-trash'></i> Hapus User</a>
      `;
     
      var detailButton = `<a href="<?=site_url("AdminController/PageInfoBantuan/")?>?IDBDT=${user['IDBDT']}" class="dropdown-item"><i class='fa fa-pencil'></i> Detail Info </a>`;
      
      var button = `
        <div class="btn-group" opd="group">
          <button id="action" type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='fa fa-bars'></i></button>
          <div class="dropdown-menu" aria-labelledby="action">
            ${detailButton}
            ${editButton}
          </div>
        </div>
      `;
      renderData.push([user['IDBDT'], user['Nama_KRT'], user['Alamat'], user['NoPesertaPBDT'], user['Nama_SLS'],  colorBantuan(user['jenis_bantuan']), button]);
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
    
  }

  toolbar_search.srcBtn.on('click', (e) => {
    console.log('active');
    if(toolbar_search.by_nik.val() == "" && toolbar_search.by_nokk.val() == ""){
      swal({title: 'Tidak Ada Kata Kunci', allowOutsideClick: true});
    }else{
      getSearch()
    }
  });

  function getSearch(){
    return $.ajax({
      url: `<?php echo site_url('TerdampakController/getAllDataInduk/')?>`, 'type': 'GET',
      data: toolbar_search.form.serialize(),
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataUser = json['data'];
        renderUser(dataUser)
      },
      error: function(e) {}
    });
  }

  FDataTable.on('click', '.edit', function(){
    informasiModal.IDBDT_edit.val(null);
    informasiModal.kd_jenis_bantuan.val(null);
    var currentData = dataUser[$(this).data('id')];
    console.log(currentData);
    informasiModal.self.modal('show');
    informasiModal.IDBDT_edit.val(currentData['IDBDT']);
    informasiModal.kd_jenis_bantuan.val(currentData['jenis_bantuan']);
  });

  FDataTable.on('click','.delete', function(){
    event.preventDefault();
    var id = $(this).data('id');
    swal(swalDeleteConfigure).then((result) => {
      if(!result.value){ return; }
      $.ajax({
        url: "<?=site_url('UserController/deleteUser')?>", 'type': 'POST',
        data: {'id_user': id},
        success: function (data){
          var json = JSON.parse(data);
          if(json['error']){
            swal("Delete Gagal", json['message'], "error");
            return;
          }
          delete dataUser[id];
          swal("Delete Berhasil", "", "success");
          renderUser(dataUser);
        },
        error: function(e) {}
      });
    });
  });

  FDataTable.on('click','.detail', function(){
    event.preventDefault();
    var id = $(this).data('id');
    swal(swalDeleteConfigure).then((result) => {
      if(!result.value){ return; }
      $.ajax({
        url: "<?=site_url('TerdampakController/openDetail')?>", 'type': 'POST',
        data: {'IDBDT': id},
        success: function (data){
          var json = JSON.parse(data);
          if(json['error']){
            swal("Delete Gagal", json['message'], "error");
            return;
          }
          delete dataUser[id];
          swal("Delete Berhasil", "", "success");
          renderUser(dataUser);
        },
        error: function(e) {}
      });
    });
  });
});
</script>