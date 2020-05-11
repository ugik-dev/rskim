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
                  <th rowspan="2">Kegiatan Renja</th>
                  <th colspan="12">Bulan</th>
                  <th rowspan="2">Action</th>
                </tr>
                <tr>
                  <th>Jan</th>
                  <th>Feb</th>
                  <th>Mar</th>
                  <th>Apr</th>
                  <th>Mei</th>
                  <th>Jun</th>
                  <th>Jul</th>
                  <th>Agu</th>
                  <th>Sep</th>
                  <th>Okt</th>
                  <th>Nov</th>
                  <th>Des</th>
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

<div class="modal inmodal" id="fisik_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Input Fisik</h4>
            <span class="info"></span>
        </div>
        <div class="modal-body" id="modal-body">              
          <form role="form" id="cascade_form" onsubmit="return false;" type="multipart">
            <input type="hidden" id="id_kegiatan_renja" name="id_kegiatan_renja">
            Kegiatan Renja : <span id="nama_kegiatan_renja"></span>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="bulan">Bulan</label> 
                  <select class="form-control mr-sm-2" name="bulan" id="bulan" required="required"></select>
                </div>
              </div>
              <div class="col-sm">
                <div class="form-group">
                  <label for="fisik">Realisasi</label> 
                  <input type="number" step="0.01" min="0" max="100" class="form-control" id="fisik" name="fisik" required="required">
                </div>
              </div>
              <div class="col-sm">
                <div class="form-group">
                  <label for="target">Target</label> 
                  <input type="number" step="0.01" min="0" max="100" class="form-control" id="target" name="target" required="required">
                </div>
              </div>
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
  $('#fisik').addClass('active');

  var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [{ targets: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13], className: 'text-center'}],
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

  var fisikModal = {
    self: $('#fisik_modal'),
    form: $('#cascade_form'),
    id_kegiatan_renja: $('#fisik_modal').find('#id_kegiatan_renja'),
    nama_kegiatan_renja: $('#fisik_modal').find('#nama_kegiatan_renja'),
    bulan: $('#fisik_modal').find('#bulan'),
    target: $('#fisik_modal').find('#target'),
    fisik: $('#fisik_modal').find('#fisik'),
    save_btn: $('#fisik_modal').find('#save'),
  }
  var dataAllOPD = {};
  var dataProgramRenja = {};
  var dataFisik = {};
  var dataBulan = {};

  SSection.form.on('submit', function(e){
    e.preventDefault();
    buttonLoading(SSection.showBtn)
    $.when(getFisik()).done(function(){
      renderFisik(dataFisik);
    }).then((e) => {
      buttonIdle(SSection.showBtn)
    });
  });

  $.when(getAllOPD(), getBulan()).done(() => {
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

  function getBulan(){
    return $.ajax({
      url: "<?php echo site_url('SharedController/getBulanOption')?>",
      data : {},
      type: 'POST',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataBulan = json['data'];
        renderBulan(dataBulan);
      },
      error: function(e) {}
    });
  }

  function renderBulan(data){
    fisikModal.bulan.empty();
    fisikModal.bulan.append($('<option>', { value: "", text: "-- PILIH BULAN --"}));
    Object.values(data).forEach((e) => {
      fisikModal.bulan.append($('<option>', {
        value: e['id_bulan'],
        text: `${e['id_bulan']}::${e['nama_bulan']}`,
      }));
    });
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


  function getFisik(){
    return $.ajax({
      url: `<?php echo site_url('FisikController/getAll/')?>`,
      data : SSection.form.serialize(),
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataFisik = json['data'];
      },
      error: function(e) {}, 
    });
  }

  function renderFisik(data){
    if(data == null || typeof data != "object"){
      console.log("Fisik::UNKNOWN DATA");
      return;
    }
    var i = 0;
    
    var renderData = [];
    var counter = 1;
    Object.values(data).forEach((fisik) => {
      var kegiatanRenja = `${fisik['id_kegiatan_renja']}::${fisik['nama_kegiatan_renja']}`;
      var inputFisikBtn = `
        <button class="input_fisik btn btn-success my-1 mr-sm-2" data-id='${fisik['id_kegiatan_renja']}'><i class='fa fa-edit'></i></button>
      `;
      renderData.push([kegiatanRenja, `${fisik['fisik_1']}%<br>(${fisik['target_1']}%)`, `${fisik['fisik_2']}%<br>(${fisik['target_2']}%)`, `${fisik['fisik_3']}%<br>(${fisik['target_3']}%)`, `${fisik['fisik_4']}%<br>(${fisik['target_4']}%)`, `${fisik['fisik_5']}%<br>(${fisik['target_5']}%)`, `${fisik['fisik_6']}%<br>(${fisik['target_6']}%)`, `${fisik['fisik_7']}%<br>(${fisik['target_7']}%)`, `${fisik['fisik_8']}%<br>(${fisik['target_8']}%)`, `${fisik['fisik_9']}%<br>(${fisik['target_9']}%)`, `${fisik['fisik_10']}%<br>(${fisik['target_10']}%)`, `${fisik['fisik_11']}%<br>(${fisik['target_11']}%)`, `${fisik['fisik_12']}%<br>(${fisik['target_12']}%)`, inputFisikBtn]);
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
  }
  
  FDataTable.on('click', '.input_fisik', function(){
    fisikModal.self.modal('show');
    var id = $(this).data('id');
    var fisik = dataFisik[id];
    fisikModal.id_kegiatan_renja.val(fisik['id_kegiatan_renja']);
    fisikModal.nama_kegiatan_renja.html(fisik['nama_kegiatan_renja']);
    fisikModal.bulan.val('').trigger('change');
    fisikModal.target.val(0);
    fisikModal.fisik.val(0);
  });

  fisikModal.bulan.on('change', function(e){
    var fisik = dataFisik[fisikModal.id_kegiatan_renja.val()];
    fisikModal.target.val(fisik["target_" + fisikModal.bulan.val()]);
    fisikModal.fisik.val(fisik["fisik_" + fisikModal.bulan.val()]);
  });


  fisikModal.form.on('submit', (ev) => {
    ev.preventDefault();
    buttonLoading(fisikModal.save_btn);
    $.ajax({
      url: "<?=site_url('FisikController/setFisik')?>",
      type: "POST",
      data: fisikModal.form.serialize(),
      success: (data) => {
        buttonIdle(fisikModal.save_btn);
        json = JSON.parse(data);
        if(json['error']){
          swal("Ganti Program Renja gagal", json['message'], "error");
          return;
        } 
        var fisik = json['data'];
        dataFisik[fisikModal.id_kegiatan_renja.val()] = fisik;
        renderFisik(dataFisik);
        swal("Berhasil disimpan", 'Input Fisik Berhasil', "success");
        fisikModal.self.modal('hide');
      },
      error: () => {
        buttonIdle(fisikModal.save_btn);
      },
    });
  });

});
</script>
