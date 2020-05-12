<?php $this->load->view('Fragment/HeaderFragment',['title' => $title]); ?>

<div class="loginColumns animated fadeInDown">
  <div class="row">
    <div class="col-md-6">
      <span class="text-center">
        <h3><img class="col-xs-6 col-lg-6 logo" src="<?php echo base_url('assets/img/logo-babel.png');?>"></h3>
        <h3 class="font-bold">SISTEM INFORMASI RAPID TEST & SWAB TEST</h3>
      </span>
      <!-- <h4 class="font-bold">Panduan: </h4> -->
      <!-- <div>1. <a href="<?=base_url('assets/Manual_Book_SIMDA_Syncronizer.pdf?v=0.0.1')?>" target="_blank">Manual Book dan Instalasi Android SIMDA Syncronizer</a></div> -->
    </div>
    <div class="col-md-6">
      <div class="ibox-content">
        <form id="loginForm"  class="m-t" role="form">
          <h3>Masuk</h3>
          <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Username" required="required" autocomplete="username">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required" autocomplete="current-password">
          </div>
          <button type="submit" id="loginBtn" class="btn btn-primary block full-width m-b" data-loading-text="Loging In...">Login</button>
      
        </form>
        <button type="submit" class="btn btn-primary block full-width m-b" value="Go to my link location"  onclick="window.location='<?=site_url()?>register';">Register Pasien Baru</button>
   
        <p class="m-t">
          <small>@developers</small>
        </p>
      </div>
    </div>
  </div>
  <hr>
  <div class="row">
      <div class="col-md-6">
        Rumah Sakit Kalbu Intan Medika
      </div>
      <div class="col-md-6 text-right">
          <small>© 2020</small>
          </div>
      </div>
  </div>
</div>
<style>
  .logo {
    flex: 0 0 50%;
    max-width: 50%;
  }
</style>
<script>
  $(document).ready(function() {

    var loginForm = $('#loginForm');
    var submitBtn = loginForm.find('#loginBtn');
    var aktifasi = `<?php if(!empty($contentData)) echo $contentData?>`;
 
    if(aktifasi != ''){
      if(aktifasi == 'Berhasil'){  
      swal("Aktifasi Berhasil", " ", "success");

      }else if(aktifasi == 'Gagal'){  
      swal("Aktifasi Gagal", " ", "error");
      
      }
    }
    loginForm.on('submit', (ev) => {
      ev.preventDefault();
      buttonLoading(submitBtn);
      $.ajax({
        url: "<?=site_url() . 'login-process'?>",
        type: "POST",
        data: loginForm.serialize(),
        success: (data) => {
          buttonIdle(submitBtn);
          json = JSON.parse(data);
          if(json['error']){
            swal("Login Gagal", json['message'], "error");
            return;
          }
          $(location).attr('href', '<?=site_url()?>' + json['user']['nama_controller']);
        },
        error: () => {
          buttonIdle(submitBtn);
        }
      });
    });

  });
</script>
<style> body { background-color: #f3f3f4!important; } </style>
<?php /*$this->load->view('Fragment/FooterFragment'); */?>
