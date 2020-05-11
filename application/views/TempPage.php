<div class="row">
  <div class="col-lg-3">
    <div class="ibox">
      <div class="ibox-content">
        <h5>Progress Keuangan & Fisik 2019</h5>
        <div id="progress_keuangan_fisik"></div>
        <div class="stat-percent font-bold text-navy">-</div>
        <small>-</small>
      </div>
    </div>
  </div>
</div>

var data = {
    'keuangan%': ['keuangan', 10, 20, 24, 35, 50], 
    'keuanganRp': ['keuangan', 14000000, 20, 24, 35, 50], 
    'fisik%': ['fisik',  12, 18, 30, 34, 60],
    'fisikRp': ['fisik',  12, 18, 30, 34, 60]
  };
  var progress_keuangan_fisik = c3.generate({
    bindto: '#progress_keuangan_fisik',
    data: {
      columns: [
          ['keuangan', 10, 20, 24, 35, 50, null, null, null, null, null, null, null],
          ['fisik',  12, 18, 30, 34, 60],
      ],
    },
    size: {
      height: 170,
    },
    axis: {
      y: {min: 0, max: 100},
      x: {min: 1, max: 12}
    },
    tooltip: {
      format: {
        value: function (v, r, id){
          return `Rp${convertToRupiah(data[id])}`;
        }
      }
    }
  });
