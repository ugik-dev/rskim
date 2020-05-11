<div hidden class="wrapper wrapper-content animated fadeInRight" id="info_container">
    <div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">
                <button class="btn btn-success my-1 mr-sm-2" id="request_btn"><i class='fa fa-plus'></i> Request Uji Sampel</button>
                <h5>Silahkan request untuk dijadwalkan pengujian sampel anda</h5>
            </div>
        </div>
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
                  <!-- <th style="width: 12%; text-align:center!important">Tanggal Request</th> -->
                  <th style="width: 25%; text-align:center!important">Nama / NIK</th>
                  <!-- <th style="width: 24%; text-align:center!important">Kab / Kec</th> -->
                  <th style="width: 15%; text-align:center!important">Jenis</th>
                  <!-- <th style="width: 24%; text-align:center!important">Status / Hasil</th> -->
                  <th style="width: 15%; text-align:center!important">Nomor Sampel</th>
                  
                  <!-- <th style="width: 24%; text-align:center!important">Tempat</th> -->
                  
                  <th style="width: 16%; text-align:center!important">Tanggal Pengujian</th>
                  <th style="width: 16%; text-align:center!important">Hasil Laboratorium</th>
                  
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
            <input type="hidden"  id="id_record" name="id_record">
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
            <input type="hidden"  id="id_record" name="id_record">
            <input type="hidden"  id="" name="status_sampel" value="4">
            <input type="hidden"  id="" name="tahap" value="3">
            <div class="form-group">
            <label for="negara">Nomor Sampel</label> 
       
            <input type="text" class="form-control" id="no_sampel" name="no_sampel" required="required" >
             
            </div>
            <!-- <div class="form-group">
            <label for="negara">Hasil</label> 
       
            <input type="text" class="form-control" id="hasil" name="hasil" required="required" >
             
            </div> -->
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
   $('#balasan_sampel').addClass('active');
  var id_instansi = `<?=$this->session->userdata('id_instansi')?>`;
  console.log(id_instansi)


  if(sessionData['id_role'] != 2){
    // info.edit_info_btn.hide();
    // info.request_btn.hide();
  }

    $('#request_btn').on('click', function(){
        requestModal.self.modal('show');
        // requestModal.id_pasien.val(dataInfo['ID']);
        // requestModal.jenis_request.val(dataInfo['jenis_request']);
    });

    var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [],
    deferRender: true,
    "order": [[ 0, "desc" ]]
  });


  var requestModal = {
    self: $('#request_modal'),
    form: $('#request_form'),
    id_record: $('#request_modal').find('#id_record'),
    tanggal_pengambilan_sampel: $('#request_modal').find('#tanggal_pengambilan_sampel'),
    instansi: $('#request_modal').find('#instansi'),
    info: $('#request_modal').find('#info'),
    save_btn: $('#request_modal').find('#save'),
  }

  var hasilModal = {
    self: $('#hasil_modal'),
    form: $('#hasil_form'),
    id_record: $('#hasil_modal').find('#id_record'),
    no_sampel: $('#hasil_modal').find('#no_sampel'),
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
      url: `<?php echo site_url('DinkesController/getAllRecord/')?>`, 'type': 'GET',
      data: {instansi : id_instansi, tahap: '4'},
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
      var detailButton = `<button class="edit btn btn-success my-1 mr-sm-2"  data-id='${sampel['id_record']}' ><i class='fa fa-pencil'></i> Atur Jadwal</button>`;
      var hasilButton = `<button class="hasil btn btn-success my-1 mr-sm-2"  data-id='${sampel['id_record']}' ><i class='fa fa-pencil'></i> Hasil </button>`;
   
      var deleteButton = `
        <a class="delete dropdown-item" data-id='${sampel['id_record']}'><i class='fa fa-trash'></i> Hapus sampel</a>
      `;
      var editButton = `
        <a class="edit dropdown-item" data-id='${sampel['id_record']}'><i class='fa fa-pencil'></i> Edit sampel</a>
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
      renderData.push([sampel['nama']+' / '+ sampel['NIK'],sampel['jenis'], sampel['no_sampel'],sampel['tanggal_pengambilan_sampel'],sampel['hasil_labor']]);
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
    requestModal.id_record.val(cur['id_record']);
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
    hasilModal.id_record.val(cur['id_record']);
    hasilModal.no_sampel.val(cur['no_sampel']);
    

  });
  hasilModal.form.on('submit', (ev) => {
    Swal(swalHasilConfigure).then((result) => {
      if(!result.value){ return; }
    ev.preventDefault();
    buttonLoading(hasilModal.save_btn);
    $.ajax({
      url: "<?=site_url('DinkesController/editRecord/')?>",
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
        dataSampel[sampel['id_record']] = sampel;
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
      url: "<?=site_url('DinkesController/editRecord/')?>",
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
        dataSampel[sampel['id_record']] = sampel;
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
  
  function renderJenisSampelSelection(){
      
    requestModal.jenis_request.empty();
    requestModal.jenis_request.append($('<option>', { value: "", text: "-- Pilih Jenis --"}));
    requestModal.jenis_request.append($('<option>', { value: "RAPID", text: "RAPID"}));
    requestModal.jenis_request.append($('<option>', { value: "SWAP", text: "SWAP"}));
    requestModal.instansi.empty();
    requestModal.instansi.append($('<option>', { value: "", text: "-- Pilih Tempat Pengujian Sampel --"}));
    requestModal.instansi.append($('<option>', { value: "1", text: "Klinik"}));
    requestModal.instansi.append($('<option>', { value: "2", text: "Rumah Sakit"}));
    requestModal.instansi.append($('<option>', { value: "3", text: "Bandara"}));
    requestModal.instansi.append($('<option>', { value: "4", text: "Pelabuhan"}));
  }

});
</script>