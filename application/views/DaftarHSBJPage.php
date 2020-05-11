<div class="wrapper wrapper-content animated fadeInRight">
  <div class="ibox ssection-container">
    <div class="ibox-content">
      <form class="form-inline" id="showForm" onsubmit="return false;">
        <select class="form-control mr-sm-2" name="tahun" id="tahun" required="required"></select>  
        <select class="form-control mr-sm-2" name="id_jenis_hsbj" id="id_jenis_hsbj" style="width:300px"></select>
        <select class="form-control mr-sm-2" name="id_sub_jenis_hsbj" id="id_sub_jenis_hsbj" style="width:300px"></select>
        <button type="submit" class="btn btn-success my-1 mr-sm-2" id="show_btn" data-loading-text="Loading..." disabled="disabled" onclick="this.form.target='show'"><i class="fal fa-eye"></i> Tampilkan</button>
        <button type="submit" class="btn btn-success my-1 mr-sm-2" id="download_excel_btn" disabled="disabled" onclick="this.form.target='download_excel'"><i class="fal fa-file-spreadsheet"></i> Download Excel</button>
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
                  <th style="width:13%">Jenis HSBJ</th>
                  <th style="width:13%">Sub Jenis HSBJ</th>
                  <th style="width:9%">Kode<br>HSBJ</th>
                  <th style="width:25%">Nama</th>
                  <th style="width:20%">Spesifikasi</th>
                  <th style="width:8%">Satuan</th>
                  <th style="width:12%">Harga</th>
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
  th { text-align: center; }
  td { font-size: 11px; padding-left: 4px; }
</style>    
<script type="text/javascript">
$(document).ready(function() {
  $('#hsbj').addClass('active');
  $('#daftar_hsbj').addClass('active');

  var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [{ targets: [2, 5], className: 'text-center'}, { targets: [6], className: 'text-right'}],
    ordering: false,
    paging: true,
    rowsGroup: [0, 1],
  });

  var SSection = {
    'form': $('#showForm'),
    'tahun': $('#tahun'),
    'id_jenis_hsbj': $('#id_jenis_hsbj'),
    'id_sub_jenis_hsbj': $('#id_sub_jenis_hsbj'),
    'showBtn': $('#show_btn'),
    'download_excel_btn': $('#download_excel_btn')
  }

  var currentDate = new Date();
  var currentYear = currentDate.getFullYear();
  for(var i = currentYear + 2; i >= 2017; i--){
    SSection.tahun.append($('<option>', { value: i, text: i }));
  }
  
  var dataJenisHSBJ = {};
  var dataHSBJ = {};
  
  SSection.tahun.on('change', function(e){
    SSection.showBtn.prop('disabled', true);
    SSection.download_excel_btn.prop('disabled', true);
    $.when(getAllJenisHSBJ()).done(() => {
      SSection.showBtn.prop('disabled', false);
      SSection.download_excel_btn.prop('disabled', false);
    })
  });
  SSection.tahun.val(currentYear + 1).trigger('change');
  
  function getAllJenisHSBJ(){
    return $.ajax({
      url: "<?php echo site_url('HSBJController/getAllJenisHSBJ')?>",
      data : SSection.form.serialize(),
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataJenisHSBJ = json['data'];
        renderJenisHSBJ(dataJenisHSBJ);
        renderSubJenisHSBJ([]);
      },
      error: function(e) {}
    });
  }

  function renderJenisHSBJ(data){
    SSection.id_jenis_hsbj.empty();
    SSection.id_jenis_hsbj.append($('<option>', { value: "", text: "-- SEMUA JENIS HSBJ --"}));
    Object.values(data).forEach((e) => {
      SSection.id_jenis_hsbj.append($('<option>', {
        value: e['id_jenis_hsbj'],
        text: `${e['id_jenis_hsbj']}::${e['nama_jenis_hsbj']}`,
      }));
    });
  }

  SSection.id_jenis_hsbj.on('change', function(e){
    var id_jenis_hsbj = SSection.id_jenis_hsbj.val();
    renderSubJenisHSBJ(!empty(id_jenis_hsbj) ? dataJenisHSBJ[id_jenis_hsbj]['sub_jenis_hsbj'] : []);
  });

  function renderSubJenisHSBJ(data){
    SSection.id_sub_jenis_hsbj.empty();
    SSection.id_sub_jenis_hsbj.append($('<option>', { value: "", text: "-- SEMUA SUB JENIS HSBJ --"}));
    Object.values(data).forEach((e) => {
      SSection.id_sub_jenis_hsbj.append($('<option>', {
        value: e['id_sub_jenis_hsbj'],
        text: `${e['id_sub_jenis_hsbj']}::${e['nama_sub_jenis_hsbj']}`,
      }));
    });
  }

  SSection.form.on('submit', function(e){
    event.preventDefault();
    switch(SSection.form[0].target){
      case 'show':
        showHSBJ();
        break;
      case 'download_excel':
        downloadExcel();
        break;
    }   
     
  });

  function showHSBJ(){
    buttonLoading(SSection.showBtn)
    $.when(getAllHSBJ()).done(function(){
      renderHSBJ(dataHSBJ);
    }).then((e) => {
      buttonIdle(SSection.showBtn)
    });
  }

  function downloadExcel(){
    window.location.href = `<?=site_url()?>HSBJController/getHSBJExcel/?${SSection.form.serialize()}`;
  }

  function getAllHSBJ(){
    return $.ajax({
      url: `<?php echo site_url('HSBJController/getAll/')?>`,
      data : SSection.form.serialize(),
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataHSBJ = json['data'];
        renderHSBJ(dataHSBJ);
      },
      error: function(e) {}, 
    });
  }

  function renderHSBJ(data){
    if(data == null || typeof data != "object"){
      console.log("HSBJ::UNKNOWN DATA");
      return;
    }
    var renderData = [];
    Object.values(data).forEach((h) => {
      renderData.push([h['nama_jenis_hsbj'], h['nama_sub_jenis_hsbj'], h['c_id_hsbj'], h['nama_hsbj'], h['spesifikasi_hsbj'], h['nama_satuan_hsbj'], convertToRupiahV2(h['harga_hsbj'], 3)]);
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
  }

});
</script>
