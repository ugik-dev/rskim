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
                  <th style="width:16%">Kegiatan Renja</th>
                  <th style="width:13%">KPA</th>
                  <th style="width:13%">PPK</th>
                  <th style="width:13%">PPTK</th>
                  <th style="width:13%">Bendahara<br>Kegiatan</th>
                  <th style="width:13%">Bendahara<br>Keuangan</th>
                  <th style="width:13%">Lokasi</th>
                  <th style="width:5%">Action</th>
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
            <h4 class="modal-title">Input Informasi</h4>
            <span class="info"></span>
        </div>
        <div class="modal-body" id="modal-body">              
          <form role="form" id="cascade_form" onsubmit="return false;" type="multipart">
            <input type="hidden" id="id_kegiatan_renja" name="id_kegiatan_renja">
            <h2>Kegiatan <span id="nama_kegiatan_renja"></span></h2>
            <div class="row">
              <div class="col-sm-7">
                <div class="form-group">
                  <label for="list_kpa">Nama / NIP KPA</label> 
                  <input type="text" class="form-control" id="list_kpa" name="list_kpa" placeholder="Tidak ada">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="id_kpa">ID KPA</label> 
                  <input type="text" class="form-control" id="id_kpa" name="id_kpa" placeholder="Tidak ada" readonly>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <img id="foto_kpa" class="rounded img-md">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-7">
                <div class="form-group">
                  <label for="list_ppk">Nama / NIP PPK</label> 
                  <input type="text" class="form-control" id="list_ppk" name="list_ppk" placeholder="Tidak ada">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="id_ppk">ID PPK</label> 
                  <input type="text" class="form-control" id="id_ppk" name="id_ppk" placeholder="Tidak ada" readonly>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <img id="foto_ppk" class="rounded img-md">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-7">
                <div class="form-group">
                  <label for="list_pptk">Nama / NIP PPTK</label> 
                  <input type="text" class="form-control" id="list_pptk" name="list_pptk" placeholder="Tidak ada">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="id_pptk">ID PPTK</label> 
                  <input type="text" class="form-control" id="id_pptk" name="id_pptk" placeholder="Tidak ada" readonly>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <img id="foto_pptk" class="rounded img-md">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-7">
                <div class="form-group">
                  <label for="list_bkeg">Nama / NIP Bendahara Kegiatan</label> 
                  <input type="text" class="form-control" id="list_bkeg" name="list_bkeg" placeholder="Tidak ada">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="id_bkeg">ID BKEG</label> 
                  <input type="text" class="form-control" id="id_bkeg" name="id_bkeg" placeholder="Tidak ada" readonly>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <img id="foto_bkeg" class="rounded img-md">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-7">
                <div class="form-group">
                  <label for="list_bkeu">Nama / NIP KPA</label> 
                  <input type="text" class="form-control" id="list_bkeu" name="list_bkeu" placeholder="Tidak ada">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="id_bkeu">ID BKEU</label> 
                  <input type="text" class="form-control" id="id_bkeu" name="id_bkeu" placeholder="Tidak ada" readonly>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <img id="foto_bkeu" class="rounded img-md">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="lokasi">Lokasi</label> 
              <textarea type="text" id="lokasi" class="form-control" name="lokasi" placeholder="Tidak ada" rows="3"></textarea>
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
<style>
  th { text-align: center; }
  td { font-size: 11px; padding-left: 4px; }
</style>    
<script type="text/javascript">
$(document).ready(function() {
  $('#kegiatan_informasi').addClass('active');

  var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [{ targets: [1, 2, 3, 4, 5, 6, 7], className: 'text-center'}],
    ordering: false,
    paging: false,
    rowsGroup: [0],
  });

  var SSection = {
    'form': $('#showForm'),
    'opd': $('#id_opd'),
    'tahun': $('#tahun'),
    'idProgramRenja': $('#id_program_renja'),
    'showBtn': $('#show_btn')
  }

  var informasiModal = {
    self: $('#informasi_modal'),
    form: $('#cascade_form'),
    id_kegiatan_renja: $('#informasi_modal').find('#id_kegiatan_renja'),
    nama_kegiatan_renja: $('#informasi_modal').find('#nama_kegiatan_renja'),
    list_kpa: $('#informasi_modal').find('#list_kpa'),
    id_kpa: $('#informasi_modal').find('#id_kpa'),
    foto_kpa: $('#informasi_modal').find('#foto_kpa'),
    list_ppk: $('#informasi_modal').find('#list_ppk'),
    id_ppk: $('#informasi_modal').find('#id_ppk'),
    foto_ppk: $('#informasi_modal').find('#foto_ppk'),
    list_pptk: $('#informasi_modal').find('#list_pptk'),
    id_pptk: $('#informasi_modal').find('#id_pptk'),
    foto_pptk: $('#informasi_modal').find('#foto_pptk'),
    list_bkeg: $('#informasi_modal').find('#list_bkeg'),
    id_bkeg: $('#informasi_modal').find('#id_bkeg'),
    foto_bkeg: $('#informasi_modal').find('#foto_bkeg'),
    list_bkeu: $('#informasi_modal').find('#list_bkeu'),
    id_bkeu: $('#informasi_modal').find('#id_bkeu'),
    foto_bkeu: $('#informasi_modal').find('#foto_bkeu'),
    lokasi: $('#informasi_modal').find('#lokasi'),
    info: $('#informasi_modal').find('#info'),
    save_btn: $('#informasi_modal').find('#save'),
  }
  var dataAllOPD = {};
  var dataProgramRenja = {};
  var dataInformasi = {};
  var dataPegawai = {};
  
  SSection.form.on('submit', function(e){
    e.preventDefault();
    buttonLoading(SSection.showBtn)
    $.when(getInformasi()).done(function(){
      renderInformasi(dataInformasi);
    }).then((e) => {
      buttonIdle(SSection.showBtn)
    });
  });

  $.when(getAllOPD(), getPegawai()).done(() => {
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

  function getPegawai(){
    return $.ajax({
      url: `<?php echo site_url('PegawaiController/getAllOption/')?>`,
      data : SSection.form.serialize(),
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataPegawai = json['data'];
        renderPegawai(dataPegawai, informasiModal.list_kpa, informasiModal.id_kpa, informasiModal.foto_kpa);
        renderPegawai(dataPegawai, informasiModal.list_ppk, informasiModal.id_ppk, informasiModal.foto_ppk);
        renderPegawai(dataPegawai, informasiModal.list_pptk, informasiModal.id_pptk, informasiModal.foto_pptk);
        renderPegawai(dataPegawai, informasiModal.list_bkeg, informasiModal.id_bkeg, informasiModal.foto_bkeg);
        renderPegawai(dataPegawai, informasiModal.list_bkeu, informasiModal.id_bkeu, informasiModal.foto_bkeu);
      },
      error: function(e) {}, 
    });
  }

  function renderPegawai(data, listContainer = informasiModal.list_kpa, idContainer = informasiModal.id_kpa, fotoContainer){
    if(data == null || typeof data != "object") return;
    listContainer.typeahead({ 
      source: Object.values(data).map((e) => {
        return `${e['nama_pegawai']} (${e['nip_pegawai']}) -- ${e['id_pegawai']}`;
      }),
      afterSelect: function(data){
        var id = data.split(" -- ")[1];
        var pegawai = dataPegawai[id];
        idContainer.val(pegawai['id_pegawai']);
        fotoContainer.attr('src', pegawai['foto_pegawai']);
      }
    });
    listContainer.on('blur', function(e){
      if(empty(listContainer.val())) {
        idContainer.val('');
        fotoContainer.attr('src', null);
      }
    });
  }

  function getInformasi(){
    return $.ajax({
      url: `<?php echo site_url('KegiatanController/getAllWithInformation/')?>`,
      data : SSection.form.serialize(),
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataInformasi = json['data'];
      },
      error: function(e) {}, 
    });
  }

  function renderInformasi(data){
    if(data == null || typeof data != "object"){
      console.log("Informasi::UNKNOWN DATA");
      return;
    }
    var i = 0;
    
    var renderData = [];
    var counter = 1;
    Object.values(data).forEach((info) => {
      var kegiatanRenja = `${info['id_kegiatan_renja']}::${info['nama_kegiatan_renja']}`;
      var kpa = info['id_kpa'] ? `${info['nama_kpa']}<br>${info['nip_kpa']}` : '<span class="text-danger">Tidak ada</span>';
      var ppk = info['id_ppk'] ? `${info['nama_ppk']}<br>${info['nip_ppk']}` : '<span class="text-danger">Tidak ada</span>';
      var pptk = info['id_pptk'] ? `${info['nama_pptk']}<br>${info['nip_pptk']}` : '<span class="text-danger">Tidak ada</span>';
      var bkeg = info['id_bkeg'] ? `${info['nama_bkeg']}<br>${info['nip_bkeg']}` : '<span class="text-danger">Tidak ada</span>';
      var bkeu = info['id_bkeu'] ? `${info['nama_bkeu']}<br>${info['nip_bkeu']}` : '<span class="text-danger">Tidak ada</span>';
      var lokasi = info['lokasi'] ? `${info['lokasi']}` : '<span class="text-danger">Tidak ada</span>';
      var inputInformasiBtn = `
        <button class="input_information btn btn-success my-1 mr-sm-2" data-id='${info['id_kegiatan_renja']}'><i class='fa fa-edit'></i></button>
      `;
      renderData.push([kegiatanRenja, kpa, ppk, pptk, bkeg, bkeu, lokasi, inputInformasiBtn]);
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
  }
  
  FDataTable.on('click', '.input_information', function(){
    informasiModal.self.modal('show');
    var id = $(this).data('id');
    var info = dataInformasi[id];
    informasiModal.id_kegiatan_renja.val(info['id_kegiatan_renja']);
    informasiModal.nama_kegiatan_renja.html(info['nama_kegiatan_renja']);

    informasiModal.list_kpa.val(info['id_kpa'] ? `${info['nama_kpa']} (${info['nip_kpa']}) -- ${info['id_kpa']}` : '');
    informasiModal.id_kpa.val(info['id_kpa'] ? info['id_kpa'] : '');
    informasiModal.foto_kpa.attr("src", info['id_kpa'] ? info['foto_kpa'] : null);

    informasiModal.list_ppk.val(info['id_ppk'] ? `${info['nama_ppk']} (${info['nip_ppk']}) -- ${info['id_ppk']}` : '');
    informasiModal.id_ppk.val(info['id_ppk'] ? info['id_ppk'] : '');
    informasiModal.foto_ppk.attr("src", info['id_ppk'] ? info['foto_ppk'] : null);

    informasiModal.list_pptk.val(info['id_pptk'] ? `${info['nama_pptk']} (${info['nip_pptk']}) -- ${info['id_pptk']}` : '');
    informasiModal.id_pptk.val(info['id_pptk'] ? info['id_pptk'] : '');
    informasiModal.foto_pptk.attr("src", info['id_pptk'] ? info['foto_pptk'] : null);
    
    informasiModal.list_bkeg.val(info['id_bkeg'] ? `${info['nama_bkeg']} (${info['nip_bkeg']}) -- ${info['id_bkeg']}` : '');
    informasiModal.id_bkeg.val(info['id_bkeg'] ? info['id_bkeg'] : '');
    informasiModal.foto_bkeg.attr("src", info['id_bkeg'] ? info['foto_bkeg'] : null);

    informasiModal.list_bkeu.val(info['id_bkeu'] ? `${info['nama_bkeu']} (${info['nip_bkeu']}) -- ${info['id_bkeu']}` : '');
    informasiModal.id_bkeu.val(info['id_bkeu'] ? info['id_bkeu'] : '');
    informasiModal.foto_bkeu.attr("src", info['id_bkeu'] ? info['foto_bkeu'] : null);
    
    informasiModal.lokasi.val(info['lokasi']);
  });

  informasiModal.form.on('submit', (ev) => {
    ev.preventDefault();
    buttonLoading(informasiModal.save_btn);
    $.ajax({
      url: "<?=site_url('KegiatanController/setInformation')?>",
      type: "POST",
      data: informasiModal.form.serialize(),
      success: (data) => {
        buttonIdle(informasiModal.save_btn);
        json = JSON.parse(data);
        if(json['error']){
          swal("Ganti Program Renja gagal", json['message'], "error");
          return;
        } 
        var info = json['data'];
        dataInformasi[informasiModal.id_kegiatan_renja.val()] = info;
        renderInformasi(dataInformasi);
        swal("Berhasil disimpan", 'Input Informasi Berhasil', "success");
        informasiModal.self.modal('hide');
      },
      error: () => {
        buttonIdle(informasiModal.save_btn);
      },
    });
  });

});
</script>
