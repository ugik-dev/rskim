<div class="wrapper wrapper-content animated fadeInRight" id="info_container">
  <div class="row">
  
  <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
            <h5>Jenis Bantuan</h5>
            <p class="no-margins"><span id="jenis_bantuan">-</span></p>
            <button class="btn btn-success my-1 mr-sm-1" id="edit_bantuan"><i class='fa fa-edit'></i> Edit Bantuan</button>
 
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="ibox">
        <div class="ibox-content">
            <h5>Nama KRT</h5>
            <p class="no-margins"><span id="Nama_KRT">-</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="ibox">
        <div class="ibox-content">
            <h5>No KK</h5>
            <p class="no-margins"><span id="no_kk">-</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="ibox">
        <div class="ibox-content">
            <h5>ID BDT</h5>
            <p class="no-margins"><span id="IDBDT">-</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="ibox">
        <div class="ibox-content">
          <h5>No Peserta PBDT</h5>
          <p class="no-margins"><span id="NoPesertaPBDT">-</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="ibox">
        <div class="ibox-content">
            <h5>Status PKH</h5>
            <p class="no-margins"><span id="sta_pkh">-</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="ibox">
        <div class="ibox-content">
          <h5>Status BPNT / RASTRA</h5>
          <p class="no-margins"><span id="sta_rastra">-</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <h5>Alamat</h5>
          <p class="no-margins"><span id="Alamat">-</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <h5>Jumlah ART</h5>
          <p class="no-margins"><span id="Jumlah_ART">-</span></p>
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
      </div>
    </div>

    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <h5>Data Keluarga</h5>
          <div class="table-responsive">
            <table id="FDataTable" class="table table-bordered table-hover" style="padding:0px">
              <thead>
                <tr>
                  <th style="width: 24%; text-align:center!important">NIK</th>
                  <th style="width: 24%; text-align:center!important">Nama</th>
                  <th style="width: 24%; text-align:center!important"> Tempat Lahir</th>
                  <th style="width: 16%; text-align:center!important">Tanggal Lahir</th>
                  <th style="width: 12%; text-align:center!important">Umur</th>
                  <th style="width: 5%; text-align:center!important">No PKH</th>
                  <th style="width: 5%; text-align:center!important">No PBI</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-4">
      <button class="btn btn-success my-1 mr-sm-2" id="add_tim_btn"><i class='fa fa-plus'></i> Tambah Tim</button>
      <button class="btn btn-success my-1 mr-sm-2" id="edit_info_btn"><i class='fa fa-edit'></i> Edit Informasi</button>
    </div>
  </div>
</div>

<div class="modal inmodal" id="tim_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Kelola TIM</h4>
            <span class="info"></span>
        </div>
        <div class="modal-body" id="modal-body">              
          <form role="form" id="tim_form" onsubmit="return false;" type="multipart">
            <input type="hidden" id="IDBDT" name="IDBDT">
            <div class="row">
              <div class="col-sm-7">
                <div class="form-group">
                  <label for="list_tim">Nama / NIP Tim</label> 
                  <input type="text" class="form-control" id="list_tim" name="list_tim" placeholder="Tidak ada" required="required" >
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="id_user">ID Tim</label> 
                  <input type="text" class="form-control" id="id_user" name="id_user" placeholder="Tidak ada" required="required" readonly>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <img id="photo_tim" class="rounded img-md">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="id_jabatan_tim">Jabatan Tim</label> 
              <select class="form-control mr-sm-2" name="id_jabatan_tim" id="id_jabatan_tim" required="required"></select>
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
            <!-- <input type="hidden" id="IDBDT" name="IDBDT"> -->
            <input type="hidden"  id="IDBDT_edit" name="IDBDT">
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
  var sessionData = JSON.parse(`<?=json_encode(DataStructure::slice($this->session->userdata(), ['id_role']))?>`);
  
  var IDBDT = `<?=$contentData['IDBDT']?>`;

 
  var info = {
    'self': $('#info_container'),
    'jenis_bantuan': $('#info_container').find('#jenis_bantuan'),
    'IDBDT': $('#info_container').find('#IDBDT'),
    'NoPesertaPBDT': $('#info_container').find('#NoPesertaPBDT'),
    'Nama_KRT': $('#info_container').find('#Nama_KRT'),
    'Alamat': $('#info_container').find('#Alamat'),
    'Jumlah_ART': $('#info_container').find('#Jumlah_ART'),
    'sta_pkh': $('#info_container').find('#sta_pkh'),
    'sta_rastra': $('#info_container').find('#sta_rastra'),
    
    'nama_kab': $('#info_container').find('#nama_kab'),
    'nama_kec': $('#info_container').find('#nama_kec'),
    'nama_kel': $('#info_container').find('#nama_kel'),
    'no_kk': $('#info_container').find('#no_kk'),
    'edit_info_btn': $('#edit_info_btn'),
    'add_tim_btn': $('#add_tim_btn')
  }

  if(sessionData['id_role'] != 6){
    info.edit_info_btn.hide();
    info.add_tim_btn.hide();
  }

    $('#edit_bantuan').on('click', function(){
        informasiModal.self.modal('show');
        informasiModal.IDBDT_edit.val(dataInfo['IDBDT']);
        informasiModal.kd_jenis_bantuan.val(dataInfo['jenis_bantuan']);
    });
  var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [{ targets: [0, 3, 4], className: 'text-center'}, ],
    deferRender: true,
    'ordering': false,
    'paging': false,
    'searching': false
  });

  var timModal = {
    self: $('#tim_modal'),
    form: $('#tim_form'),
    IDBDT: $('#tim_modal').find('#IDBDT'),
    list_tim: $('#tim_modal').find('#list_tim'),
    id_user: $('#tim_modal').find('#id_user'),
    photo_tim: $('#tim_modal').find('#photo_tim'),
    id_jabatan_tim: $('#tim_modal').find('#id_jabatan_tim'),
    info: $('#tim_modal').find('#info'),
    save_btn: $('#tim_modal').find('#save'),
  }
  var informasiModal = {
    self: $('#informasi_modal'),
    form: $('#informasi_form'),
    IDBDT_edit: $('#informasi_modal').find('#IDBDT_edit'),
    kd_jenis_bantuan: $('#informasi_modal').find('#kd_jenis_bantuan'),
    info: $('#informasi_modal').find('#info'),
    save_btn: $('#informasi_modal').find('#save'),
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
        url: `<?php echo site_url('DTKSController/getAllDTKSRT_v2/')?>`, 'type': 'GET',
       data : {IDBDT: IDBDT},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataInfo = json['data']['0'];
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
  function renderInfo(){
    info.jenis_bantuan.html(`${colorBantuan(dataInfo['jenis_bantuan'])}`);
    info.IDBDT.html(`${dataInfo['IDBDT']}`);
    info.NoPesertaPBDT.html(`${dataInfo['NoPesertaPBDT']}`);
    info.sta_pkh.html(`${dataInfo['sta_pkh'] == '1' ? 'Ya' : 'Tidak Ada' }`);
    info.sta_rastra.html(`${dataInfo['sta_rastra'] == '3' ? 'Ya' : 'Tidak Ada' }`);
  
    info.Nama_KRT.html(`${dataInfo['Nama_KRT']}`);
    info.Alamat.html(`${dataInfo['Alamat']}`);
    info.Jumlah_ART.html(`${dataInfo['Jumlah_ART']}`);
    info.nama_kab.html(`${dataInfo['nama_kab']}`);
    info.nama_kec.html(`${dataInfo['nama_kec']}`);
    info.nama_kel.html(`${dataInfo['nama_kel']}`);
    info.no_kk.html(`${dataInfo['no_kk']}`);
    // info.Nama_KRT.html(`${dataInfo['NO_KTP_NIK_PEKERJA']}`);
    // info.kontak.html(`${dataInfo['NO_HP']+'  <br>'+dataInfo['email']}`);
    // info.Alamat.html(`<a href="<?=site_url()?>OPPerencanaanController/detail?id_opd${dataInfo['id_opd']}">${dataInfo['Alamat']}</a>`);
  }

  function renderTim(data){
    if(data == null || typeof data != "object"){
      console.log("User::UNKNOWN DATA");
      return;
    }
    var i = 0;
    
    var renderData = [];
    Object.values(data).forEach((tim) => {
    //   var deleteButton = `
    //     <a class="delete dropdown-item" data-id='${tim['id_kegiatan_tim']}'><i class='fa fa-trash'></i> Hapus Tim</a>
    //   `;
    //   var button = `
    //     <div class="btn-group" opd="group">
    //       <button id="action" type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='fa fa-bars'></i></button>
    //       <div class="dropdown-menu" aria-labelledby="action">
    //         ${deleteButton}
    //       </div>
    //     </div>
    //   `;
    //   var no_hp = tim['no_hp_tim'] ? tim['no_hp_tim'] : 'Tidak Ada';
    //   var photo = tim['photo_tim'] ? `<img src="<?=base_url('uploads/photo/')?>${tim['photo_tim']}" class="img-sm">` : 'Tidak Ada';
      renderData.push([tim['NIK'], tim['Nama'], tim['TmpLahir'],tim['TglLahir'], tim['Umur'],tim['NoPesertaPKH'],tim['NoPesertaPBI']]);
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
  }

  timModal.form.on('submit', (ev) => {
    ev.preventDefault();
    buttonLoading(timModal.save_btn);
    $.ajax({
      url: "<?=site_url('KegiatanController/addTim')?>",
      type: "POST",
      data: timModal.form.serialize(),
      success: (data) => {
        buttonIdle(timModal.save_btn);
        json = JSON.parse(data);
        if(json['error']){
          swal("Tambah Tim Gagal", json['message'], "error");
          return;
        } 
        dataInfo = json['data'];
        renderInfo();
        
        renderTim(dataInfo['tim']);
        swal("Berhasil disimpan", 'Tambah Tim Berhasil', "success");
        timModal.self.modal('hide');
      },
      error: () => {
        buttonIdle(timModal.save_btn);
      },
    });
  });


  FDataTable.on('click','.delete', function(){
    event.preventDefault();
    var id = $(this).data('id');
    swal(swalDeleteConfigure).then((result) => {
      if(!result.value){ return; }
      $.ajax({
        url: "<?=site_url('KegiatanController/deleteTim')?>", 'type': 'POST',
        data: {'id_kegiatan_tim': id},
        success: function (data){
          var json = JSON.parse(data);
          if(json['error']){
            swal("Delete Gagal", json['message'], "error");
            return;
          }
          delete dataInfo['tim'][id];
          swal("Delete Berhasil", "", "success");
          renderTim(dataInfo['tim']);
        },
        error: function(e) {}
      });
    });
  });

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
  function getTim(){
    return $.ajax({
        url: `<?php echo site_url('DTKSController/getAllDTKSART/')?>`, 
        data : {IDBDT: dataInfo['IDBDT']},
        type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataKeluarga = json['data'];
        if(dataKeluarga != 'NULL'){
            console.log('run')
        info.no_kk.html(`${dataKeluarga['0']['NoKK']}`);
        // info.st_terdata.html(`Terdata`);
        renderTim(dataKeluarga);
        }else{
        //   info.st_terdata.html(`Tidak Terdata`);
        }
      },
      error: function(e) {}, 
    });
  }

  function renderTimSelection(data){
    if(data == null || typeof data != "object") return;
    timModal.list_tim.typeahead({ 
      source: Object.values(data).map((e) => {
        return `${e['nama']} (${e['nip']}) -- ${e['id_user']}`;
      }),
      afterSelect: function(data){
        var id = data.split(" -- ")[1];
        var user = dataUser[id];
        timModal.id_user.val(user['id_user']);
        timModal.photo_tim.attr('src', user['photo']);
      }
    });
    timModal.list_tim.on('blur', function(e){
      if(empty(timModal.list_tim.val())) {
        timModal.id_user.val('');
        timModal.photo_tim.attr('src', null);
      }
    });
  }

  info.add_tim_btn.on('click', function(){
    timModal.self.modal('show');
    timModal.IDBDT.val(dataInfo['IDBDT']);
  });
  
  info.edit_info_btn.on('click', function(){
    informasiModal.self.modal('show');
    informasiModal.IDBDT.val(dataInfo['IDBDT']);
    informasiModal.lokasi.val(dataInfo['lokasi']);
  });

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