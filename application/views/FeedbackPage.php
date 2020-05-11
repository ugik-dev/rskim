<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <form class="form-inline" id="showForm">
            <button type="button" class="btn btn-success my-1 mr-sm-2" id="addFeedbackBtn"  data-toggle='modal' data-target='#penelitianModal'><i class="fa fa-plus"></i> Tambah Feedback</button>
          </form>
          <hr>
          <div class="table-responsive">
            <table id="FDataTable" class="table table-bordered table-hover" style="padding:0px">
              <thead>
                <tr>
                  <th style="width: 7%">No</th>
                  <th style="width: 14%">Tanggal<br>Entri</th>
                  <th>Feedback</th>
                  <th style="width: 14%">Tanggal<br>Balas</th>
                  <th>Balasan</th>
                  <th style="width: 7%">Aksi</th>
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
            
<div class="modal inmodal" id="feedbackModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Form Feedback</h4>
                <span class="info"></span>
            </div>
            <div class="modal-body" id="modal-body">              
              <form role="form" id="feedbackForm" onsubmit="return false;" type="multipart">
                <div class="row">
                  <div class="col-sm">
                    <div class="form-group">
                      <label for="feedback">Feedback</label> 
                      <textarea type="text" id="feedback" class="form-control" name="feedback" required="required" rows="10"></textarea>
                    </div>
                  </div>
                </div>
                <button class="btn btn-success my-1 mr-sm-2" type="submit" id="send"><strong>Kirim</strong></button>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
           
<div class="modal inmodal" id="feedbackReplyModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Form Balasan Feedback</h4>
                <span class="info"></span>
            </div>
            <div class="modal-body" id="modal-body">              
              <form role="form" id="feedbackReplyForm" onsubmit="return false;" type="multipart">
                <input type="hidden" id="id_feedback" name="id_feedback">
                <div class="row">
                  <div class="col-sm">
                    <div class="form-group">
                      <label for="feedback_reply">Balasan Feedback</label> 
                      <textarea type="text" id="feedback_reply" class="form-control" name="feedback_reply" required="required" rows="10"></textarea>
                    </div>
                  </div>
                </div>
                <button class="btn btn-success my-1 mr-sm-2" type="submit" id="send"><strong>Kirim</strong></button>
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
  $('#feedback').addClass('active');
  var idFeedbackAdmin = '<?= $this->session->userdata("id_feedback_admin")?>';
  var addFeedbackBtn = $('#addFeedbackBtn');
  var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [
        {
          "targets": [0, 1, 3, 5], 
          "className": "text-center"
        },
        {
          "targets": [0, 2, 4, 5],
          "orderable": false
        }
    ],
    deferRender: true,
  });
  var feedbackModal = {
    self: $('#feedbackModal'),
    form: $('#feedbackForm'),
  }
  var feedbackReplyModal = {
    self: $('#feedbackReplyModal'),
    form: $('#feedbackReplyForm'),
    idFeedback: $('#id_feedback'),
  }
  var dataFeedback = [];

  initByRole();
  function initByRole(){
    if(!empty(idFeedbackAdmin)){
      addFeedbackBtn.hide();
    }
  }
  getFeedback();
  function getFeedback(){
    $.ajax({
      url: "<?php echo site_url('FeedbackController/getAllFeedback')?>",
      data : {},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataFeedback = json['feedbacks'];
        console.log(dataFeedback);
        renderFeedback(dataFeedback);
      },
      error: function(e) {}
    });
  }

  function renderFeedback(data){
    if(data == null || typeof data != "object"){
      console.log("Feedback::UNKNOWN DATA");
      return;
    }
    var i = 0;

    var renderData = Object.keys(data).reverse().map((k) => {
      var f = dataFeedback[k];

      var feedback = `
        ${f['username_user_f']} - ${f['nama_user_f']} - ${f['nama_prodi_f']} <br>
        ${f['feedback']}
      `;

      var reply = 'Belum dibalas';
      if(f['feedback_reply']){
        var reply = `
          ${f['nama_user_fr']}<br>
          ${f['feedback_reply']}
        `;
      }
      var tambahReplyButton = '';
      var deleteReplyButton = '';
      var deleteFeedbackButton = '';
      if(!empty(idFeedbackAdmin)){
        if(!f['feedback_reply']){
          var tambahReplyButton = `
            <a class="addFeedbackReply dropdown-item" data-idf='${f['id_feedback']}'><i class='fa fa-user'></i> Balas Feedback</a>
          `;
        } else {
          var deleteReplyButton = `
            <a class="deleteFeedbackReply dropdown-item" data-idf='${f['id_feedback']}' data-idfr='${f['id_feedback_reply']}'><i class='fa fa-trash'></i> Hapus Balasan</a>
          `;
        }
      } else {
        var deleteFeedbackButton = `
          <a class="deleteFeedback dropdown-item" data-idf='${f['id_feedback']}'><i class='fa fa-trash'></i> Hapus Feedback</a>
        `;
      }
      var button = `
        <div class="btn-group" role="group">
          <button id="action" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='fa fa-bars'></i></button>
          <div class="dropdown-menu" aria-labelledby="action">
            ${deleteFeedbackButton}
            ${tambahReplyButton}
            ${deleteReplyButton}
          </div>
        </div>
      `;

      return [ ++i, f['tanggal_entri_f'].substring(0, 10), feedback, !empty(f['tanggal_entri_fr']) ? f['tanggal_entri_fr'].substring(0, 10) : '-', reply, button ];
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
  }

  addFeedbackBtn.on('click', function(){
    feedbackModal.self.modal('show');
  });

  FDataTable.on('click', '.addFeedbackReply', function(){
    feedbackReplyModal.self.modal('show');
    var idf = $(this).data('idf');
    feedbackReplyModal.idFeedback.val(idf);
  });

  feedbackModal.form.on('submit', (ev) => {
    ev.preventDefault();
    $.ajax({
      url: "<?=site_url('FeedbackController/addfeedback')?>",
      type: "POST",
      data: feedbackModal.form.serialize(),
      success: (data) => {
        json = JSON.parse(data);
        if(json['error']){
          swal("Tambah Feedback Gagal", json['message'], "error");
          return;
        } 
        var feedback = json['feedback'];    
        swal("Berhasil dikirim", 'Terima kasih atas feedback yang diberikan', "success");

        dataFeedback[feedback['id_feedback']] = feedback;
        renderFeedback(dataFeedback);
        feedbackModal.form[0].reset();
        feedbackModal.self.modal('hide');
      },
      error: () => {}
    });
  });
  
  feedbackReplyModal.form.on('submit', (ev) => {
    ev.preventDefault();
    $.ajax({
      url: "<?=site_url('FeedbackController/addfeedbackreply')?>",
      type: "POST",
      data: feedbackReplyModal.form.serialize(),
      success: (data) => {
        json = JSON.parse(data);
        if(json['error']){
          swal("Tambah Balasan Feedback Gagal", json['message'], "error");
          return;
        } 
        var feedback = json['feedback'];    
        swal("Berhasil dikirim", 'Terima kasih atas feedback yang diberikan', "success");

        dataFeedback[feedback['id_feedback']] = feedback;
        renderFeedback(dataFeedback);
        feedbackReplyModal.form[0].reset();
        feedbackReplyModal.self.modal('hide');
      },
      error: () => {}
    });
  });

  var swalDeleteConfigure = {
    title: "Konfirmasi hapus",
    text: "Yakin akan menghapus data ini?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya, Hapus!",
  };

  FDataTable.on('click','.deleteFeedback', function(){
    event.preventDefault();

    var idf = $(this).data('idf');

    swal(swalDeleteConfigure).then((result) => {
      if(!result.value){ return; }
      $.ajax({
        url: "<?=site_url('FeedbackController/deletefeedback')?>",
        type: "POST",
        data : { id_feedback: idf },                   
        success: function (result){
          var json = JSON.parse(result);
          if(json['error']){
            swal("Hapus Gagal", json['message'], "error");
            return;
          }

          delete dataFeedback[idf];
          swal("Feedback Berhasil Dihapus", "", "success");
          renderFeedback(dataFeedback);
        },
        error: function(status){}
      });
    });
  });

  FDataTable.on('click','.deleteFeedbackReply', function(){
    event.preventDefault();

    var idf = $(this).data('idf');
    var idfr = $(this).data('idfr');

    swal(swalDeleteConfigure).then((result) => {
      if(!result.value){ return; }
      $.ajax({
        url: "<?=site_url('FeedbackController/deletefeedbackreply')?>",
        type: "POST",
        data : { id_feedback: idf, id_feedback_reply: idfr },                   
        success: function (result){
          var json = JSON.parse(result);
          if(json['error']){
            swal("Hapus Gagal", json['message'], "error");
            return;
          }
          
          var feedback = json['feedback'];    
          dataFeedback[feedback['id_feedback']] = feedback;
          renderFeedback(dataFeedback);

          swal("Balasan Feedback Berhasil Dihapus", "", "success");
        },
        error: function(status){}
      });
    });
  });

  feedbackModal.self.on('hidden.bs.modal', function(){
    feedbackModal.form[0].reset();
  });

  feedbackReplyModal.self.on('hidden.bs.modal', function(){
    feedbackReplyModal.form[0].reset();
  });
});
</script>
