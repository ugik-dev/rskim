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
                  <th style="width: 25%; text-align:center!important">Kegiatan Renja</th>
                  <th style="width: 35%; text-align:center!important">Indikator Kegiatan</th>
                  <th style="text-align:center!important">Action</th>
                  <th style="width: 35%; text-align:center!important">Sasaran RPJMD</th>
                  <th style="text-align:center!important">Action</th>
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

<div class="modal inmodal" id="cascade_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Indikator Kegiatan Renja --> Sasaran RPJMD</h4>
            <span class="info"></span>
        </div>
        <div class="modal-body" id="modal-body">              
          <form role="form" id="cascade_form" onsubmit="return false;" type="multipart">
            <input type="hidden" id="id_kegiatan_renja" name="id_kegiatan_renja">
            <input type="hidden" id="id_indikator_kegiatan_renja" name="id_indikator_kegiatan_renja">
            <input type="hidden" id="id_sasaran_rpjmd_old" name="id_sasaran_rpjmd_old">
            <b>Kegiatan Renja : <span id="kegiatan_renja"></span></b><br>
            Indikator Kegiatan Renja : <span id="indikator_kegiatan_renja"></span>
            <div class="row">
              <div class="col-sm">
                <div class="form-group">
                  <label for="id_sasaran_rpjmd">Sasaran RPJMD</label> 
                  <select class="form-control mr-sm-2" name="id_sasaran_rpjmd" id="id_sasaran_rpjmd"></select>
                </div>
                <div class="form-group">
                  <label for="id_sasaran_rpjmd">Indikator RPJMD</label> 
                  <div id="indikator_rpjmd"></div>
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
       
<script type="text/javascript">
$(document).ready(function() {
  $('#cascade_2').addClass('active');
  $('#cascade_2 #cascade_kegiatan_2').addClass('active');

  var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [],
    ordering: false,
    rowsGroup: [0, 1, 2],
  });

  var SSection = {
    'form': $('#showForm'),
    'tahun': $('#tahun'),
    'opd': $('#id_opd'),
    'showBtn': $('#show_btn')
  }

  var cascade_modal = {
    self: $('#cascade_modal'),
    form: $('#cascade_form'),
    id_kegiatan_renja: $('#cascade_modal').find('#id_kegiatan_renja'),
    id_indikator_kegiatan_renja: $('#cascade_modal').find('#id_indikator_kegiatan_renja'),
    id_sasaran_rpjmd_old: $('#cascade_modal').find('#id_sasaran_rpjmd_old'),
    kegiatan_renja: $('#cascade_modal').find('#kegiatan_renja'),
    indikator_kegiatan_renja: $('#cascade_modal').find('#indikator_kegiatan_renja'),
    rpjmd: $('#cascade_modal').find('#id_sasaran_rpjmd'),
    indikator_rpjmd: $('#cascade_modal').find('#indikator_rpjmd'),
    save_btn: $('#cascade_modal').find('#save'),
    action: null,
  }
  var dataSasaranRPJMD = {};
  var dataKegiatanRenja = {};
  var dataAllOPD = {};

  SSection.form.on('submit', function(e){
    e.preventDefault();
    buttonLoading(SSection.showBtn)
    $.when(getSasaranRPJMD(), getAllKegiatanRenja2()).done(function(){
      renderKegiatanRenja(dataKegiatanRenja);
    }).then((e) => {
      buttonIdle(SSection.showBtn)
    });
  });
  
  $.when(getAllOPD()).done(() => {
    SSection.showBtn.prop('disabled', false);
  })

  function getAllOPD(){
    return $.ajax({
      url: "<?php echo site_url('SharedController/getAllOPD')?>",
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

  function getSasaranRPJMD(){
    return $.ajax({
      url: `<?php echo site_url('OPPerencanaanController/getSasaranRPJMD/')?>`,
      data : SSection.form.serialize(),
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataSasaranRPJMD = json['data'];
        renderRenstraSelect(dataSasaranRPJMD);
      },
      error: function(e) {}
    });
  }

  function renderRenstraSelect(data){
    cascade_modal.rpjmd.empty();
    cascade_modal.rpjmd.append($('<option>', { value: "", text: "Sasaran RPJMD Belum dipilih"}));
    Object.values(data).forEach((e) => {
      cascade_modal.rpjmd.append($('<option>', {
        value: e['id_sasaran_rpjmd'],
        text: `${e['id_sasaran_rpjmd']} :: ${e['nama_sasaran_rpjmd']}`,
      }));
    });
  }

  cascade_modal.rpjmd.on('change', function(e){
    id_sasaran_rpjmd = $(this).val();
    if(!id_sasaran_rpjmd){ cascade_modal.indikator_rpjmd.empty(); return; }
    var rpjmd = dataSasaranRPJMD[id_sasaran_rpjmd];
    var kegiatan = dataKegiatanRenja[cascade_modal.id_kegiatan_renja.val()];
    var indikatorKegiatan = kegiatan['indikator_kegiatan_renja'][cascade_modal.id_indikator_kegiatan_renja.val()];
    renderIndikatorRenstraCheckbox(rpjmd ? rpjmd['indikator_sasaran_rpjmd'] : [], indikatorKegiatan['sasaran_rpjmd'][cascade_modal.rpjmd.val()]);
  });

  function renderIndikatorRenstraCheckbox(data, checkeds){
    cascade_modal.indikator_rpjmd.empty();
    Object.values(data).forEach((e) => {
      var checked = cascade_modal.action == "add" ? false : checkeds[e['id_indikator_sasaran_rpjmd']] != undefined;
      cascade_modal.indikator_rpjmd.append(`
        <label><input type='checkbox' value='${e['id_indikator_sasaran_rpjmd']}' name='id_indikator_sasaran_rpjmd[]' ${checked ? 'checked' : ''}>
        ${e['id_indikator_sasaran_rpjmd']} :: ${e['nama_indikator_sasaran_rpjmd']}</label><br>
      `);
    });
  }

  function getAllKegiatanRenja2(){
    return $.ajax({
      url: `<?php echo site_url('OPPerencanaanController/getAllKegiatanRenja2/')?>`,
      data : SSection.form.serialize(),
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataKegiatanRenja = json['data'];
      },
      error: function(e) {}, 
    });
  }

  function renderKegiatanRenja(data){
    if(data == null || typeof data != "object"){
      console.log("Sasaran RPJMD::UNKNOWN DATA");
      return;
    }
    var i = 0;
    
    var renderData = [];
    var counter = 1;
    Object.values(data).forEach((renstra) => {
      var kegiatanRenja = `${renstra['id_kegiatan_renja']} :: ${renstra['nama_kegiatan_renja']}`
      var pagu = `<br>Pagu:: Rp${convertToRupiah(renstra['pagu'])}`;
      var belanja = 'Belanja: ' + (renstra['total_belanja'] ? `Rp${convertToRupiah(renstra['total_belanja'])}` : 'Tidak ditemukan');
      if(Object.keys(renstra['indikator_kegiatan_renja']).length == 0){
        renderData.push([`${kegiatanRenja}`, `<span style="color:red">Tidak ada Indikator.</span>`, '', '', ''])
        return;
      }

      Object.values(renstra['indikator_kegiatan_renja']).forEach((ikr) => {
        var indikatorKegiatanRenja = `${ikr['id_indikator_kegiatan_renja']} :: ${ikr['nama_indikator_kegiatan_renja']}`
        var add_btn = `
          <button class="add_cascade btn btn-success my-1 mr-sm-2" data-id='${renstra['id_kegiatan_renja']}' data-idi='${ikr['id_indikator_kegiatan_renja']}'><i class='fa fa-plus'></i></button>
        `;

        if(Object.keys(ikr['sasaran_rpjmd']).length == 0){
          renderData.push([`${kegiatanRenja} (${belanja})`, `${indikatorKegiatanRenja}`, add_btn, '<span style="color:red">Sasaran RPJMD belum dipilih.</span>', '-'])
          return;
        }
        Object.keys(ikr['sasaran_rpjmd']).forEach((sr) => {
          var isr = ikr['sasaran_rpjmd'][sr];
          var rpjmd = dataSasaranRPJMD[sr];
          var nama_rpjmd = rpjmd == null ? '<span style="color:red">Sasaran RPJMD belum dipilih.</span>' : `<b>${rpjmd['id_sasaran_rpjmd']} :: ${rpjmd['nama_sasaran_rpjmd']}</b>`
          var indikator_rpjmd = rpjmd == null ? '' : 
            Object.values(rpjmd['indikator_sasaran_rpjmd'])
              .filter((e) => isr[e['id_indikator_sasaran_rpjmd']] != undefined)
              .reduce((acc, curr) => `${acc}  ${curr['id_indikator_sasaran_rpjmd']} :: ${curr['nama_indikator_sasaran_rpjmd']}<br>`, '<br>Indikator::<br>');
          var change_btn = `
            <button class="change_cascade btn btn-success my-1 mr-sm-2" data-id='${renstra['id_kegiatan_renja']}' data-idi='${ikr['id_indikator_kegiatan_renja']}' data-idsr='${sr}' ><i class='fa fa-edit'></i></button>
          `;
          renderData.push([`${kegiatanRenja} (${belanja})`, `${indikatorKegiatanRenja}`, add_btn, nama_rpjmd + indikator_rpjmd, change_btn])
        });
      });
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
  }

  FDataTable.on('click', '.add_cascade', function(){
    cascade_modal.self.modal('show');
    var id = $(this).data('id');
    var idi = $(this).data('idi');
    cascade_modal.id_kegiatan_renja.val(id);
    cascade_modal.id_indikator_kegiatan_renja.val(idi);
    var kegiatan = dataKegiatanRenja[id];
    var indikatorKegiatan = kegiatan['indikator_kegiatan_renja'][idi];
    cascade_modal.kegiatan_renja.html(kegiatan['nama_kegiatan_renja']);
    cascade_modal.indikator_kegiatan_renja.html(indikatorKegiatan['nama_indikator_kegiatan_renja']);
    cascade_modal.action = "add";
    cascade_modal.rpjmd.val(null).trigger('change');
    cascade_modal.rpjmd.attr("readOnly", false);
  });

  FDataTable.on('click', '.change_cascade', function(){
    cascade_modal.self.modal('show');
    var id = $(this).data('id');
    var idi = $(this).data('idi');
    var idsr = $(this).data('idsr');
    cascade_modal.id_kegiatan_renja.val(id);
    cascade_modal.id_indikator_kegiatan_renja.val(idi);
    cascade_modal.id_sasaran_rpjmd_old.val(idsr);
    var kegiatan = dataKegiatanRenja[id];
    var indikatorKegiatan = kegiatan['indikator_kegiatan_renja'][idi];
    cascade_modal.kegiatan_renja.html(kegiatan['nama_kegiatan_renja']);
    cascade_modal.indikator_kegiatan_renja.html(indikatorKegiatan['nama_indikator_kegiatan_renja']);
    cascade_modal.action = "set";
    cascade_modal.rpjmd.val(idsr).trigger('change');
    cascade_modal.rpjmd.attr("readOnly", true);
  });

  cascade_modal.form.on('submit', (ev) => {
    ev.preventDefault();
    buttonLoading(cascade_modal.save_btn);
    $.ajax({
      url: "<?=site_url('OPPerencanaanController/setSasaranRPJMD2')?>",
      type: "POST",
      data: cascade_modal.form.serialize(),
      success: (data) => {
        buttonIdle(cascade_modal.save_btn);
        json = JSON.parse(data);
        if(json['error']){
          swal("Ganti Sasaran RPJMD gagal", json['message'], "error");
          return;
        } 
        swal("Berhasil disimpan", 'Ganti sasaran Renstra berhasil', "success");
        var kegiatanRenja = json['data'];
        dataKegiatanRenja[kegiatanRenja['id_kegiatan_renja']] = kegiatanRenja
        renderKegiatanRenja(dataKegiatanRenja);
        cascade_modal.self.modal('hide');
      },
      error: () => {
        buttonIdle(cascade_modal.save_btn);
      },
    });
  });

});
</script>
