<div class="wrapper wrapper-content animated fadeInRight" id="periodeContainer">
  <div class="ibox ssection-container">
    <div class="ibox-content">
      <form class="form-inline" id="toolbar_form" onsubmit="return false;">
        <select class="form-control mr-sm-2" name="tahun" id="tahun"></select>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <p class="alert alert-success">
        <b>Tanggal Update : </b><span id="import_date">-</span>
      </p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6 col-xl-3">
      <div class="ibox">
        <div class="ibox-content bg-success">
          <h5>Alokasi APBD Tahun <span class="tahun_label"></span></h5>
          <h2 class="no-margins"><span id="total_anggaran_all">Rp0</span></h2>
          <div class="stat-percent font-bold text-navy">-</div>
          <small>-</small>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-xl-3">
      <div class="ibox">
        <div class="ibox-content bg-primary">
          <h5>Realisasi Keuangan Saat Ini (SPJ)</h5>
          <h2 class="no-margins"><span id="realisasi_keuangan">Rp0</span></h2>
          <div class="stat-percent font-bold"><span id="percentage_keuangan">0%</span> <i class="fa fa-bolt"></i></div>
          <small>Percentage</small>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-xl-2">
      <div class="ibox">
        <div class="ibox-content bg-info">
          <h5>Fisik Saat Ini</h5>
          <h2 class="no-margins"><span id="realisasi_fisik">0%</span></h2>
          <div class="stat-percent font-bold text-navy">-</div>
          <small>-</small>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-xl-2">
      <div class="ibox">
        <div class="ibox-content bg-warning">
          <h5>Total Program <span class="tahun_label"></span></h5>
          <h2 class="no-margins"><span id="total_program">0</span></h2>
          <div class="stat-percent font-bold text-navy">-</div>
          <small>-</small>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-xl-2">
      <div class="ibox">
        <div class="ibox-content bg-danger">
          <h5>Total Kegiatan <span class="tahun_label"></span></h5>
          <h2 class="no-margins"><span id="total_kegiatan">0</span></h2>
          <div class="stat-percent font-bold"><span id="total_kegiatan_underperformed">0</span></div>
          <small>KPI <= 30%</small>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-3">
      <div class="ibox">
        <div class="ibox-content">
          <h5>Stuktur Anggaran <span class="tahun_label"></span></h5>
          <div id="struktur_anggaran_all"></div>
          <div class="stat-percent font-bold text-navy"id="total_belanja"></div>
          <small>Total</small>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="ibox">
        <div class="ibox-content">
          <h5>Stuktur Anggaran BTL <span class="tahun_label"></span></h5>
          <div id="struktur_anggaran_btl"></div>
          <div class="stat-percent font-bold text-navy"><span id="total_btl"></span></div>
          <small>Total</small>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
        <div class="ibox">
          <div class="ibox-content">
            <h5>Stuktur Anggaran BL <span class="tahun_label"></span></h5>
            <div id="struktur_anggaran_bl"></div>
            <div class="stat-percent font-bold text-navy"><span id="total_bl"></span></div>
            <small>Total</small>
          </div>
        </div>
    </div>
    <div class="col-lg-3">
      <div class="ibox">
        <div class="ibox-content">
          <h5>Stuktur Anggaran BL NON Pegawai <span class="tahun_label"></span></h5>
          <div id="struktur_anggaran_bl_non_pegawai"></div>
          <div class="stat-percent font-bold text-navy"><span id="total_bl_non_pegawai"></span></div>
          <small>Total</small>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <h5>Progress Keuangan</h5>
          <canvas id="line-chart"></canvas>
        </div>
      </div>
    </div>
  </div>  
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <h5>Realisasi OPD Saat Ini</h5>
          <div class="table-responsive">
            <table id="RealisasiOPDTable" class="table table-bordered" style="padding:0px">
              <thead>
                <tr>
                  <th style="width: 35%;">OPD</th>
                  <th style="width: 17%;">Alokasi Rp</th>
                  <th style="width: 17%;">Keuangan Rp</th>
                  <th style="width: 8%;">Keuangan %</th>
                  <th style="width: 8%;">Fisik %</th>
                  <th style="width: 8%;">KPI %</th>
                  <th style="width: 7%;">Action</th>
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
  th { font-size: 12px; text-align:center!important}
  td { font-size: 11px;}
</style>
<script>
$(document).ready(function() {



  $('#monevAll').addClass('active');
  
  var tahun_temp = `<?=$contentData['tahun']?>`;
  var tahun_label = $('.tahun_label');

  var realisasi = {};
  var fisik = {};
  var struktur_anggaran = {};
  var program_kegiatan = {};
  
  var dataTahun = {};
  var toolbar = {
    'form': $('#toolbar_form'),
    'tahun': $('#toolbar_form').find('#tahun'),
  }

  $.when(getAllTahun()).then((e) =>{
    toolbar.tahun.trigger('change');
  }).fail((e) => { console.log(e) });

  function getAllTahun(){
    return $.ajax({
      url: `<?php echo site_url('SharedController/getAllTahun/')?>`, 'type': 'GET',
      data: {},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataTahun = json['data'];
        renderTahunSelectionFilter(dataTahun);
      },
      error: function(e) {}
    });
  }

  function renderTahunSelectionFilter(data){
    toolbar.tahun.empty();
    Object.values(data).reverse().forEach((d) => {
      toolbar.tahun.append($('<option>', {
        value: d['tahun'],
        text: d['tahun'],
      }));
    });
    if(tahun_temp) toolbar.tahun.val(tahun_temp);
  }

  toolbar.tahun.on('change', (e) => {
    getData(toolbar.tahun.val());
  });

  function getData(tahun){
    swal({title: 'Loading...', allowOutsideClick: false});
    swal.showLoading();
    $.when(getAllLatestSyncImport(tahun), getRealisasiAll(tahun), getStatusProgramKegiatan(tahun), getStrukturAnggaran(tahun), getAllRealisasiOPD(tahun)).then((e) =>{
      tahun_label.html(tahun);
      swal.close();
    }).fail((e) => { console.log(e) });
  }

  function getAllLatestSyncImport(tahun){
    return $.get(`<?php echo site_url('SharedController/getAllLatestSyncImport/')?>`, {'tahun': tahun}, (data) => {
      var json = JSON.parse(data);
      sync_import = json['data'];
      $('#import_date').html(`
        ${sync_import[1]['tanggal_sync_import'] ? sync_import[1]['tanggal_sync_import'] : 'Tidak Ada'} (Struktur Anggaran Simda) //
        ${sync_import[2]['tanggal_sync_import'] ? sync_import[2]['tanggal_sync_import'] : 'Tidak Ada'} (Realisasi Fisik Tepra) //
        ${sync_import[3]['tanggal_sync_import'] ? sync_import[3]['tanggal_sync_import'] : 'Tidak Ada'} (Realisasi Keuangan Simda)
      `);
    });
  }

  function getRealisasiAll(tahun){
    return $.ajax({
      url: "<?php echo site_url('SyncronizationController/getRealisasiAll')?>",
      data : {tahun: tahun},
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        realisasi = json['data'];
        $('#total_anggaran_all').html(`Rp${convertToRupiah(realisasi['anggaran'])}`);
        $('#realisasi_keuangan').html(`Rp${convertToRupiah(realisasi['realisasi_keuangan'])}`);
        $('#percentage_keuangan').html(`${(realisasi['capaian_keuangan'])}%`);
        $('#realisasi_fisik').html(`${realisasi['realisasi_fisik']}%`);
      },
      error: function(e) {}
    });
  }
 
  function getLineChart(tahun){
    return $.ajax({
      url: "<?php echo site_url('SyncronizationController/getLineChart')?>",
      data : {tahun : '2019'},
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
         renderLineChart(json)
      },
      error: function(e) {}
    });
  }

  function renderLineChart(data){
    console.log(data[0]);
    let chart = new Chart(document.getElementById('line-chart').getContext('2d'), {
      type: 'line',
      data: {
          datasets: [{
              label: 'Target Keuangan',
              data: [ <?php for($i=0;$i<12;$i++){ ?> data[<?= $i ?>]['target_keuangan'], <?php } ?>],
              fill: false,
          },{
            label: 'Target fisik',
              data: [ <?php for($i=0;$i<12;$i++){ ?> data[<?= $i ?>]['target_fisik'], <?php } ?>],
              fill: false,
          },{
              label: 'Realisasi Keuangan',
              data: [ <?php for($i=0;$i<12;$i++){ ?> data[<?= $i ?>]['realisasi_keuangan'], <?php } ?>],
              fill: false,
          },{
              label: 'Realisasi Fisik',
              data: [ <?php for($i=0;$i<12;$i++){ ?> data[<?= $i ?>]['realisasi_fisik'], <?php } ?>],
              fill: false,
          }],
          labels: ['Januari', 'Februari', 'Maret', 'April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      suggestedMin: 0,
                      suggestedMax: 100
                  }
              }]
          }
      }
  });
  }

  function getStatusProgramKegiatan(tahun){
    return $.ajax({
      url: "<?php echo site_url('SyncronizationController/countProgramKegiatan')?>",
      data : {tahun: tahun, kpi: 10},
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        program_kegiatan = json['data'];
        $('#total_program').html(program_kegiatan['program']);
        $('#total_kegiatan').html(program_kegiatan['kegiatan']);
        $('#total_kegiatan_underperformed').html(program_kegiatan['kegiatan_underperformed']);
      },
      error: function(e) {}
    });
  }

  function getStrukturAnggaran(tahun){
    return $.ajax({
      url: "<?php echo site_url('SyncronizationController/getStrukturAnggaran')?>",
      data : {tahun: tahun},
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        struktur_anggaran = json['data'];
        
        renderStruktur("#struktur_anggaran_all", [['BTL', struktur_anggaran['btl']], ['BL', struktur_anggaran['bl']]], {'BTL': "#1f77b4", 'BL': "#ff7f0e"});
        $("#total_belanja").html(`Rp${convertToRupiah(struktur_anggaran['belanja'])}`);

        renderStruktur("#struktur_anggaran_btl", [['Pegawai', struktur_anggaran['btl_pegawai']], ['Non Pegawai', struktur_anggaran['btl_non_pegawai']]], {'Pegawai': "#1f77b4", 'Non Pegawai': "#ff7f0e"});
        $("#total_btl").html(`Rp${convertToRupiah(struktur_anggaran['btl'])}`);
        
        renderStruktur("#struktur_anggaran_bl", [['Pegawai', struktur_anggaran['bl_pegawai']], ['Non Pegawai', struktur_anggaran['bl_non_pegawai']]], {'Pegawai': "#1f77b4", 'Non Pegawai': "#ff7f0e"});
        $("#total_bl").html(`Rp${convertToRupiah(struktur_anggaran['bl'])}`);

        renderStruktur("#struktur_anggaran_bl_non_pegawai", [['Barang Jasa', struktur_anggaran['barang_jasa']], ['Modal', struktur_anggaran['modal']]], {'Barang Jasa': "#1f77b4", 'Modal': "#ff7f0e"});
        $("#total_bl_non_pegawai").html(`Rp${convertToRupiah(struktur_anggaran['bl_non_pegawai'])}`);
      },
      error: function(e) {}
    });
  }

  function renderStruktur(bindto, columns, colors){
    return c3.generate({
      bindto: bindto,
      data: {
        columns: columns,
        type : 'pie',
        colors: colors,
      },
      size: {
        height: 170,
      },
      tooltip: {
        format: {
          value: function (v, r, id){
            return `Rp${convertToRupiah(v)}`;
          }
        }
      }
    });
  }
  
  var allRealisasiOPD = {}
  var RealisasiOPDTable = $('#RealisasiOPDTable').DataTable({
    'columnDefs': [
      {"targets": [0], type: 'natural'},
      {"targets": [ 1, 2 ], "className": 'text-right'}, 
      {"targets": [ 3, 4, 5, 6 ], "className": 'text-center'}],
    pageLength: 10,
    dom: "<'row'<'col-sm-8'p><'col-sm-4'f>>" + 'Tt',
    paging: true,
  });

  
  function getAllRealisasiOPD(tahun){
    return $.ajax({
      url: "<?php echo site_url('SyncronizationController/getAllRealisasiOPD')?>",
      data : {tahun: tahun},
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        allRealisasiOPD = json['data'];
        renderRealisasiOPD(allRealisasiOPD, tahun)
      },
      error: function(e) {}
    });
  }

  function renderRealisasiOPD(data, tahun){
    if(data == null || typeof data != "object"){
      console.log("NO REALISASI");
    }
    var i = 0;
    var renderData = [];
    Object.values(data).forEach((r) => {
      var detailBtn = `<a href="<?=site_url("PimpinanController/monevOPD/")?>?id_opd=${r['id_opd']}&tahun=${tahun}" class="btn btn-success btn-xs">Detail</a>`;
      renderData.push([`${r['id_opd']}::${r['nama_opd']}`, `${convertToRupiah(r['anggaran'])}`, `${convertToRupiah(r['realisasi_keuangan'])}`, coloriseRealisasi(r['capaian_keuangan']), coloriseRealisasi(r['realisasi_fisik']), coloriseRealisasi(r['kpi']), `${detailBtn}`]);
    });
    RealisasiOPDTable.clear().rows.add(renderData).draw('full-hold');
  }

});
</script>