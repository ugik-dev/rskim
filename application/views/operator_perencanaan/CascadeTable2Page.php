<span style="position: fixed;z-index:99999;right: 0px;bottom: 0px;background: #f1f1f1;padding: 4px 12px;margin: 4px;box-shadow: 1px 1px 2px 0px #000000cc;border-bottom: dashed;">
  <span class='rpjmd-text'>Sasaran RPJMD</span> | <span class='kegiatan-text'>Kegiatan PD</span>
</span>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="ibox ssection-container">
    <div class="ibox-content">
      <form class="form-inline" id="showForm" onsubmit="return false;">
        <select class="form-control mr-sm-2" name="id_opd" id="id_opd" <?=!$this->session->userdata("admin_opd") ? "readonly='readonly'" : ''?> style="width:400px">
        </select>
        <select class="form-control mr-sm-2" name="tahun" id="tahun" required="required">
          <option value>-- Pilih Tahun --</option>
          <option value='2020'>2020</option>
          <option value='2019'>2019</option>
          <option value='2018'>2018</option>
          <option value='2017'>2017</option>
        </select>  
        <button type="submit" class="btn btn-success my-1 mr-sm-2" id="show_btn" data-loading-text="Loading..." disabled><i class="fal fa-eye"></i> Tampilkan</button>
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
                  <th style="width: 16.67%; text-align:center!important">Sasaran RPJMD</th>
                  <th style="width: 16.67%; text-align:center!important">Indikator Indikator RPJMD</th>
                  <th style="width: 16.67%; text-align:center!important">Kegiatan PD</th>
                  <th style="width: 16.67%; text-align:center!important">Indikator Kegiatan PD</th>
                  <th style="width: 16.67%; text-align:center!important">Anggaran</th>
                  <th style="width: 16.67%; text-align:center!important">Penanggungjawab PD</th>
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
<style>
  th { font-size: 12px; }
  td { font-size: 11px; }
</style>
<script type="text/javascript">
$(document).ready(function() {
  $('#cascade_result_2').addClass('active');
  $('#cascade_result_2 #table').addClass('active');

  var FDataTable = $('#FDataTable').DataTable({
    dom: '<"html5buttons"B>lTfgitp',
    // 'columnDefs': [{"targets": [ 0,1, 2 ], "visible": false,"searchable": false}],
    ordering: false,
    paging: false,
    rowsGroup: [0, 1, 2],
    buttons: ['print'],
  });

  var SSection = {
    'form': $('#showForm'),
    'tahun': $('#tahun'),
    'opd': $('#id_opd'),
    'show_btn' : $('#show_btn')
  }

  var NavInfo = {
    'label': $('#nav_info_label'),
    'info': $('#nav_info')
  }
  var dataCascadeIndikator = {}

  SSection.form.on('submit', function(e){
    e.preventDefault();
    buttonLoading(SSection.show_btn);
    $.when(getCascadeIndikator()).done(() => {
      renderCascadeIndikator(dataCascadeIndikator);
      buttonIdle(SSection.show_btn);
    });
  });

  $.when(getAllOPD()).done(() => {
    SSection.show_btn.prop('disabled', false);
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
        text: e['nama_opd'],
      }));
    });

    SSection.opd.val(curr);
  }

  function getCascadeIndikator(){
    return $.ajax({
      url: `<?php echo site_url('OPPerencanaanController/getCascadeRPJMD2/')?>`,
      data : SSection.form.serialize(),
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataCascadeIndikator = json['data'];
      },
      error: function(e) {}
    });
  }

  function renderCascadeIndikator(data){
    if(data == null || typeof data != "object" || data['root'] == undefined){
      console.log("CascadeIndikator::UNKNOWN DATA");
      return;
    }
    var i = 0;

    var renderData = [];
    NavInfo.label.html('TOTAL BELANJA').show();
    NavInfo.info.html(`Rp${convertToRupiah(data['root']['total_belanja'])}`).show();

    Object.values(data['root']['sasaran_rpjmd']).forEach((rpjmd) => {
      var belanja_rpjmd = 'Belanja: ' + (rpjmd['total_belanja_rpjmd'] ? `Rp${convertToRupiah(rpjmd['total_belanja_rpjmd'])}` : 'Tidak ditemukan');
      var nama_rpjmd = `<span class='rpjmd-text'>${rpjmd['nama_sasaran_rpjmd']}</span> (${belanja_rpjmd})`;
      Object.values(rpjmd['indikator_sasaran_rpjmd']).forEach((isr) => {
        var belanja_isr = 'Belanja: ' + (isr['total_belanja_indikator_rpjmd'] ? `Rp${convertToRupiah(isr['total_belanja_indikator_rpjmd'])}` : 'Tidak ditemukan');
        var nama_isr = `<span class='indikator-rpjmd-text'>${isr['nama_indikator_sasaran_rpjmd']} :: ${isr['target_isr']} ${isr['satuan_isr']}</span> (${belanja_isr})`; 
        Object.values(isr['kegiatan_renja']).forEach((kr) => {
          var belanja_kr = 'Belanja: ' + (kr['total_belanja_kegiatan'] ? `Rp${convertToRupiah(kr['total_belanja_kegiatan'])}` : 'Tidak ditemukan');
          var nama_kr = `<span class='kegiatan-text'>${kr['nama_kegiatan_renja']}</span> (${belanja_kr})`; 
          var nama_opd = `<span>${kr['id_opd']}::${kr['nama_opd']}</span>`;
          var anggaran = `Rp${convertToRupiah(kr['total_belanja_kegiatan'])}`;
          Object.values(kr['indikator_kegiatan_renja']).forEach((ikr) => {
            var nama_ikr = `<span class='indikator-kegiatan-text'>${ikr['nama_indikator_kegiatan_renja']} :: ${ikr['target_ikr']}  ${ikr['satuan_ikr']}</span>`; 
            renderData.push([nama_rpjmd, nama_isr, nama_kr, nama_ikr, anggaran, nama_opd]);
          });
          if(Object.keys(kr['indikator_kegiatan_renja']).length == 0) renderData.push([nama_rpjmd, nama_isr, nama_kr, '-', "-", "-"]);
        });
        if(Object.keys(isr['kegiatan_renja']).length == 0) renderData.push([nama_rpjmd, nama_isr, "-", "-", "-", "-"]);
      });
      if(Object.keys(rpjmd['indikator_sasaran_rpjmd']).length == 0) renderData.push([nama_rpjmd, "-", "-", "-", "-", "-"]);
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
  }
 
});
</script>
