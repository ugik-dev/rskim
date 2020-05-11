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
    <!-- <div class="col-lg-4">
      <div class="ibox">
        <div class="ibox-content bg-info">
          <h5>Fisik Sampai Saat Ini</h5>
          <h2 class="no-margins"><span id="realisasi_fisik">0%</span></h2>
          <div class="stat-percent font-bold text-navy">-</div>
          <small>-</small>
        </div>
      </div>
    </div> -->
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

</div>
<script>
$(document).ready(function() {
  var id_kegiatan_renja = `<?=$contentData['id_kegiatan_renja']?>`;
  var tahun_label = $('.tahun_label');
  tahun_label.html(tahun);

  var realisasi = {};
  var fisik = {};
  var struktur_anggaran = {};

  getRealisasiKegiatan();
  function getRealisasiKegiatan(){
    return $.ajax({
      url: "<?php echo site_url('SyncronizationController/getRealisasiKegiatan')?>",
      data : {'id_kegiatan_renja': id_kegiatan_renja},
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

  getStrukturAnggaran();
  function getStrukturAnggaran(){
    return $.ajax({
      url: "<?php echo site_url('SyncronizationController/getStrukturAnggaran')?>",
      data : {'id_kegiatan_renja': id_kegiatan_renja},
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        struktur_anggaran = json['data'];
        
        renderStruktur("#struktur_anggaran_all", [['BTL', struktur_anggaran['btl']], ['BL', struktur_anggaran['bl']]], {'BTL': "#9b4bbd", 'BL': "#67ffab"});
        $("#total_belanja").html(`Rp${convertToRupiah(struktur_anggaran['belanja'])}`);

        renderStruktur("#struktur_anggaran_btl", [['Pegawai', struktur_anggaran['btl_pegawai']], ['Non Pegawai', struktur_anggaran['btl_non_pegawai']]], {'Pegawai': "#9b4bbd", 'Non Pegawai': "#67ffab"});
        $("#total_btl").html(`Rp${convertToRupiah(struktur_anggaran['btl'])}`);
        
        renderStruktur("#struktur_anggaran_bl", [['Pegawai', struktur_anggaran['bl_pegawai']], ['Non Pegawai', struktur_anggaran['bl_non_pegawai']]], {'Pegawai': "#9b4bbd", 'Non Pegawai': "#67ffab"});
        $("#total_bl").html(`Rp${convertToRupiah(struktur_anggaran['bl'])}`);

        renderStruktur("#struktur_anggaran_bl_non_pegawai", [['Barang Jasa', struktur_anggaran['barang_jasa']], ['Modal', struktur_anggaran['modal']]], {'Barang Jasa': "#9b4bbd", 'Modal': "#67ffab"});
        $("#total_bl_non_pegawai").html(`Rp${convertToRupiah(struktur_anggaran['bl_non_pegawai'])}`);
        swal.close();
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
});
</script>