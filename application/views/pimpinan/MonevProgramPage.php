<div class="wrapper wrapper-content animated fadeInRight" id="periodeContainer">
  <div class="row">
    <div class="col-lg-4">
      <div class="ibox">
        <div class="ibox-content bg-success">
          <h5>Alokasi Tahun <span class="tahun_label"></span></h5>
          <h2 class="no-margins"><span id="total_anggaran_all">Rp0</span></h2>
          <div class="stat-percent font-bold text-navy">-</div>
          <small>-</small>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="ibox">
        <div class="ibox-content bg-primary">
          <h5>Keuangan Sampai Saat Ini</h5>
          <h2 class="no-margins"><span id="realisasi_keuangan">Rp0</span></h2>
          <div class="stat-percent font-bold"><span id="percentage_keuangan">0%</span> <i class="fa fa-bolt"></i></div>
          <small>Percentage</small>
        </div>
      </div>
    </div>
    <!-- <div class="col-lg-2">
      <div class="ibox">
        <div class="ibox-content bg-info">
          <h5>Fisik Sampai Saat Ini</h5>
          <h2 class="no-margins"><span id="realisasi_fisik">0%</span></h2>
          <div class="stat-percent font-bold text-navy">-</div>
          <small>-</small>
        </div>
      </div>
    </div> -->
    <div class="col-lg-2">
      <div class="ibox">
        <div class="ibox-content bg-warning">
          <h5>Total Kegiatan <span class="tahun_label"></span></h5>
          <h2 class="no-margins"><span id="total_kegiatan">0</span></h2>
          <div class="stat-percent font-bold text-navy">-</div>
          <small>-</small>
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
          <h5>Realisasi Kegiatan Sampai Saat Ini</h5>
          <div class="table-responsive">
            <table id="RealisasiKegiatanTable" class="table table-bordered" style="padding:0px">
              <thead>
                <tr>
                  <th style="width: 35%;">Kegiatan Renja</th>
                  <th style="width: 17%;">Alokasi Rp</th>
                  <th style="width: 17%;">Keuangan Rp</th>
                  <th style="width: 8%;">Keuangan %</th>
                  <!-- <th style="width: 8%;">Fisik %</th>
                  <th style="width: 8%;">KPI %</th> -->
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
  
  var id_program_renja = `<?=$contentData['id_program_renja']?>`;
  var tahun = `<?=$contentData['tahun']?>`;
  var tahun_label = $('.tahun_label');
  tahun_label.html(tahun);

  var realisasi = {};
  var fisik = {};
  var struktur_anggaran = {};
  var program_kegiatan = {};

  getRealisasiProgram();
  function getRealisasiProgram(){
    return $.ajax({
      url: "<?php echo site_url('SyncronizationController/getRealisasiProgram')?>",
      data : {'id_program_renja': id_program_renja},
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

  getStatusProgramKegiatan();
  function getStatusProgramKegiatan(){
    return $.ajax({
      url: "<?php echo site_url('SyncronizationController/countProgramKegiatan')?>",
      data : {id_program_renja: id_program_renja},
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        program_kegiatan = json['data'];
        $('#total_kegiatan').html(program_kegiatan['kegiatan']);
      },
      error: function(e) {}
    });
  }

  getStrukturAnggaran();
  function getStrukturAnggaran(){
    return $.ajax({
      url: "<?php echo site_url('SyncronizationController/getStrukturAnggaran')?>",
      data : {id_program_renja: id_program_renja},
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        struktur_anggaran = json['data'];
        
        renderStruktur("#struktur_anggaran_all", [['BTL', struktur_anggaran['btl']], ['BL', struktur_anggaran['bl']]], {'BTL': "#3e61ba", 'BL': "#b1ff57"});
        $("#total_belanja").html(`Rp${convertToRupiah(struktur_anggaran['belanja'])}`);

        renderStruktur("#struktur_anggaran_btl", [['Pegawai', struktur_anggaran['btl_pegawai']], ['Non Pegawai', struktur_anggaran['btl_non_pegawai']]], {'Pegawai': "#3e61ba", 'Non Pegawai': "#b1ff57"});
        $("#total_btl").html(`Rp${convertToRupiah(struktur_anggaran['btl'])}`);
        
        renderStruktur("#struktur_anggaran_bl", [['Pegawai', struktur_anggaran['bl_pegawai']], ['Non Pegawai', struktur_anggaran['bl_non_pegawai']]], {'Pegawai': "#3e61ba", 'Non Pegawai': "#b1ff57"});
        $("#total_bl").html(`Rp${convertToRupiah(struktur_anggaran['bl'])}`);

        renderStruktur("#struktur_anggaran_bl_non_pegawai", [['Barang Jasa', struktur_anggaran['barang_jasa']], ['Modal', struktur_anggaran['modal']]], {'Barang Jasa': "#3e61ba", 'Modal': "#b1ff57"});
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
  
  var allRealisasiKegiatan = {}
  var RealisasiKegiatanTable = $('#RealisasiKegiatanTable').DataTable({
    'columnDefs': [
      {"targets": [0], type: 'natural'},
      {"targets": [ 1, 2 ], "className": 'text-right'}, 
      {"targets": [ 3, 4 ], "className": 'text-center'}],
    pageLength: 10,
    dom: "<'row'<'col-sm-8'p><'col-sm-4'f>>" + 'Tt',
    paging: true,
  });
  
  getAllRealisasiKegiatan();
  function getAllRealisasiKegiatan(){
    return $.ajax({
      url: "<?php echo site_url('SyncronizationController/getAllRealisasiKegiatan')?>",
      data : {id_program_renja: id_program_renja},
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        allRealisasiKegiatan = json['data'];
        renderRealisasiKegiatan(allRealisasiKegiatan)
      },
      error: function(e) {}
    });
  }

  function renderRealisasiKegiatan(data){
    if(data == null || typeof data != "object"){
      console.log("NO REALISASI");
    }
    var i = 0;
    var renderData = [];
    Object.values(data).forEach((r) => {
      var detailBtn = `<a href="<?=site_url("KegiatanController/detail")?>?id_kegiatan_renja=${r['id_kegiatan_renja']}" class="btn btn-success btn-xs">Detail</a>`;
      renderData.push([`${r['id_kegiatan_renja']}::${r['nama_kegiatan_renja']}`, `${convertToRupiah(r['anggaran'])}`, `${convertToRupiah(r['realisasi_keuangan'])}`, coloriseRealisasi(r['capaian_keuangan']), 
      // coloriseRealisasi(r['realisasi_fisik']), coloriseRealisasi(r['kpi']), 
      `${detailBtn}`]);
    });
    RealisasiKegiatanTable.clear().rows.add(renderData).draw('full-hold');
  }

});
</script>