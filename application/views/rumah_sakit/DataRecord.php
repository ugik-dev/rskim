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
                  <th style="width: 12%; text-align:center!important">No Rekam</th>
                  
                  
                  <th style="width: 10%; text-align:center!important">Jadwal Rekam</th>
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



<div class="modal inmodal" id="record_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Kelola Record Medis</h4>
            <span class="info"></span>
        </div>
        <div class="modal-body" id="modal-body">              
          <form role="form" id="record_form" onsubmit="return false;" type="multipart">
            <input type="" id="id_record" name="id_record">
            <input type="" id="id_pasien_rec" name="id_pasien">
            <input type="" id="berbayar" name="berbayar" value='Ya'>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="tanggal_record">Tanggal </label> 
                  <input type="datetime-local" class="form-control" id="tanggal_record" name="tanggal_record" required="required" >
                </div>
              </div>
              <div class="col-sm-12">
                  <div class ="form-group">
                    <label for="before_status">Status Awal</label>
                    <select class="form-control mr-sm-2" id="before_status" name="before_status" required="required" readonly>
                    </select>
                  </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="tanggal_record">No Rekam Medis</label> 
                  <input type="text" class="form-control" id="no_rekam" name="no_rekam" required="required" >
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                <label for="jenis_sampel">Jenis Uji</label> 
                  <select class="form-control mr-sm-2" id="jenis_sampel" name="jenis" required="required">
                  </select>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="tanggal_record">Nama Rumah Sakit</label> 
                  <input readonly="readonly" type="text" class="form-control" id="rumah_sakit" name="rumah_sakit" required="required" >
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="deskripsi">Deskripsi</label> 
                  <textarea rows="4" type="text" placeholder="deskripsi" class="form-control" id="deskripsi" name="deskripsi" required="required"></textarea>
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


<script>
$(document).ready(function() {
 
  $('#data_record').addClass('active');
 
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

  var recordModal = {
    self: $('#record_modal'),
    form: $('#record_form'),
    NO: $('#record_modal').find('#NO'),
    id_pasien_rec: $('#record_modal').find('#id_pasien_rec'),
    id_record: $('#record_modal').find('#id_record'),
    tanggal_record: $('#record_modal').find('#tanggal_record'),
    before_status: $('#record_modal').find('#before_status'),
    no_rekam: $('#record_modal').find('#no_rekam'),
    rumah_sakit: $('#record_modal').find('#rumah_sakit'),
    deskripsi: $('#record_modal').find('#deskripsi'),
    info: $('#record_modal').find('#info'),
    'addBtn': $('#record_modal').find('#add_btn'),
    'saveEditBtn': $('#record_modal').find('#save_edit_btn'),
    jenis_sampel: $('#record_modal').find('#jenis_sampel'),
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


  var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [],
    deferRender: true,
    "order": [[ 0, "desc" ]]
  });



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
        getRecord();
        break;
      case 'add':
      console.log('add')
        // reset_pasienmodal();
        // GlobalTemp = undefined;
        showRecordModal();
        // PasienModal.username.prop('readonly',false);
        // PasienModal.password.prop('disabled',false);
        // PasienModal.repassword.prop('disabled',false);
        // PasienModal.password.prop('required',true);
        
        break;
    }
  });

  function showRecordModal(){
    recordModal.self.modal('show');
    recordModal.id_pasien_rec.val();
    recordModal.saveEditBtn.hide();
    recordModal.addBtn.show();
    recordModal.before_status.val(dataInfo['status']);
    recordModal.rumah_sakit.val(dataInfo['nama_puskesmas']);

  };

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
    recordModal.no_rekam.val(current['no_rekam']);
    recordModal.rumah_sakit.val(current['rumah_sakit']);
    var datecur = current['tanggal_record']
    var res = datecur.substr(0,10);
    var res2 = datecur.substr(11,5);
    console.log(res+'T'+res2)
    recordModal.tanggal_record.val(res+'T'+res2);

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
    getRecord();
  });
  toolbar.sta_pkh.on('change', (e) => {
    reset_toolbar()
    getRecord()
  });
  toolbar.sta_rastra.on('change', (e) => {
    reset_toolbar()
    getRecord()
  });
  

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

  }

  function renderKecOptionFilter(data){
   
  }

  function renderKelOptionFilter(data){
   
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
   
  }
  

  function getRecord(){
    buttonLoading(toolbar.showBtn);
    $.ajax({
      url: `<?=site_url('DinkesController/getAllRecord')?>`, 'type': 'GET',
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
      <a class="detail dropdown-item" href='<?=site_url()?>DinkesController/DetailPasien?id_pasien=${pasien['id_pasien']}'><i class='fa fa-share'></i> Detail Pasien</a>
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
      renderData.push([pasien['nama'],pasien['NIK'],pasien['nama_kab']+'<br>'+pasien['nama_kec']+'<br>'+pasien['nama_kel'],convStatus(pasien['status']), button]);
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

  
});
</script>