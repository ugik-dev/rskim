<span style="position: fixed;z-index:99999;right: 0px;bottom: 0px;background: #f1f1f1;padding: 4px 12px;margin: 4px;box-shadow: 1px 1px 2px 0px #000000cc;border-bottom: dashed;">
  <span class='rpjmd-text'>OPD</span> | <span class='program-text'>Program PD</span> | <span class='kegiatan-text'>Kegiatan PD</span>
</span>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="ibox ssection-container">
    <div class="ibox-content">
      <form class="form-inline" id="showForm" onsubmit="return false;">
        <select class="form-control mr-sm-2" name="id_opd" id="id_opd" readonly="readonly" required="required" style="width:400px">
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
    <div class="col-lg-12 p-0">
      <div class="ibox">
        <div class="ibox-content">
          <div class="table-responsive">
            <table id="FDataTable" class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 13%;" rowspan="2">OPD</th>
                  <th style="width: 13%;" rowspan="2">Program PD</th>
                  <th style="width: 14%;" rowspan="2">Kegiatan PD</th>
                  <th style="width: 60%;" colspan="5">Indikator</th>
                  <th style="width: 5%;" rowspan="2">Act</th>
                </tr>
                <tr>
                  <th style="width: 12%;">Dampak</th>
                  <th style="width: 12%;">Manfaat</th>
                  <th style="width: 12%;">Hasil</th>
                  <th style="width: 12%;">Keluaran</th>
                  <th style="width: 12%;">Masukan</th>
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

<div class="modal inmodal" id="rka_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
        <div class="modal-body" id="modal-body">
          <table class="rka-header" border="1">
            <tr>
              <td rowspan="2">LOGO</td>
              <td><b>RENCANA KERJA DAN ANGGARAN<br>SATUAN KERJA PERANGKAT DAERAH</b></td>
              <td rowspan="2">Formulir<br>RKA SKPD<br>2.2.1</td>
            </tr>
            <tr>
              <td><b>Rumah Sakit Kalbu Intan Medika</b><br>Tahun Anggaran : <span id="tahun"></span></td>
            </tr>
          </table>
          <table border="1">
            <tr><td>Urusan Pemerintahan</td><td>:</td><td><span id="urusan"></span></td></tr>
            <tr><td>Organisasi</td><td>:</td><td><span id="opd"></span></td></tr>
            <tr><td>Program</td><td>:</td><td><span id="program"></span></td></tr>
            <tr><td>Kegiatan</td><td>:</td><td><span id="kegiatan"></span></td></tr>
            <tr><td>Jumlah</td><td>:</td><td><span id="jumlah"></span></td></tr>
          </table>
          <table class="rka-indikator" border="1">
            <tr>
              <th colspan="3">INDIKATOR & TOLAK UKUR KINERJA BELANJA LANGSUNG</th>
            </tr>
            <tr>
              <th>INDIKATOR</th>
              <th>TOLAK UKUR KINERJA</th>
              <th>TARGET KINERJA</th>
            </tr>
            <tr><td><b>MASUKAN</b></td><td><span id="masukan"></span></td><td><span id="masukan_target"></span></td><tr>
            <tr><td><b>KELUARAN</b></td><td><span id="keluaran"></span></td><td><span id="keluaran_target"></span></td><tr>
            <tr><td><b>HASIL</b></td><td><span id="hasil"></span></td><td><span id="hasil_target"></span></td><tr>
            <tr><td><b>MANFAAT</b></td><td><span id="manfaat"></span></td><td><span id="manfaat_target"></span></td><tr>
            <tr><td><b>DAMPAK</b></td><td><span id="dampak"></span></td><td><span id="dampak_target"></span></td><tr>
          </table>
          <table class="rka-rincian" border="1">
            <tr>
              <th colspan="3">RINCIAN ANGGARAN BELANJA LANGSUNG MENURUT PROGRAM DAN PER KEGIATAN SATUAN KERJA PERANGKAT DAERAH</th>
            </tr>
            <tr>
              <th>KODE REKENING</th>
              <th>URAIAN</th>
              <th>JUMLAH</th>
            </tr>
            <tr><td><b>5</b></td><td>BELANJA</td><td><span id="belanja"></span></td><tr>
            <tr><td><b>5.1</b></td><td>BELANJA TIDAK LANGSUNG</td><td><span id="belanja_tl"></span></td><tr>
            <tr><td><b>5.2</b></td><td>BELANJA LANGSUNG</td><td><span id="belanja_l"></span></td><tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

<style>
  th { font-size: 12px; }
  td { font-size: 11px; padding-left: 4px; }
  table.rka-header td { text-align: center }
  table.rka-indikator th { text-align: center }
  table.rka-rincian th { text-align: center }
  table { margin-bottom: 4px;}
</style>
<script type="text/javascript">
$(document).ready(function() {
  $('#rka').addClass('active');

  var FDataTable = $('#FDataTable').DataTable({
    dom: '<"html5buttons"B>lTfgtp',
    'columnDefs': [],
    ordering: false,
    paging: false,
    rowsGroup: [0, 1, 2],
    buttons: ['pdf']
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

  var rka_modal = {
    'self': $('#rka_modal'),
    'tahun': $('#rka_modal').find('#tahun'),
    'urusan': $('#rka_modal').find('#urusan'),
    'opd': $('#rka_modal').find('#opd'),
    'program': $('#rka_modal').find('#program'),
    'kegiatan': $('#rka_modal').find('#kegiatan'),
    'jumlah': $('#rka_modal').find('#jumlah'),
    'masukan': $('#rka_modal').find('#masukan'),
    'masukan_target': $('#rka_modal').find('#masukan_target'),
    'keluaran': $('#rka_modal').find('#keluaran'),
    'keluaran_target': $('#rka_modal').find('#keluaran_target'),
    'hasil': $('#rka_modal').find('#hasil'),
    'hasil_target': $('#rka_modal').find('#hasil_target'),
    'manfaat': $('#rka_modal').find('#manfaat'),
    'manfaat_target': $('#rka_modal').find('#manfaat_target'),
    'dampak': $('#rka_modal').find('#dampak'),
    'dampak_target': $('#rka_modal').find('#dampak_target'),
    'belanja': $('#rka_modal').find('#belanja'),
    'belanja_tl': $('#rka_modal').find('#belanja_tl'),
    'belanja_l': $('#rka_modal').find('#belanja_l')
  }
  var dataRKA = {}

  SSection.form.on('submit', function(e){
    e.preventDefault();
    buttonLoading(SSection.show_btn);
    $.when(getRKA()).done(() => {
      renderRKA(dataRKA);
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
    SSection.opd.append($('<option>', { value: "", text: "-- Pilih OPD --"}));
    Object.values(data).forEach((e) => {
      SSection.opd.append($('<option>', {
        value: e['id_opd'],
        text: e['nama_opd'],
      }));
    });

    SSection.opd.val(curr);
  }

  function getRKA(){
    return $.ajax({
      url: `<?php echo site_url('CascadeController/getRKA/')?>`,
      data : SSection.form.serialize(),
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataRKA = json['data'];
      },
      error: function(e) {}
    });
  }

  function renderRKA(data){
    if(data == null || typeof data != "object"){
      console.log("RKA::UNKNOWN DATA");
      return;
    }
    var i = 0;
    
    var renderData = [];
    Object.values(data).forEach((opd) => {
      var pagu_opd = 'Pagu: ' + (opd['pagu_opd'] ? `Rp${convertToRupiah(opd['pagu_opd'])}` : 'Tidak ditemukan');
      var belanja_opd = 'Belanja: ' + (opd['belanja_opd'] ? `Rp${convertToRupiah(opd['belanja_opd'])}` : 'Tidak ditemukan');
      var nama_opd = `<span class='rpjmd-text'>${opd['id_opd']} :: ${opd['nama_opd']}</span> (${pagu_opd}) (${belanja_opd})`;
      Object.values(opd['program_renja']).forEach((pr) => {
        var pagu_pr = 'Pagu: ' + (pr['pagu_program'] ? `Rp${convertToRupiah(pr['pagu_program'])}` : 'Tidak ditemukan');
        var belanja_pr = 'Belanja: ' + (pr['belanja_program'] ? `Rp${convertToRupiah(pr['belanja_program'])}` : 'Tidak ditemukan');
        var nama_pr = `<span class='program-text'>${pr['id_program_renja']} :: ${pr['nama_program_renja']}</span> (${pagu_pr}) (${belanja_pr})`; 
        Object.values(pr['kegiatan_renja']).forEach((kr) => {
          var pagu_kr = 'Pagu: ' + (kr['pagu_kegiatan'] ? `Rp${convertToRupiah(kr['pagu_kegiatan'])}` : 'Tidak ditemukan');
          var nama_kr = `<span class='kegiatan-text'>${kr['id_kegiatan_renja']} :: ${kr['nama_kegiatan_renja']}</span> (${pagu_kr})`; 
          var dampak = `${kr['nama_indikator_sasaran_rpjmd'] ? kr['nama_indikator_sasaran_rpjmd'] : '_'} ${kr['target_isr'] ? kr['target_isr'] : '_'} ${kr['satuan_isr'] ? kr['satuan_isr'] : '_'}`;
          var manfaat = `${kr['nama_indikator_sasaran_renstra'] ? kr['nama_indikator_sasaran_renstra'] : '_'} ${kr['target_isre'] ? kr['target_isre'] : '_'} ${kr['satuan_isre'] ? kr['satuan_isre'] : '_'}`;
          var hasil = `${kr['nama_indikator_program_renja'] ? kr['nama_indikator_program_renja'] : '_'} ${kr['target_ipr'] ? kr['target_ipr'] : '_'} ${kr['satuan_ipr'] ? kr['satuan_ipr'] : '_'}`;
          var keluaran = `${kr['nama_indikator_kegiatan_renja'] ? kr['nama_indikator_kegiatan_renja'] : '_'} ${kr['target_ikr'] ? kr['target_ikr'] : '_'} ${kr['satuan_ikr'] ? kr['satuan_ikr'] : '_'}`;
          var masukan = (kr['belanja_kegiatan'] ? `Rp${convertToRupiah(kr['belanja_kegiatan'])}` : 'Rp _');
          var showRKABtn = `<button class="btn btn-success btn-xs show_rka" data-ido="${opd['id_opd']}" data-idp="${pr['id_program_renja']}" data-idk="${kr['id_kegiatan_renja']}">RKA</button>`;
          renderData.push([nama_opd, nama_pr, nama_kr, dampak, manfaat, hasil, keluaran, masukan, showRKABtn]);
        });
        if(Object.keys(pr['kegiatan_renja']).length == 0) renderData.push([nama_opd, nama_pr, '-', '-', '-', '-', '-', '-', '-']);
      });
      if(Object.keys(opd['program_renja']).length == 0) renderData.push([nama_opd, '-', '-', '-', '-', '-', '-', '-', '-']);
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
  }

  FDataTable.on('click', '.show_rka', function(){
    rka_modal.self.modal('show');
    var ido = $(this).data('ido');
    var idp = $(this).data('idp');
    var idk = $(this).data('idk');
    var opd = dataRKA[ido];
    var program = opd['program_renja'][idp];
    var kegiatan = program['kegiatan_renja'][idk];
    
    rka_modal.opd.html(opd['nama_opd']);
    rka_modal.program.html(program['nama_program_renja']);
    rka_modal.kegiatan.html(kegiatan['nama_kegiatan_renja']);
    rka_modal.jumlah.html(`Rp${convertToRupiah(kegiatan['belanja_kegiatan'])}`);

    rka_modal.masukan.html('Jumlah Dana');
    rka_modal.masukan_target.html(kegiatan['belanja_kegiatan']);
    rka_modal.keluaran.html(kegiatan['nama_indikator_kegiatan_renja']);
    rka_modal.keluaran_target.html(`${kegiatan['target_ikr']} ${kegiatan['satuan_ikr']}`);
    rka_modal.hasil.html(kegiatan['nama_indikator_program_renja']);
    rka_modal.hasil_target.html(`${kegiatan['target_ipr']} ${kegiatan['satuan_ipr']}`);
    rka_modal.manfaat.html(kegiatan['nama_indikator_sasaran_renstra']);
    rka_modal.manfaat_target.html(`${kegiatan['target_isre']} ${kegiatan['satuan_isre']}`);
    rka_modal.dampak.html(kegiatan['nama_indikator_sasaran_rpjmd']);
    rka_modal.dampak_target.html(`${kegiatan['target_isr']} ${kegiatan['satuan_isr']}`);

    rka_modal.belanja.html(`Rp${convertToRupiah(kegiatan['belanja_kegiatan'])}`);
  });
});
</script>
