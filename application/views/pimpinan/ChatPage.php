<div class="wrapper wrapper-content animated fadeInRight">
  <div class="ibox ssection-container">
    <div class="ibox-content">
      <form class="form-inline" id="toolbar_form" onsubmit="return false;">
        <select class="form-control mr-sm-2" name="id_opd" id="id_opd" style="width:400px"></select>
        <button type="button" class="btn btn-success my-1 mr-sm-2" id="new_btn" disabled="disabled"><i class="fal fa-plus"></i> Tambah Chat Baru</button>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <div class="table-responsive">
            <table id="ChatDataTable" class="table table-bordered" style="padding:0px">
              <thead>
                <tr>
                  <th style="width: 90%;">Chat</th>
                  <th style="width: 5%;">Replies</th>
                  <th style="width: 5%;">Action</th>
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

<div class="modal inmodal" id="chat_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Kelola Chat</h4>
        <span class="info"></span>
      </div>
      <div class="modal-body" id="modal-body">              
        <form role="form" id="chat_form" onsubmit="return false;" type="multipart" autocomplete="off">
          <input type="hidden" id="id_chat" name="id_chat">
          <div class="form-group">
            <label for="id_ref">Ditujukan Ke</label> 
            <select class="form-control mr-sm-2" name="id_ref" id="id_ref"></select>
          </div>
          <div class="form-group">
            <label for="judul">Judul</label> 
            <textarea placeholder="Subject Chat" class="form-control" id="judul" name="judul" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label for="isi">Chat</label> 
            <textarea placeholder="Isi Chat" class="form-control" id="isi" name="isi" rows="9"></textarea>
          </div>
          <div class="form-group">
            <label for="add_attachment">Attachment</label>
            <div id="ca_container"></div>
          </div>
          <button class="btn btn-success my-1 mr-sm-2" type="submit" id="add_btn" data-loading-text="Loading..."><strong>Kirim</strong></button>
          <button class="btn btn-success my-1 mr-sm-2" type="submit" id="save_edit_btn" data-loading-text="Loading..."><strong>Simpan Perubahan</strong></button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal inmodal" id="reply_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Chat</h4>
      </div>
      <div class="modal-body" id="modal-body">
        <div class="info" style="text-align: justify;margin-bottom: 8px;"></div>
        <div class="table-responsive">
          <table id="ReplyDataTable" class="table table-bordered" style="padding:0px;width:100%">
            <thead>
              <tr>
                <th style="width: 15%">User</th>
                <th style="width: 80%">Reply</th>
                <th style="width: 5%">Action</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
        <form role="form" id="reply_form" onsubmit="return false;" type="multipart" autocomplete="off">
          <input type="hidden" id="id_chat" name="id_chat">
          <input type="hidden" id="id_reply" name="id_reply">
          <input type="hidden" id="reply_to" name="reply_to">
          <div class="form-group" id="container_reply_to">
            <label for="isi_reply_to">Reply Ke</label> 
            <textarea placeholder="Isi Chat" class="form-control" id="isi_reply_to" name="isi_reply_to" rows="3" readonly="readonly"></textarea>
          </div>
          <div class="form-group">
            <label for="isi_reply">Isi</label> 
            <textarea placeholder="Isi Chat" class="form-control" id="isi_reply" name="isi" rows="5"></textarea>
          </div>
          <button class="btn btn-success my-1 mr-sm-2" type="submit" id="add_btn" data-loading-text="Loading..."><strong>Kirim</strong></button>
          <button class="btn my-1 mr-sm-2" type="reset"><strong>Batal</strong></button>
          <!-- <button class="btn btn-success my-1 mr-sm-2" type="submit" id="save_edit_btn" data-loading-text="Loading..." onclick="this.form.target='save'"><strong>Simpan Perubahan</strong></button> -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="<?=base_url('assets/')?>js/FileUploaderV2.js"></script>
<style>
  th { font-size: 12px; text-align:center!important}
</style>

<script>
$(document).ready(function() {
  $('#chat').addClass('active');
  var sessionData = JSON.parse(`<?=json_encode(DataStructure::slice($this->session->userdata(), ['id_opd', 'id_user']))?>`);
  
  var toolbar = {
    'form': $('#toolbar_form'),
    'newBtn': $('#new_btn'),
    'id_opd': $('#id_opd'),
  }
  
  // if(!empty(sessionData['id_opd'])) toolbar.newBtn.toggle(false);

  var ChatDataTable = $('#ChatDataTable').DataTable({
    'columnDefs': [{"targets": [0], type: 'natural'}],
    deferRender: true,
    "order": [[ 0, "desc" ]],
  });

  var ChatModal = {
    'self': $('#chat_modal'),
    'info': $('#chat_modal').find('.info'),
    'form': $('#chat_modal').find('#chat_form'),
    'addBtn': $('#chat_modal').find('#add_btn'),
    'saveEditBtn': $('#chat_modal').find('#save_edit_btn'),
    'id_chat': $('#chat_modal').find('#id_chat'),
    'id_ref': $('#chat_modal').find('#id_ref'),
    'judul': $('#chat_modal').find('#judul'),
    'isi': $('#chat_modal').find('#isi'),
  }

  var ReplyDataTable = $('#ReplyDataTable').DataTable({
    dom:'pTt',
    paging: true,
    deferRender: true,
    "autoWidth": false,
    ordering: false,
    'columnDefs': [{ targets: [0], className: 'text-center'}],
  });

  var ReplyModal = {
    'self': $('#reply_modal'),
    'info': $('#reply_modal').find('.info'),
    'form': $('#reply_modal').find('#reply_form'),
    'addBtn': $('#reply_modal').find('#add_btn'),
    'saveEditBtn': $('#reply_modal').find('#save_edit_btn'),
    'id_chat': $('#reply_modal').find('#id_chat'),
    'id_reply': $('#reply_modal').find('#id_reply'),
    'container_reply_to': $('#reply_modal').find('#container_reply_to'),
    'reply_to': $('#reply_modal').find('#reply_to'),
    'isi_reply_to': $('#reply_modal').find('#isi_reply_to'),
    'isi': $('#reply_modal').find('#isi'),
  }

  var dataOPD = {}
  var dataChat = {}

  var swalDeleteConfigure = {
    title: "Konfirmasi hapus",
    text: "Yakin akan menghapus chat ini?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya, Hapus!",
  };


  $.when(getAllSOPD()).then((e) =>{
    ca_uploader.registerDeleteHandler((ctx, id) => { 
      var isNew = ctx.parent.addBtn.is(':visible');
      var idp = !isNew ? ctx.parent.id_chat.val() : null;
      if(idp) delete dataChat[idp]['attachment'][id] 
    });
    toolbar.newBtn.prop('disabled', false);
  }).fail((e) => { console.log(e) });

  function getAllSOPD(){
    return $.ajax({
      url: `<?php echo site_url('SharedController/getAllSOPD/')?>`, 'type': 'GET',
      data: {},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataOPD = json['data'];
        renderOPDOption(dataOPD);
        renderOPDOptionSection(dataOPD);
        toolbar.id_opd.val(null).trigger('change');
      },
      error: function(e) {}
    });
  }

  function renderOPDOption(data){
    ChatModal.id_ref.empty();
    ChatModal.id_ref.append($('<option>', { value: "", text: "-- SEMUA OPD --"}));
    Object.values(data).forEach((d) => {
      ChatModal.id_ref.append($('<option>', {
        value: d['id_opd'],
        text: d['id_opd'] + '::' + d['nama_opd'],
      }));
    });
  }
  
  function renderOPDOptionSection(data){
    toolbar.id_opd.empty();
    toolbar.id_opd.append($('<option>', { value: "", text: "-- SEMUA CHAT --"}));
    toolbar.id_opd.append($('<option>', { value: -1, text: "-- SEMUA OPD --"}));
    Object.values(data).forEach((d) => {
      toolbar.id_opd.append($('<option>', {
        value: d['id_opd'],
        text: d['id_opd'] + '::' + d['nama_opd'],
      }));
    });
  }

  toolbar.id_opd.on('change', (e) => {
    getAllChat();
    ChatModal.id_ref.attr('readonly', !empty(toolbar.id_opd.val()));
  });
  
  function getAllChat(){
    return $.ajax({
      url: `<?php echo site_url('ChatController/getAll/')?>`, 'type': 'GET',
      data: toolbar.form.serialize(),
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataChat = json['data'];
        renderChat(dataChat);
      },
      error: function(e) {}
    });
  }

  function renderChat(data){
    if(data == null || typeof data != "object"){
      console.log("User::UNKNOWN DATA");
      return;
    }
    var i = 0;
    
    var renderData = [];
    Object.values(data).forEach((chat) => {
      var haveAccess = sessionData['id_user'] == chat['created_by'];
      var replyButton = `<button type="button" class="reply btn btn-plain btn-sm" data-id='${chat['id_chat']}'>${Object.keys(chat['replies']).length} <i class="fal fa-comment-dots"></i></button>`;
      
      var editButton = `
        <a class="edit dropdown-item" data-id='${chat['id_chat']}'><i class='fa fa-pencil'></i> Edit Chat</a>
      `;
      var deleteButton = `
        <a class="delete dropdown-item" data-id='${chat['id_chat']}'><i class='fa fa-trash'></i> Hapus Chat</a>
      `;
      var actionButton = `
        <div class="btn-group" role="group">
          <button id="action" type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='fa fa-bars'></i></button>
          <div class="dropdown-menu" aria-labelledby="action">
            ${editButton}
            ${deleteButton}
          </div>
        </div>
      `;
      var ref = chat['id_ref'] ? `<span class="label label-info">Untuk: ${chat['id_ref']}::${chat['nama_ref']}</span>` : 
        `<span class="label label-primary">Untuk: Semua OPD</span>`;

      var chat = `
        <span class="label label-plain">ID:${chat['id_chat']}</span>
        <span class="label label-plain">${chat['created_at']}</span>
        <span class="label label-plain">Dari: ${chat['nama_ts']}</span>
        ${ref}<br>
        ${chat['judul']}
      `;
      renderData.push([chat,  replyButton, haveAccess ? actionButton : '']);
    });
    ChatDataTable.clear().rows.add(renderData).draw('full-hold');
  }

  function resetChatModal(){
    ChatModal.form.trigger('reset');
    ChatModal.id_ref.val(toolbar.id_opd.val() != -1 ? toolbar.id_opd.val() : "");
  }
  
  toolbar.newBtn.on('click', (e) => {
    resetChatModal();
    ChatModal.self.modal('show');
    ChatModal.addBtn.show();
    ChatModal.saveEditBtn.hide();
    ca_uploader.updateAttachment([]);
  });
  
  ChatDataTable.on('click', '.edit', function(){
    resetChatModal();
    ChatModal.self.modal('show');
    ChatModal.addBtn.hide();
    ChatModal.saveEditBtn.show();
    
    var currentData = dataChat[$(this).data('id')];
    ChatModal.id_chat.val(currentData['id_chat']);
    ChatModal.id_ref.val(currentData['id_ref']);
    ChatModal.judul.val(currentData['judul']);
    ChatModal.isi.val(currentData['isi']);
    ca_uploader.updateAttachment(currentData['attachment']);
  });

  ChatModal.form.submit(function(event) {
    event.preventDefault();
    var isAdd = ChatModal.addBtn.is(':visible');
    var url = "<?=site_url('ChatController/')?>";
    url += isAdd ? "add" : "edit";
    var button = isAdd ? ChatModal.addBtn : ChatModal.saveEditBtn;

    buttonLoading(button);
    $.ajax({
      url: url, 'type': 'POST',
      data: ChatModal.form.serialize(),
      success: function (data){
        buttonIdle(button);
        var json = JSON.parse(data);
        if(json['error']){
          swal(isAdd ? "Gagal dikirim" : "Gagal disimpan", json['message'], "error");
          return;
        }
        var chat = json['data']
        dataChat[chat['id_chat']] = chat;
        swal(isAdd ? "Chat dikirim" : "Perubahan disimpan", "", "success");
        renderChat(dataChat);
        ChatModal.self.modal('hide');
      },
      error: function(e) {}
    });
  });

  ChatDataTable.on('click','.delete', function(){
    event.preventDefault();
    var id = $(this).data('id');
    swal(swalDeleteConfigure).then((result) => {
      if(!result.value){ return; }
      $.ajax({
        url: "<?=site_url('ChatController/delete')?>", 'type': 'POST',
        data: {'id_chat': id},
        success: function (data){
          var json = JSON.parse(data);
          if(json['error']){
            swal("Delete Gagal", json['message'], "error");
            return;
          }
          delete dataChat[id];
          swal("Delete Berhasil", "", "success");
          renderChat(dataChat);
        },
        error: function(e) {}
      });
    });
  });

  ChatDataTable.on('click', '.reply', function(){
    ReplyModal.form.trigger('reset');
    ReplyModal.self.modal('show');
    var currentData = dataChat[$(this).data('id')];
    var ref = chat['id_ref'] ? `<span class="label label-info">Untuk: ${chat['id_ref']}::${chat['nama_ref']}</span>` : 
        `<span class="label label-primary">Untuk: Semua OPD</span>`;
    var info = `
      <span class="label label-plain">ID:${currentData['id_chat']}</span>
      <span class="label label-plain">${currentData['created_at']}</span>
      <span class="label label-plain">Dari: ${currentData['nama_ts']}</span>
      ${ref}
      <h3>${currentData['judul']}</h3>
      <span>${currentData['isi']}</span>
      <div id="car_container"></div>
    `;
    ReplyModal.info.html(info);
    var car_uploader = new FileUploaderV2($('#car_container'), {'add': "", 'delete': ""}, 'id_chat_attachment', ReplyModal);
    car_uploader.updateAttachment(currentData['attachment'], true);
    ReplyModal.id_chat.val(currentData['id_chat']);
    ReplyModal.reply_to.val(null).trigger('change');
    renderReply(currentData);
  });

  ReplyModal.reply_to.on('change', function(e){
    var id_chat = ReplyModal.id_chat.val();
    var reply_to = ReplyModal.reply_to.val();
    var is_reply_to = !empty(reply_to);
    ReplyModal.container_reply_to.toggle(is_reply_to);
    if(!is_reply_to) return;
    var currentData = dataChat[id_chat]['replies'][reply_to];
    ReplyModal.isi_reply_to.val(currentData['isi_reply']);
  });

  function renderReply(data){
    if(data == null || typeof data != "object"){
      console.log("User::UNKNOWN DATA");
      return;
    }
    var i = 0;
    
    var renderData = [];
    Object.values(data['replies']).forEach((reply) => {
      var haveAccess = sessionData['id_user'] == reply['tr_created_by'];
      
      var replyButton = `<a class="reply dropdown-item" data-idp='${data['id_chat']}' data-id='${reply['id_reply']}'><i class='fa fa-reply'></i> Reply</a>`;
      
      var editButton = `
        <a class="edit dropdown-item" data-idp='${data['id_chat']}' data-id='${reply['id_reply']}'><i class='fa fa-pencil'></i> Edit</a>
      `;
      var deleteButton = `
        <a class="delete dropdown-item" data-idp='${data['id_chat']}' data-id='${reply['id_reply']}'><i class='fa fa-trash'></i> Hapus</a>
      `;
      var actionButton = `
        <div class="btn-group" role="group">
          <button id="action" type="button" class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='fa fa-bars'></i></button>
          <div class="dropdown-menu" aria-labelledby="action">
            ${replyButton}
            ${haveAccess ? deleteButton : ''}
          </div>
        </div>
      `;
      var replier = `<img src="${reply['photo_replier'] ? reply['photo_replier'] : ''}" class="rounded img-sm"><br><span style="font-size:11px">${reply['nama_replier']}</span>`;
      var reply_to = reply['id_reply_to'] ? `<div class="bg-muted p-xxs"><i class='fa fa-reply'></i> Reply to: ${reply['nama_replier_to']}<br>${reply['isi_reply_to']}</div>` : '';

      var reply = `
        ${reply_to}
        ${reply['isi_reply']}
      `;
      renderData.push([replier, reply, actionButton]);
    });
    ReplyDataTable.clear().rows.add(renderData).draw('full-hold').page('last').draw(false);
  }
  
  ReplyModal.form.submit(function(event) {
    event.preventDefault();
    var isAdd = ReplyModal.addBtn.is(':visible');
    var url = "<?=site_url('ChatController/')?>";
    url += isAdd ? "addReply" : "editReply";
    var button = isAdd ? ReplyModal.addBtn : ReplyModal.saveEditBtn;

    buttonLoading(button);
    $.ajax({
      url: url, 'type': 'POST',
      data: ReplyModal.form.serialize(),
      success: function (data){
        buttonIdle(button);
        var json = JSON.parse(data);
        if(json['error']){
          swal(isAdd ? "Gagal dikirim" : "Gagal tersimpan", json['message'], "error");
          return;
        }
        var chat = json['data']
        dataChat[chat['id_chat']] = chat;
        swal(isAdd ? "Chat dikirim" : "Perubahan disimpan", "", "success");
        renderChat(dataChat);
        renderReply(chat);
        ReplyModal.form.trigger('reset');
      },
      error: function(e) {}
    });
  });

  ReplyModal.form.on('reset', function(event) {
    ReplyModal.reply_to.val(null).trigger('change');
  });

  ReplyDataTable.on('click','.delete', function(){
    event.preventDefault();
    var idp = $(this).data('idp');
    var id = $(this).data('id');
    swal(swalDeleteConfigure).then((result) => {
      if(!result.value){ return; }
      $.ajax({
        url: "<?=site_url('ChatController/deleteReply')?>", 'type': 'POST',
        data: {'id_reply': id},
        success: function (data){
          var json = JSON.parse(data);
          if(json['error']){
            swal("Delete Gagal", json['message'], "error");
            return;
          }
          delete dataChat[idp]['replies'][id];
          swal("Delete Berhasil", "", "success");
          renderReply(dataChat[idp]);
        },
        error: function(e) {}
      });
    });
  });

  ReplyDataTable.on('click', '.reply', function(){
    ReplyModal.reply_to.val($(this).data('id')).trigger('change');
  });

  var ca_uploader = new FileUploaderV2($('#ca_container'), {'add': "<?=site_url('ChatController/addChatAttachment')?>", 'delete': "<?=site_url('ChatController/deleteChatAttachment')?>"}, 'id_chat_attachment', ChatModal);
});
</script>