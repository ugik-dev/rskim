<div class="wrapper wrapper-content animated fadeInRight">
  <div class="ibox ssection-container">
    <div class="ibox-content">
      <form class="form-inline" id="showForm" onsubmit="return false;">
        <select class="form-control mr-sm-2" name="id_opd" id="id_opd" <?=!$this->session->userdata("admin_opd") ? "readonly='readonly'" : ''?> style="width:400px"></select>
        <select class="form-control mr-sm-2" name="tahun" id="tahun" required="required">
          <option value>-- Pilih Periode --</option>
          <option value='2020'>2020</option>
          <option value='2019'>2019</option>
          <option value='2018'>2018</option>
          <option value='2017'>2017</option>
        </select>  
        <select class="form-control mr-sm-2" name="id_program_renja" id="id_program_renja" style="width:400px"></select>
        <button type="submit" class="btn btn-success my-1 mr-sm-2" id="show_btn" data-loading-text="Loading..." disabled="disabled"><i class="fal fa-eye"></i> Tampilkan</button>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <div class="table-responsive">
            <table id="FDataTable" class="table table-bordered" style="padding:0px">
              <thead>
                <tr>
                  <th style="width:21%" rowspan="2">Kegiatan Renja</th>
                  <th style="width:23%" colspan="2">Target Bulan Sebelumnya</th>
                  <th style="width:23%" colspan="2">Realisasi Saat ini</th>
                  <th style="width:23%" colspan="2">Capaian Saat ini</th>
                  <th style="width:5%" rowspan="2">Jml<br>Monev</th>
                  <th style="width:5%" rowspan="2">Action</th>
                </tr>
                <tr>
                  <th>Keuangan(%)</th>
                  <th>Fisik(%)</th>
                  <th>Keuangan(%)</th>
                  <th>Fisik(%)</th>
                  <th>Keuangan(%)</th>
                  <th>Fisik(%)</th>
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

<div class="modal inmodal" id="kegiatan_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Kelola Monev</h4>
            <span class="info"></span>
        </div>
        <div class="modal-body" id="modal-body"> 
          <input type="hidden" id="id_kegiatan_renja" name="id_kegiatan_renja">
          <div id="kegiatan_container"></div>
          <h3>Monitoring dan Evaluasi</h3>
          <div id="monev_container"></div>
          <button class="add btn btn-success my-1 mr-sm-2" id="add_btn"><strong><i class='fa fa-plus'></i>Tambah Monev</strong></button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

<div class="modal inmodal" id="monev_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Kelola Monev</h4>
            <span class="info"></span>
        </div>
        <div class="modal-body" id="modal-body">              
          <form role="form" id="cascade_form" onsubmit="return false;" type="multipart">
            <input type="hidden" id="id_kegiatan_renja" name="id_kegiatan_renja">
            <input type="hidden" id="id_kegiatan_monev" name="id_kegiatan_monev">
            <h2>Kegiatan <span id="nama_kegiatan_renja"></span></h2>
            <div class="row">
              <div class="col-sm-7">
                <div class="form-group">
                  <label for="pemeriksa">Pemeriksa</label> 
                  <input type="text" class="form-control" id="pemeriksa" name="pemeriksa" placeholder="Tidak ada" required="required">
                </div>
              </div>
              <div class="col-sm-5">
                <div class="form-group">
                  <label for="tanggal">Tanggal</label> 
                  <div class="input-group date" id="tanggal_container">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" id="tanggal" name="tanggal" required="required">
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="kendala">Kendala</label> 
              <textarea type="text" id="kendala" class="form-control" name="kendala" placeholder="Tidak ada" rows="3" required="required"></textarea>
            </div>
            <div class="form-group">
              <label for="keterangan">Keterangan</label> 
              <textarea type="text" id="keterangan" class="form-control" name="keterangan" placeholder="Tidak ada" rows="3" required="required"></textarea>
            </div>
            <div class="form-group">
              <label for="add_attachment">Attachment</label>
              <div id="kma_container"></div>
            </div>
            <button class="btn btn-success my-1 mr-sm-2" type="submit" id="add_btn" data-loading-text="Loading..."><strong>Tambah Data</strong></button>
            <button class="btn btn-success my-1 mr-sm-2" type="submit" id="save_edit_btn" data-loading-text="Loading..."><strong>Simpan Perubahan</strong></button>
          
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
<script src="<?=base_url('assets/')?>js/FileUploaderV2.js"></script>
<style>
  th { font-size: 11px; text-align: center; }
  td { font-size: 11px; padding-left: 4px; }
  h2 { margin-top: 10px; margin-bottom: 20px; }
  .ppj-thumbnail { margin-right: 6px; float:left }
</style>    
<script type="text/javascript">
$(document).ready(function() {
  $('#monev').addClass('active');

  var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [{ targets: [1, 2, 3, 4, 5, 6, 7, 8], className: 'text-center'}],
    paging: false,
    // rowsGroup: [0],
  });

  var SSection = {
    'form': $('#showForm'),
    'opd': $('#id_opd'),
    'tahun': $('#tahun'),
    'idProgramRenja': $('#id_program_renja'),
    'showBtn': $('#show_btn')
  }

  var kegiatanModal = {
    self: $('#kegiatan_modal'),
    id_kegiatan_renja: $('#kegiatan_modal').find('#id_kegiatan_renja'),
    kegiatan_container: $('#kegiatan_modal').find('#kegiatan_container'),
    monev_container: $('#kegiatan_modal').find('#monev_container'),
    add_btn: $('#kegiatan_modal').find('#add_btn'),
  }

  var monevModal = {
    self: $('#monev_modal'),
    form: $('#cascade_form'),
    id_kegiatan_renja: $('#monev_modal').find('#id_kegiatan_renja'),
    id_kegiatan_monev: $('#monev_modal').find('#id_kegiatan_monev'),
    nama_kegiatan_renja: $('#monev_modal').find('#nama_kegiatan_renja'),
    pemeriksa: $('#monev_modal').find('#pemeriksa'),
    tanggal: $('#monev_modal').find('#tanggal'),
    kendala: $('#monev_modal').find('#kendala'),
    keterangan: $('#monev_modal').find('#keterangan'),
    kma_attachment: null,
    'addBtn': $('#monev_modal').find('#add_btn'),
    'saveEditBtn': $('#monev_modal').find('#save_edit_btn'),
  }

  monevModal.kma_attachment = new FileUploaderV2($('#kma_container'), {'add': "<?=site_url('KegiatanMonevController/addAttachment')?>", 'delete': "<?=site_url('KegiatanMonevController/deleteAttachment')?>"}, 'id_kegiatan_monev_attachment', monevModal),

  $('#tanggal_container').datepicker({                
    todayBtn: "linked",
    autoclose: true,
    format: "yyyy-mm-dd"
  });
          
  var dataAllOPD = {};
  var dataProgramRenja = {};
  var dataMonev = {};
  var dataPegawai = {};
  
  SSection.form.on('submit', function(e){
    e.preventDefault();
    buttonLoading(SSection.showBtn)
    $.when(getMonev()).done(function(){
      renderMonev(dataMonev);
    }).then((e) => {
      buttonIdle(SSection.showBtn)
    });
  });

  $.when(getAllOPD()).done(() => {
    SSection.showBtn.prop('disabled', false);
  })

  function getAllOPD(){
    return $.ajax({
      url: "<?php echo site_url('SharedController/getAllSOPD')?>",
      data : {},
      type: 'POST',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataAllOPD = json['data'];
        renderOPD(dataAllOPD, json['curr']);
      },
      error: function(e) {}
    });
  }

  function renderOPD(data, curr){
    SSection.opd.empty();
    SSection.opd.append($('<option>', { value: "", text: "-- SEMUA OPD --"}));
    Object.values(data).forEach((e) => {
      SSection.opd.append($('<option>', {
        value: e['id_opd'],
        text: `${e['id_opd']}::${e['nama_opd']}`,
      }));
    });

    SSection.opd.val(curr);
  }

  SSection.tahun.on('change', function(e){
    getProgramRenja();
  });

  function getProgramRenja(){
    return $.ajax({
      url: `<?php echo site_url('SharedController/getSProgramRenjaOption/')?>`,
      data : SSection.form.serialize(),
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataProgramRenja = json['data'];
        renderProgramRenja(dataProgramRenja);
      },
      error: function(e) {}
    });
  }

  renderProgramRenja({});
  function renderProgramRenja(data){
    SSection.idProgramRenja.empty();
    SSection.idProgramRenja.append($('<option>', { value: "", text: "-- SEMUA PROGRAM --"}));
    Object.values(data).forEach((e) => {
      SSection.idProgramRenja.append($('<option>', {
        value: e['id_program_renja'],
        text: `${e['id_program_renja']} :: ${e['nama_program_renja']}`,
      }));
    });
  }

  function getMonev(){
    return $.ajax({
      url: `<?php echo site_url('KegiatanMonevController/getAll/')?>`,
      data : SSection.form.serialize(),
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataMonev = json['data'];
      },
      error: function(e) {}, 
    });
  }

  function renderMonev(data){
    if(data == null || typeof data != "object"){
      console.log("Informasi::UNKNOWN DATA");
      return;
    }
    var i = 0;
    
    var renderData = [];
    var counter = 1;
    Object.values(data).forEach((info) => {
      var kegiatanRenja = `${info['id_kegiatan_renja']}::${info['nama_kegiatan_renja']}`;
      var jumlah_monev = Object.keys(info['monev']).length;
      var action = `
        <button class="detail btn btn-success my-1 mr-sm-2" data-id='${info['id_kegiatan_renja']}'><i class='fa fa-edit'></i></button>
      `;
      renderData.push([kegiatanRenja, info['target_keuangan'], info['target_fisik'], info['realisasi_keuangan'], info['realisasi_fisik'], info['capaian_keuangan'], info['capaian_fisik'], jumlah_monev, action]);
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
  }
  
  FDataTable.on('click', '.detail', function(){
    var id = $(this).data('id');
    kegiatanModal.id_kegiatan_renja.val(id);
    kegiatanModal.self.modal('show');
  });

  kegiatanModal.self.on('show.bs.modal', function () {
    var monev = dataMonev[kegiatanModal.id_kegiatan_renja.val()];
    kegiatanModal.kegiatan_container.html(`
      <h4>Nama Kegiatan</h4><h2>${monev['id_kegiatan_renja']}::${monev['nama_kegiatan_renja']}</h2>
      <div class="row">
        <div class="col-sm-6"><h4>Keuangan (Target / Realisasi / Capaian)</h4><h2>${monev['target_keuangan']} / ${monev['realisasi_keuangan']} / ${monev['capaian_keuangan']}</h2></div>
        <div class="col-sm-6"><h4>Fisik (Target / Realisasi / Capaian)</h4><h2>${monev['target_fisik']} / ${monev['realisasi_fisik']} / ${monev['capaian_fisik']}</h2></div>
        <div class="col-sm-6"><h4>Kuasa Penganggaran (KPA)</h4>${monev['nama_kpa'] ? `<img src="${monev['foto_kpa'] ? "<?=base_url('/')?>" + monev['foto_kpa'] : ""}" class="rounded img-md ppj-thumbnail">Nama: ${monev['nama_kpa']}<br>NIP: ${monev['nip_kpa']}` : '<h2>Tidak Ada</h2>'}</div>
        <div class="col-sm-6"><h4>Pejabat Pembuat Komitmen (PPK)</h4>${monev['nama_ppk'] ? `<img src="${monev['foto_ppk'] ? "<?=base_url('/')?>" + monev['foto_ppk'] : ""}" class="rounded img-md ppj-thumbnail">Nama: ${monev['nama_ppk']}<br>NIP: ${monev['nip_ppk']}` : '<h2>Tidak Ada</h2>'}</div>
        <div class="col-sm-6"><h4>Pejabat Pelaksana Teknis Kegiatan (PPTK)</h4>${monev['nama_pptk'] ? `<img src="${monev['foto_pptk'] ? "<?=base_url('/')?>" + monev['foto_pptk'] : ""}" class="rounded img-md ppj-thumbnail">Nama: ${monev['nama_pptk']}<br>NIP: ${monev['nip_pptk']}` : '<h2>Tidak Ada</h2>'}</div>
        <div class="col-sm-6"><h4>Bendahara Kegiatan</h4>${monev['nama_bkeg'] ? `<img src="${monev['foto_bkeg'] ? "<?=base_url('/')?>" + monev['foto_bkeg'] : ""}" class="rounded img-md ppj-thumbnail">Nama: ${monev['nama_bkeg']}<br>NIP: ${monev['nip_bkeg']}` : '<h2>Tidak Ada</h2>'}</div>
        <div class="col-sm-6"><h4>Bendahara Keuangan</h4>${monev['nama_bkeu'] ? `<img src="${monev['foto_bkeu'] ? "<?=base_url('/')?>" + monev['foto_bkeu'] : ""}" class="rounded img-md ppj-thumbnail">Nama: ${monev['nama_bkeu']}<br>NIP: ${monev['nip_bkeu']}` : '<h2>Tidak Ada</h2>'}</div>
      </div>
      
    `);
    var counter = 1;
    kegiatanModal.monev_container.empty();
    Object.values(monev['monev']).forEach((e) => {
      var editButton = `
        <a class="edit_monev dropdown-item" data-id='${e['id_kegiatan_monev']}'><i class='fa fa-pencil'></i> Edit Monev</a>
      `;
      var deleteButton = `
        <a class="delete_monev dropdown-item" data-id='${e['id_kegiatan_monev']}'><i class='fa fa-trash'></i> Hapus Monev</a>
      `;
      var button = `
        <div class="btn-group" role="group">
          <button id="action" type="button" class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='fa fa-bars'></i></button>
          <div class="dropdown-menu" aria-labelledby="action">
            ${editButton}
            ${deleteButton}
          </div>
        </div>
      `;
      kegiatanModal.monev_container.append(`
        <div class="panel panel-default">
          <div class="panel-heading">Monev #${counter++}<span style="float: right;">${button}</span></div>
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-6"><h4>Tanggal</h4><p>${e['tanggal']}</p></div>
                <div class="col-sm-6"><h4>Pemeriksa</h4><p>${e['pemeriksa']}</p></div>
              </div>
              <h4>Kendala</h4><p>${e['kendala']}</p>
              <h4>Keterangan</h4><p>${e['keterangan']}</p>
              <h4>Attachment</h4><div id="kma_container_${e['id_kegiatan_monev']}"></div>
            </div>
          </div>
        </div>
      `);
      var kma_attachment = new FileUploaderV2($(`#kma_container_${e['id_kegiatan_monev']}`), {'add': "", 'delete': ""}, 'id_kegiatan_monev_attachment', monevModal);
      kma_attachment.updateAttachment(e['attachment'], true);
    });

    kegiatanModal.monev_container.find('.edit_monev').unbind('click').on('click', (e) => {
      var idp = kegiatanModal.id_kegiatan_renja.val();
      var id = $(e.target).data('id');
      showMonevEditModal(idp, id);
    });
    kegiatanModal.monev_container.find('.delete_monev').unbind('click').on('click', (e) => {
      var idp = kegiatanModal.id_kegiatan_renja.val();
      var id = $(e.target).data('id');
      deleteMonev(idp, id);
    });
    if(Object.keys(monev['monev']).length == 0) kegiatanModal.monev_container.html('<h2>Tidak Ada</h2>');
  });

  kegiatanModal.add_btn.on('click', (e) => {
    kegiatanModal.self.modal("hide");
    var id = kegiatanModal.id_kegiatan_renja.val();
    monevModal.id_kegiatan_renja.val(id);
    var currentData = dataMonev[id];
    monevModal.nama_kegiatan_renja.html(currentData['nama_kegiatan_renja']);
    monevModal.kma_attachment.updateAttachment([]);
    monevModal.addBtn.show();
    monevModal.saveEditBtn.hide();
    monevModal.self.modal("show");
  });

  function showMonevEditModal(idp, id){
    var currentData = dataMonev[idp]['monev'][id];
    monevModal.id_kegiatan_renja.val(idp);
    monevModal.id_kegiatan_monev.val(id);
    monevModal.pemeriksa.val(currentData['pemeriksa']);
    monevModal.tanggal.val(currentData['tanggal']);
    monevModal.kendala.val(currentData['kendala']);
    monevModal.keterangan.val(currentData['keterangan']);
    monevModal.kma_attachment.updateAttachment(currentData['attachment']);
    monevModal.addBtn.hide();
    monevModal.saveEditBtn.show();
    kegiatanModal.self.modal('hide');
    monevModal.self.modal("show");
  }

  monevModal.self.on('hidden.bs.modal', function () {
    monevModal.form.trigger('reset'); 
    kegiatanModal.self.modal("show");
  })
  
  monevModal.form.submit(function(event) {
    event.preventDefault();
    var isAdd = monevModal.addBtn.is(':visible');
    var url = "<?=site_url('KegiatanMonevController/')?>";
    url += isAdd ? "add" : "edit";
    var button = isAdd ? monevModal.addBtn : monevModal.saveEditBtn;

    swal(SWALSAVE).then((result) => {
      if(!result.value){ return; }
      buttonLoading(button);
      $.ajax({
        url: url, 'type': 'POST',
        data: monevModal.form.serialize(),
        success: function (data){
          buttonIdle(button);
          var json = JSON.parse(data);
          if(json['error']){
            swal("Simpan Gagal", json['message'], "error");
            return;
          }
          var monev = json['data']
          dataMonev[monev['id_kegiatan_renja']] = monev;
          swal("Simpan Berhasil", "", "success");
          renderMonev(dataMonev);
          monevModal.self.modal('hide');
        },
        error: function(e) {}
      });
    });
  });

  function deleteMonev(idp, id){
    swal(SWALDELETE).then((result) => {
      if(!result.value){ return; }
      $.ajax({
        url: "<?=site_url('KegiatanMonevController/delete')?>", 'type': 'POST',
        data: {id_kegiatan_monev: id},
        success: function (data){
          var json = JSON.parse(data);
          if(json['error']){
            swal("Delete Gagal", json['message'], "error");
            return;
          }
          delete dataMonev[idp]['monev'][id];
          swal("Delete Berhasil", "", "success");
          renderMonev(dataMonev);
          kegiatanModal.self.trigger('show.bs.modal');
        },
        error: function(e) {}
      });
    });
  }
});
</script>
