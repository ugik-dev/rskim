<div class="wrapper wrapper-content animated fadeInRight" id="info_container">
    <div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">
                <button class="btn btn-success my-1 mr-sm-2" id="add_kontak_btn"><i class='fa fa-plus'></i> Tambah Data</button>

                <h5>Silahkan tambah data, jika dalam 14 hari sebelum anda sakit pernah melakukan kontak atau paparan dengan orang yang sakit saluran pernapasan seperti (Demam, batuk dan pneumonia) </h5>
                
            </div>
        </div>
        </div>
    </div>


      <div class="ibox">
        <div class="ibox-content">
          <h5>Riwayat Cek</h5>
          <div class="table-responsive">
            <table id="FDataTable" class="table table-bordered table-hover" style="padding:0px">
              <thead>
                <tr>
                
                  <th style="width: 12%; text-align:center!important">Nama</th>
                  <th style="width: 12%; text-align:center!important">Alamat</th>
                  <th style="width: 12%; text-align:center!important">Hubungan</th>
                  <th style="width: 12%; text-align:center!important">Peunomia Berat</th>
                  <th style="width: 12%; text-align:center!important">Gejala Sama</th>
                  <th style="width: 12%; text-align:center!important">Tanggal Mulai</th>
                  
                  <th style="width: 16%; text-align:center!important">Tanggal Pulang</th>
                  <th style="width: 16%; text-align:center!important">Action</th>
                  
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div> 


<div class="modal inmodal" id="kontak_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Form Riwayat Perjalanan</h4>
            <span class="info"></span>
        </div>
        <div class="modal-body" id="modal-body">              
          <form role="form" id="kontak_form" onsubmit="return false;" type="multipart">
            <!-- <input type="hidden" id="NO" name="NO"> -->
            <input type="hidden"  id="id_pasien" name="id_pasien">
            <input type="hidden"  id="id_data_kontak" name="id_data_kontak">
         
            <div class="form-group">
                  <label for="nama">Nama</label> 
                  <input type="text" class="form-control" id="nama" name="nama" required="required" >
            </div>
            <div class="form-group">
            <label for="alamat">Alamat</label> 
            <textarea rows="2" type="text" class="form-control" id="alamat" name="alamat" required="required"></textarea>
              </div>
              <div class="form-group">
                  <label for="nama">Hubungan</label> 
                  <input type="text" class="form-control" id="hubungan" name="hubungan" required="required" >
            </div>
            <div class="form-group">
                <label for="terdata">Peunomia Berat ?</label> 
                <select class="form-control mr-sm-2" id="pneunomia_berat" name="pneunomia_berat" required="required">
                </select>
            </div>
     
          <div class="form-group">
            <label for="terdata">Gejala Sama dengan anda ?</label> 
            <select class="form-control mr-sm-2" id="sakit_sama" name="sakit_sama" required="required">
            </select>
          </div>
            <div class="form-group">
            <label for="nama">Tanggal Kontak Pertama</label> 
            <input type="date" class="form-control" id="tanggal_pertama" name="tanggal_pertama" required="required" >
  
            </div>
            <div class="form-group">
            <label for="nama">Tanggal Kontak Terakhir</label> 
            <input type="date" class="form-control" id="tanggal_terakhir" name="tanggal_terakhir" required="required" >
  
            </div>
            <button class="btn btn-success my-1 mr-sm-2" type="submit" id="save" data-loading-text="Loading..." onclick="this.form.target='add'"><strong>Tambah</strong></button>
            <button class="btn btn-success my-1 mr-sm-2" type="submit" id="edit" data-loading-text="Loading..." onclick="this.form.target='edit'"><strong>Ubah</strong></button>
       
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
   $('#kontak').addClass('active');
  var id_pasien = `<?=$this->session->userdata('id_sub')?>`;
  console.log(id_pasien)


  if(sessionData['id_role'] != 2){
    // info.edit_info_btn.hide();
    // info.add_kontak_btn.hide();
  }

    $('#add_kontak_btn').on('click', function(){
        kontakModal.form.trigger('reset');
        kontakModal.self.modal('show');
        kontakModal.save_btn.show()
        kontakModal.edit_btn.hide()
        kontakModal.id_pasien.val(id_pasien);
        // kontakModal.jenis_request.val(dataInfo['jenis_request']);
    });

  var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [{ targets: [0, 3, 4], className: 'text-center'}, ],
    deferRender: true,
    'ordering': false,
    'paging': false,
    'searching': false
  });


  var kontakModal = {
    self: $('#kontak_modal'),
    form: $('#kontak_form'),
    id_data_kontak: $('#kontak_modal').find('#id_data_kontak'),
    id_pasien: $('#kontak_modal').find('#id_pasien'),
    nama: $('#kontak_modal').find('#nama'),
    alamat: $('#kontak_modal').find('#alamat'),
    tanggal_pertama: $('#kontak_modal').find('#tanggal_pertama'),
    tanggal_terakhir: $('#kontak_modal').find('#tanggal_terakhir'),
    pneunomia_berat: $('#kontak_modal').find('#pneunomia_berat'),
    hubungan: $('#kontak_modal').find('#hubungan'),
    sakit_sama: $('#kontak_modal').find('#sakit_sama'),
    info: $('#kontak_modal').find('#info'),
    save_btn: $('#kontak_modal').find('#save'),
    edit_btn: $('#kontak_modal').find('#edit'),
  }
  kontakModal.id_pasien.val(id_pasien);
  
  renderOption()
  var dataInfo = {};
  var dataKontak = {};
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
    title: "Konfirmasi Tambah Data",
    text: "Yakin akan tambah data?",
    type: "info",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya!",
  };

    
  var swalEditConfigure = {
    title: "Konfirmasi Ubah Data",
    text: "Yakin akan ubah data?",
    type: "info",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya!",
  };

  getAllKontak();  
  function getAllKontak(){
    return $.ajax({
      url: `<?php echo site_url('PasienController/getAllKontak/')?>`, 'type': 'GET',
      data: {id_pasien : id_pasien},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataKontak = json['data'];
        renderKontak(dataKontak);
      },
      error: function(e) {}
    });
  }

function convStatus(status){
  // var realisasi = parseFloat(realisasi);
  if(status == '1')
     return `Request`;
  else if (status == '2')
    return `Terjadwal`;
  else if (status == '3')
    return `Menunggu Hasil`;
  else if (status == '4')
    return `Final`;
  return `Tidak Diketahui`;  
}


  function renderKontak(data){
    if(data == null || typeof data != "object"){
      console.log("User::UNKNOWN DATA");
      return;
    }
    var i = 0;
    
    var renderData = [];
    Object.values(data).forEach((kontak) => {
      var detailButton = `<a class="btn btn-success" href="<?=site_url("DinkesController/Detailkontak/")?>?id_data_kontak=${kontak['id_data_kontak']}" class="dropdown-item"><i class='fa fa-pencil'></i> Detail Info </a>`;
    
      var deleteButton = `
        <a class="delete dropdown-item" data-id='${kontak['id_data_kontak']}'><i class='fa fa-trash'></i> Hapus kontak</a>
      `;
      var editButton = `
        <a class="edit dropdown-item" data-id='${kontak['id_data_kontak']}'><i class='fa fa-pencil'></i> Edit kontak</a>
      `;
      var button = `
        <div class="btn-group" opd="group">
          <button id="action" type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='fa fa-bars'></i></button>
          <div class="dropdown-menu" aria-labelledby="action">
            ${editButton}
            ${deleteButton}
          </div>
        </div>
      `;
    //   var no_hp = kontak['no_hp_tim'] ? kontak['no_hp_tim'] : 'Tidak Ada';
    //   var photo = kontak['photo_tim'] ? `<img src="<?=base_url('uploads/photo/')?>${kontak['photo_tim']}" class="img-sm">` : 'Tidak Ada';
      renderData.push([kontak['nama'], kontak['alamat'],  kontak['hubungan'], kontak['pneunomia_berat'],kontak['sakit_sama'],kontak['tanggal_pertama'],kontak['tanggal_terakhir'],button]);
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
  }

  kontakModal.form.submit(function(event){
    event.preventDefault();
    switch(kontakModal.form[0].target){
      case 'add':
        addKontak();
        break;
      case 'edit':
        editKontak();
        break;
    }
  });
  function addKontak(){
    Swal(swalRequestConfigure).then((result) => {
      if(!result.value){ return; }
    buttonLoading(kontakModal.save_btn);
    $.ajax({
      url: "<?=site_url('PasienController/addKontak/')?>",
      type: "POST",
      data: kontakModal.form.serialize(),
      success: (data) => {
        buttonIdle(kontakModal.save_btn);
        json = JSON.parse(data);
        if(json['error']){
          swal("Request Gagal", json['message'], "error");
          return;
        } 
        kontak = json['data'];
        // console.log(dataKontak)
        dataKontak[kontak['id_data_kontak']] = kontak;
        renderKontak(dataKontak);
        swal("Berhasil Request", 'Harap Tunggu Informasi Penjadwalan', "success");
        kontakModal.self.modal('hide');
      },
      error: () => {
        buttonIdle(kontakModal.save_btn);
      },
    });
    });
  }

  function editKontak(){
    Swal(swalEditConfigure).then((result) => {
      if(!result.value){ return; }
    
    buttonLoading(kontakModal.edit_btn);
    $.ajax({
      url: "<?=site_url('PasienController/editKontak/')?>",
      type: "POST",
      data: kontakModal.form.serialize(),
      success: (data) => {
        buttonIdle(kontakModal.edit_btn);
        json = JSON.parse(data);
        if(json['error']){
          swal("Request Gagal", json['message'], "error");
          return;
        } 
        kontak = json['data'];
        // console.log(dataKontak)
        dataKontak[kontak['id_data_kontak']] = kontak;
        renderKontak(dataKontak);
        swal("Berhasil Request", 'Harap Tunggu Informasi Penjadwalan', "success");
        kontakModal.self.modal('hide');
      },
      error: () => {
        buttonIdle(kontakModal.edit_btn);
      },
    });
    });
  }

  FDataTable.on('click','.edit', function(){
    kontakModal.form.trigger('reset');
    kontakModal.self.modal('show');
    kontakModal.id_pasien.val(id_pasien);
    kontakModal.edit_btn.show();
    kontakModal.save_btn.hide();
    var id = $(this).data('id');
    var current = dataKontak[id];
    console.log(current);
    kontakModal.id_data_kontak.val(current['id_data_kontak']);
    kontakModal.nama.val(current['nama']);
    kontakModal.alamat.val(current['alamat']);
    kontakModal.tanggal_pertama.val(current['tanggal_pertama']);
    kontakModal.tanggal_terakhir.val(current['tanggal_terakhir']);
    kontakModal.hubungan.val(current['hubungan']);
    kontakModal.pneunomia_berat.val(current['pneunomia_berat']);
    kontakModal.sakit_sama.val(current['sakit_sama']);
    // var datecur = current['tanggal_record']
    // var res = datecur.substr(0,10);
    // var res2 = datecur.substr(11,5);
    // console.log(res+'T'+res2)
    // recordModal.tanggal_record.val(res+'T'+res2);

  });

  FDataTable.on('click','.delete', function(){
    event.preventDefault();
    var id = $(this).data('id');
    swal(swalDeleteConfigure).then((result) => {
      if(!result.value){ return; }
      $.ajax({
        url: "<?=site_url('PasienController/deleteKontak')?>", 'type': 'POST',
        data: {'id_data_kontak': id},
        success: function (data){
          var json = JSON.parse(data);
          if(json['error']){
            swal("Delete Gagal", json['message'], "error");
            return;
          }
          delete dataKontak[id];
          swal("Delete Berhasil", "", "success");
          renderKontak(dataKontak);
        },
        error: function(e) {}
      });
    });
  });
  
  function renderOption(){
    kontakModal.pneunomia_berat.empty();
    kontakModal.pneunomia_berat.append($('<option>', { value: "", text: "--Pilih--"}));
    kontakModal.pneunomia_berat.append($('<option>', { value: "Ya", text: "Ya"}));
    kontakModal.pneunomia_berat.append($('<option>', { value: "Tidak", text: "Tidak"}));

    kontakModal.sakit_sama.empty();
    kontakModal.sakit_sama.append($('<option>', { value: "", text: "--Pilih--"}));
    kontakModal.sakit_sama.append($('<option>', { value: "Ya", text: "Ya"}));
    kontakModal.sakit_sama.append($('<option>', { value: "Tidak", text: "Tidak"}));
    
  }

});
</script>