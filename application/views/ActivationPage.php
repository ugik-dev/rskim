<?php $this->load->view('Fragment/HeaderFragment',['title' => 'Activation']); ?>

<div class="loginColumns animated fadeInDown">
  <div class="row">
    <div class="col-md-6">
      <span class="text-center">
        <h3><img class="col-xs-6 col-lg-6 logo" src="<?php echo base_url('assets/img/logo-babel.png');?>"></h3>
        <h3 class="font-bold">AKTIFASI DATA  
  
    </h3>
      </span>
      <!-- <h4 class="font-bold">Panduan: </h4> -->
      <!-- <div>1. <a href="<?=base_url('assets/Manual_Book_SIMDA_Syncronizer.pdf?v=0.0.1')?>" target="_blank">Manual Book dan Instalasi Android SIMDA Syncronizer</a></div> -->
    </div>
    <div class="col-md-6">
      <div class="ibox-content">
        <p class="m-t">
          <small>@developers</small>
        </p>
      </div>
    </div>
  </div>
  <hr>
  <div class="row">
      <div class="col-md-6">
          Pemerintah Provinsi Kepulauan Bangka Belitung
      </div>
      <div class="col-md-6 text-right">
          <small>© 2019</small>
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

    var ActivationForm = $('#ActivationForm');
    var ActivationBtn = $('#ActivationBtn');
    Pass = ActivationForm.find('#password');
    RePass = ActivationForm.find('#repassword');
   <?php 
   $id =  $this->uri->segment(2); 
   $code =  $this->uri->segment(3);?>
   $('#id').val('<?php echo $id?>');
   $('#code').val('<?php echo $code?>');
    console.log(Pass)
    console.log(RePass)
    ActivationBtn.on('click', (ev) => {
        
        if(RePass.val() != Pass.val()){
            swal("Salah", 'Pengulangan Password Salah', "error");
        }else{
                ev.preventDefault();
                buttonLoading(ActivationBtn);
                $.ajax({
                url: "<?=site_url() . 'activation-process'?>",
                type: "POST",
                data: ActivationForm.serialize(),
                success: (data) => {
                buttonIdle(ActivationBtn);
                json = JSON.parse(data);
                if(json['error']){
                    swal("Aktifasi Gagal", json['message'], "error");
                    return;
                }
                $(location).attr('href', '<?=site_url()?>');
                },
                error: () => {
                swal("Data Duplikasi", '', "error");
                buttonIdle(ActivationBtn);
                }
            });
        }
    });

  });
</script>
<style> body { background-color: #f3f3f4!important; } </style>
<?php $this->load->view('Fragment/FooterFragment'); ?>
