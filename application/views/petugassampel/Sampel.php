
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">
                <button class="btn btn-success my-1 mr-sm-2" id="request_btn"><i class='fa fa-plus'></i> Tambah Data Uji Sampel</button>
                
            </div>
        </div>
    </div>
  

<!-- <div class="row"> -->
    <div class="col-lg-12">
 
      <div class="ibox">
        <div class="ibox-content">
          <h5>Riwayat Cek</h5>
          <div class="table-responsive">
            <table id="FDataTable" class="table table-bordered table-hover" style="padding:0px">
              <thead>
                <tr>
                  <th style="width: 12%; text-align:center!important">Tanggal Request</th>
                  <th style="width: 24%; text-align:center!important">Nama / NIK</th>
                  <!-- <th style="width: 24%; text-align:center!important">Kab / Kec</th> -->
                  <th style="width: 24%; text-align:center!important">Jenis</th>
                  <th style="width: 24%; text-align:center!important">Status / Hasil</th>
                  <th style="width: 24%; text-align:center!important">Nomor Sampel</th>
                  
                  <!-- <th style="width: 24%; text-align:center!important">Tempat</th> -->
                  
                  <th style="width: 16%; text-align:center!important">Tanggal Pengujian</th>
                  <th style="width: 5%; text-align:center!important">Action</th>
                  
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
      </div>


<div class="modal inmodal" id="request_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Atur Tanggal</h4>
            <span class="info"></span>
        </div>
        <div class="modal-body" id="modal-body">              
          <form role="form" id="request_form" onsubmit="return false;" type="multipart">
            <!-- <input type="hidden" id="NO" name="NO"> -->
            <input type="hidden"  id="id_sampel" name="id_sampel">
            <input type="hidden"  id="" name="status_sampel" value="2">
            <div class="form-group">
            <input type="datetime-local" class="form-control" id="tanggal_pengambilan_sampel" name="tanggal_pengambilan_sampel" required="required" >
             
            </div>
            <button class="btn btn-success my-1 mr-sm-2" type="submit" id="save" data-loading-text="Loading..."><strong>Atur Tanggal</strong></button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>


<div class="modal inmodal" id="hasil_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Input Hasil</h4>
            <span class="info"></span>
        </div>
        <div class="modal-body" id="modal-body">              
          <form role="form" id="hasil_form" onsubmit="return false;" type="multipart">
            <!-- <input type="hidden" id="NO" name="NO"> -->
            <input type="hidden"  id="id_sampel" name="id_sampel">
            <input type="hidden"  id="" name="status_sampel" value="4">
            <div class="form-group">
            <label for="negara">Nomor Sampel</label> 
       
            <input type="text" class="form-control" id="no_sampel" name="no_sampel" required="required" >
             
            </div>
            <div class="form-group">
            <label for="negara">Hasil</label> 
       
            <input type="text" class="form-control" id="hasil" name="hasil" required="required" >
             
            </div>
            <button class="btn btn-success my-1 mr-sm-2" type="submit" id="save" data-loading-text="Loading..."><strong>Simpan Hasil</strong></button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

<div class="modal inmodal" id="manual_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Input Hasil</h4>
            <span class="info"></span>
        </div>
        <div class="modal-body" id="modal-body">              
          <form role="form" id="manual_form" onsubmit="return false;" type="multipart">
            <!-- <input type="hidden" id="NO" name="NO"> -->
            <!-- <input type="hidden"  id="id_sampel" name="id_sampel"> -->
            <input type="hidden"  id="status_sampel" name="status_sampel" value="2">
            <input type="hidden"  id="id_pasien" name="id_pasien" >
            <input type="hidden"  id="instansi" name="instansi" >
            <div class="form-group">
            <label for="negara">Nama / NIK</label> 
       
            <input type="text" class="form-control" id="list_nama_nik" name="" placeholder="Tidak ada" required="required" >
                
            </div>
            <div class="form-group">
            <label for="negara">Jenis Ujis</label>  
              <select class="form-control mr-sm-2" name="jenis" id="jenis_request" required="required"></select>
            </div>
            <div class="custom-control custom-switch">
              <!-- <label class="custom-control-label" for="customSwitch1">Penjadwalan</label> -->
              <input type="checkbox" class="custom-control-input" id="customSwitch1">
              <label class="custom-control-label" for="customSwitch1">Hasil</label>
            </div>
            <div class="form-group">
              <label for="negara">Tanggal Penjadwalan Sampel</label>     
              <input type="datetime-local" class="form-control" id="tanggal_pengambilan_sampel" name="tanggal_pengambilan_sampel" required="required" >
            </div> 
            <div class="form-group">
              <label for="negara">Nomor Sampel</label> 
              <input disabled type="text" class="form-control" id="no_sampel" name="no_sampel" required="required" >
            </div>
           
            <div class="form-group">
              <label for="negara">Hasil</label>       
              <input disabled type="text" class="form-control" id="hasil" name="hasil" required="required" >             
            </div>
            <button class="btn btn-success my-1 mr-sm-2" type="submit" id="save" data-loading-text="Loading..."><strong>Simpan Hasil</strong></button>
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
   $('#sampel').addClass('active');
  var id_instansi = `<?=$this->session->userdata('id_instansi')?>`;
  console.log(id_instansi)

  var dataListPasien = [];
  if(sessionData['id_role'] != 2){
    // info.edit_info_btn.hide();
    // info.request_btn.hide();
  }
  // $(document).on('click', '[name="xray"]', function () {
  //     if( document.getElementById("xray2").checked == true){
  //       info.hasil_xray.prop('disabled', false);
  //       info.hasil_xray.val(dataRecord['hasil_xray']);
  //     }else{
  //       info.hasil_xray.prop('disabled', true);
  //       info.hasil_xray.val("");
  //     }
  // });
  $('#customSwitch1').on('click', function(){
       console.log(manualModal.customSwitch1.val())
      //  manualModal.hasil.prop('disabled',false)

       if( document.getElementById("customSwitch1").checked == true){
        manualModal.hasil.prop('disabled', false);
        manualModal.no_sampel.prop('disabled', false);
        manualModal.tanggal_pengambilan_sampel.prop('disabled', true);
        manualModal.status_sampel.val('4')
        // manualModal.hasil.val(dataRecord['hasil_xray']);
      }else{
        manualModal.hasil.prop('disabled', true);
        manualModal.no_sampel.prop('disabled', true);
        manualModal.tanggal_pengambilan_sampel.prop('disabled', false);
        manualModal.status_sampel.val('2')
      }
    });

    $('#request_btn').on('click', function(){
        manualModal.form.trigger('reset');
        manualModal.self.modal('show');
        manualModal.instansi.val(id_instansi);
        // requestModal.jenis_request.val(dataInfo['jenis_request']);
    });

    var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [],
    deferRender: true,
    "order": [[ 0, "desc" ]]
  });


  var manualModal = {
    self: $('#manual_modal'),
    form: $('#manual_form'),
    list_nama_nik: $('#manual_modal').find('#list_nama_nik'),
    jenis_request: $('#manual_modal').find('#jenis_request'),
    id_pasien: $('#manual_modal').find('#id_pasien'),
    customSwitch1: $('#manual_modal').find('#customSwitch1'),
    hasil: $('#manual_modal').find('#hasil'),
    no_sampel: $('#manual_modal').find('#no_sampel'),
    tanggal_pengambilan_sampel: $('#manual_modal').find('#tanggal_pengambilan_sampel'),
    instansi: $('#manual_modal').find('#instansi'),
    status_sampel: $('#manual_modal').find('#status_sampel'),
    info: $('#manual_modal').find('#info'),
    save_btn: $('#manual_modal').find('#save'),
  }

  var requestModal = {
    self: $('#request_modal'),
    form: $('#request_form'),
    id_sampel: $('#request_modal').find('#id_sampel'),
    tanggal_pengambilan_sampel: $('#request_modal').find('#tanggal_pengambilan_sampel'),
    instansi: $('#request_modal').find('#instansi'),
    info: $('#request_modal').find('#info'),
    save_btn: $('#request_modal').find('#save'),
  }

  var hasilModal = {
    self: $('#hasil_modal'),
    form: $('#hasil_form'),
    id_sampel: $('#hasil_modal').find('#id_sampel'),
    hasil: $('#hasil_modal').find('#hasil'),
    instansi: $('#hasil_modal').find('#instansi'),
    info: $('#hasil_modal').find('#info'),
    save_btn: $('#hasil_modal').find('#save'),
  }
 

 
  var dataInfo = {};
  var dataSampel = {};
  var dataUser = {};
  
  var swalDeleteConfigure = {
    title: "Konfirmasi hapus",
    text: "Yakin akan menghapus data ini?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya, Hapus!",
  };

   
  var swalRequestConfigure = {
    title: "Konfirmasi",
    text: "Apakah jadwal sudah benar?",
    type: "info",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya!",
  };

  var swalHasilConfigure = {
    title: "Konfirmasi",
    text: "Apakah hasil sudah benar? data tidak dapat dirubah lagi",
    type: "info",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya!",
  };

  getAllSampel();  
  function getAllSampel(){
    return $.ajax({
      url: `<?php echo site_url('PasienController/getAllSampel/')?>`, 'type': 'GET',
      data: {id_instansi : id_instansi, sta: '1'},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataSampel = json['data'];
        renderSampel(dataSampel);
      },
      error: function(e) {}
    });
  }

function convStatus(status,hasil){
  // var realisasi = parseFloat(realisasi);
  if(status == '1')
     return `Request`;
  else if (status == '2')
    return `Terjadwal`;
  else if (status == '3')
    return `Menunggu Hasil`;
  else 
  return hasil;  
}


  function renderSampel(data){
    if(data == null || typeof data != "object"){
      console.log("User::UNKNOWN DATA");
      return;
    }
    var i = 0;
    
    var renderData = [];
    Object.values(data).forEach((sampel) => {
      var detailButton = `<button class="edit btn btn-success my-1 mr-sm-2"  data-id='${sampel['id_sampel']}' ><i class='fa fa-pencil'></i> Atur Jadwal</button>`;
      var hasilButton = `<button class="hasil btn btn-success my-1 mr-sm-2"  data-id='${sampel['id_sampel']}' ><i class='fa fa-pencil'></i> Hasil </button>`;
   
      var deleteButton = `
        <a class="delete dropdown-item" data-id='${sampel['id_sampel']}'><i class='fa fa-trash'></i> Hapus sampel</a>
      `;
      var editButton = `
        <a class="edit dropdown-item" data-id='${sampel['id_sampel']}'><i class='fa fa-pencil'></i> Edit sampel</a>
      `;
      var button = `
        <div class="btn-group" opd="group">
          <button id="action" type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='fa fa-bars'></i></button>
          <div class="dropdown-menu" aria-labelledby="action">
            ${detailButton}
          </div>
        </div>
      `;
    //   var no_hp = sampel['no_hp_tim'] ? sampel['no_hp_tim'] : 'Tidak Ada';
    //   var photo = sampel['photo_tim'] ? `<img src="<?=base_url('uploads/photo/')?>${sampel['photo_tim']}" class="img-sm">` : 'Tidak Ada';
      renderData.push([sampel['tanggal_request'],  sampel['nama_pasien']+' / '+ sampel['nik'],sampel['jenis'], convStatus(sampel['status_sampel'],sampel['hasil']),sampel['no_sampel'],sampel['tanggal_pengambilan_sampel'],sampel['status_sampel'] != '4' ? detailButton+hasilButton : '']);
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
  }

  function convertDateTime(date){
  // var datecur = current['tanggal_record']
    var res = date.substr(0,10);
    var res2 = date.substr(11,5);
    return res+'T'+res2;
}

  FDataTable.on('click','.edit', function(){
    event.preventDefault();
    requestModal.form.trigger('reset');
    requestModal.self.modal('show');
    // requestModal.addBtn.hide();
    requestModal.save_btn.show();
    var id = $(this).data('id');
    var cur = dataSampel[id];
    console.log(cur)
    requestModal.id_sampel.val(cur['id_sampel']);
    requestModal.tanggal_pengambilan_sampel.val(convertDateTime(cur['tanggal_pengambilan_sampel']));
    

  });

  FDataTable.on('click','.hasil', function(){
    event.preventDefault();
    hasilModal.form.trigger('reset');
    hasilModal.self.modal('show');
    // requestModal.addBtn.hide();
    hasilModal.save_btn.show();
    var id = $(this).data('id');
    var cur = dataSampel[id];
    console.log(cur)
    hasilModal.id_sampel.val(cur['id_sampel']);
    hasilModal.hasil.val(cur['hasil']);
    

  });
  hasilModal.form.on('submit', (ev) => {
    Swal(swalHasilConfigure).then((result) => {
      if(!result.value){ return; }
    ev.preventDefault();
    buttonLoading(hasilModal.save_btn);
    $.ajax({
      url: "<?=site_url('PasienController/editSampel/')?>",
      type: "POST",
      data: hasilModal.form.serialize(),
      success: (data) => {
        buttonIdle(hasilModal.save_btn);
        json = JSON.parse(data);
        if(json['error']){
          swal("Request Gagal", json['message'], "error");
          return;
        } 
        sampel = json['data'];
        // console.log(dataSampel)
        dataSampel[sampel['id_sampel']] = sampel;
        renderSampel(dataSampel);
        swal("Berhasil Request", 'Harap Tunggu Informasi Penjadwalan', "success");
        hasilModal.self.modal('hide');
      },
      error: () => {
        buttonIdle(requestModal.save_btn);
      },
    });
    });
  });
  requestModal.form.on('submit', (ev) => {
    Swal(swalRequestConfigure).then((result) => {
      if(!result.value){ return; }
    ev.preventDefault();
    buttonLoading(requestModal.save_btn);
    $.ajax({
      url: "<?=site_url('PasienController/editSampel/')?>",
      type: "POST",
      data: requestModal.form.serialize(),
      success: (data) => {
        buttonIdle(requestModal.save_btn);
        json = JSON.parse(data);
        if(json['error']){
          swal("Request Gagal", json['message'], "error");
          return;
        } 
        sampel = json['data'];
        // console.log(dataSampel)
        dataSampel[sampel['id_sampel']] = sampel;
        renderSampel(dataSampel);
        swal("Berhasil Request", 'Harap Tunggu Informasi Penjadwalan', "success");
        requestModal.self.modal('hide');
      },
      error: () => {
        buttonIdle(requestModal.save_btn);
      },
    });
    });
  });
  


  manualModal.form.on('submit', (ev) => {
    if(manualModal.id_pasien.val() == "" ){
      swal("Nama / NIK", 'Data Tidak Ada !!', "error");
    }else{
    Swal(swalRequestConfigure).then((result) => {
      if(!result.value){ return; }
    ev.preventDefault();
    buttonLoading(manualModal.save_btn);
    $.ajax({
      url: "<?=site_url('PasienController/requestSampel/')?>",
      type: "POST",
      data: manualModal.form.serialize(),
      success: (data) => {
        buttonIdle(manualModal.save_btn);
        json = JSON.parse(data);
        if(json['error']){
          swal("Tambah Gagal Gagal", json['message'], "error");
          return;
        } 
        sampel = json['data'];
        // console.log(dataSampel)
        dataSampel[sampel['id_sampel']] = sampel;
        renderSampel(dataSampel);
        swal("Berhasil Tambah Data", '', "success");
        manualModal.self.modal('hide');
      },
      error: () => {
        buttonIdle(manualModal.save_btn);
      },
    });
    });
  }
  });

  getTim();
  function getTim(){
    return $.ajax({
      url: `<?php echo site_url('DinkesController/getAllPasien/')?>`,
      data : {},
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataListPasien = json['data'];
        renderTimSelection(dataListPasien);
      },
      error: function(e) {}, 
    });
  }

  function renderTimSelection(data){
    console.log('Ren')
    console.log(dataListPasien);
    if(data == null || typeof data != "object") return;
    manualModal.list_nama_nik.typeahead({ 
      source: Object.values(data).map((e) => {
        return `${e['nama']}/${e['NIK']} ::${e['id_pasien']}`;
      }),
      
      afterSelect: function(data){
        
        var id = data.split("::")[1];
        var user = dataListPasien[id];
 
        manualModal.list_nama_nik.val(`${user['nama']}/${user['NIK']} :: ${user['id_pasien']}`);
        manualModal.id_pasien.val(user['id_pasien']);
      }
    });
    manualModal.list_nama_nik.on('blur', function(e){
      
      var id = manualModal.list_nama_nik.val().split("::")[1];

      if(empty(id)) {
        swal("Nama / NIK", 'Data Tidak Ada !!', "error");
        manualModal.list_nama_nik.val('');
        manualModal.id_pasien.val('');
      }
    });
  }
  renderJenisSampelSelection();
  function renderJenisSampelSelection(){
      
    manualModal.jenis_request.empty();
    manualModal.jenis_request.append($('<option>', { value: "", text: "-- Pilih Jenis --"}));
    manualModal.jenis_request.append($('<option>', { value: "RAPID", text: "RAPID"}));
    manualModal.jenis_request.append($('<option>', { value: "SWAP", text: "SWAP"}));
  }

});
</script>