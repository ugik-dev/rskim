<div class="wrapper wrapper-content animated fadeInRight">
  <div class="ibox ssection-container">
    <div class="ibox-content">
      <form class="form-inline" id="toolbar_form" onsubmit="return false;">
        <input type="hidden" id="id_opd" name="id_opd" value="<?=$this->session->userdata('id_opd')?>">
        <input type="hidden" id="id_role" name="id_role" value="3">
        <input type="hidden" id="eselon" name="eselon" value="2">
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
                  <th style="width: 42%; text-align:center!important">Nama</th>
                  <th style="width: 42%; text-align:center!important">Jabatan</th>
                  <th style="width: 10%; text-align:center!important">Eselon</th>
                  <th style="width: 5%; text-align:center!important">Action</th>
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

<script>
$(document).ready(function() {
  $('#daftar_pimpinan').addClass('active');

  var toolbar = {
    'form': $('#toolbar_form'),
    'id_opd': $('#toolbar_form').find('#id_opd'),
  }

  var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [],
    deferRender: true,
    "order": [[ 0, "desc" ]]
  });

  var dataUser = {}

  $.when(getAllUser()).then((e) =>{
  }).fail((e) => { console.log(e) });

  function getAllUser(){
    swal({title: 'Loading user...', allowOutsideClick: false});
    swal.showLoading();
    return $.ajax({
      url: `<?php echo site_url('UserController/getAllUser/')?>`, 'type': 'GET',
      data: toolbar.form.serialize(),
      success: function (data){
        swal.close();
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataUser = json['data'];
        renderUser(dataUser);
      },
      error: function(e) {}
    });
  }

  function renderUser(data){
    if(data == null || typeof data != "object"){
      console.log("User::UNKNOWN DATA");
      return;
    }
    var i = 0;
    
    var renderData = [];
    Object.values(data).forEach((user) => {
      var detailBtn = `<a href="<?=site_url("UserController/detail_user/")?>?id_sub_opd=${user['id_sub_opd']}" class="btn btn-success btn-xs">Detail</a>`;
      renderData.push([user['nama'], user['jabatan'], user['eselon'], detailBtn]);
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
  }
});
</script>