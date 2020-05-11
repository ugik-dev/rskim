<div class="wrapper wrapper-content animated fadeInRight">
  <div class="ibox ssection-container">
    <div class="ibox-content">
      <form class="form-inline" id="showForm" onsubmit="return false;">
        <select class="form-control mr-sm-2" name="tahun" id="tahun" required="required">
          <option value>-- Pilih Periode --</option>
          <option value='2018'>2017 - 2022</option>
          <option value='2014'>2012 - 2017</option>
        </select>  
        <button type="submit" class="btn btn-success my-1 mr-sm-2" id="show_btn" data-loading-text="Loading..."><i class="fal fa-eye"></i> Tampilkan</button>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <div class="table-responsive">
            <table id="FDataTable" class="table table-bordered table-hover" style="padding:0px">
              <thead>
                <tr>
                  <th style="width: 7%; text-align:center!important">ID</th>
                  <th style="width: 40%; text-align:center!important">Sasaran RPJMD</th>
                  <th style="width: 40%; text-align:center!important">Indikator Sasaran RPJMD</th>
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
<script type="text/javascript">
$(document).ready(function() {
  $('#cascade').addClass('active');
  $('#cascade_rpjmd').addClass('active');

  var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [],
    deferRender: true,
    searching: false,
    ordering: false,
    paging: false,
  });

  SSection = {
    'form': $('#showForm'),
    'tahun': $('#tahun'),
    'showBtn': $('#show_btn')
  }

  SSection.form.on('submit', function(e){
    e.preventDefault();
    getSasaranRPJMDIndikator();
  });

  function getSasaranRPJMDIndikator(){
    buttonLoading(SSection.showBtn)
    $.ajax({
      url: `<?php echo site_url('OPPerencanaanController/getSasaranRPJMD/')?>`,
      data : SSection.form.serialize(),
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataCascadeIndikator = json['data'];
        renderCascadeIndikator(dataCascadeIndikator);
        buttonIdle(SSection.showBtn)
      },
      error: function(e) {}
    });
  }

  function renderCascadeIndikator(data){
    if(data == null || typeof data != "object"){
      console.log("CascadeIndikator::UNKNOWN DATA");
      return;
    }
    var i = 0;
    
    var renderData = [];
    var counter = 1;
    Object.values(data).forEach((rpjmd) => {
      var indikator_rpjmd_str =  Object.keys(rpjmd['indikator_sasaran_rpjmd'])[0] == '' ? ['-'] : 
        Object.values(rpjmd['indikator_sasaran_rpjmd']).map((indikator_rpjmd) => {
          return `${indikator_rpjmd['id_indikator_sasaran_rpjmd']} :: ${indikator_rpjmd['nama_indikator_sasaran_rpjmd']} - ${indikator_rpjmd['target1']} ${indikator_rpjmd['satuan']} (1) | ${indikator_rpjmd['target2']} ${indikator_rpjmd['satuan']} (2) | ${indikator_rpjmd['target3']} ${indikator_rpjmd['satuan']} (3) | ${indikator_rpjmd['target4']} ${indikator_rpjmd['satuan']} (4) | ${indikator_rpjmd['target5']} ${indikator_rpjmd['satuan']} (5)`
        })
      renderData.push([rpjmd['id_sasaran_rpjmd'], rpjmd['nama_sasaran_rpjmd'], indikator_rpjmd_str.join('<br>'), '-'])
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
  }
});
</script>
