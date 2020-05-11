<div id="wrapper">

<nav class="navbar-default navbar-static-side" role="navigation">
  <div class="sidebar-collapse">
    <ul class="nav metismenu" id="side-menu">
      <?= $this->load->view('Fragment/SidebarHeaderFragment', NULL, TRUE);?>
      <li id="dashboard">
        <a href="<?=site_url('SampelController/')?>"><i class="fa fa-home"></i> <span class="nav-label">Beranda</span></a>
      </li>
      <!-- <li id="sampel">
        <a href="<?=site_url('SampelController/request_sampel')?>"><i class="fa fa-database"></i> <span class="nav-label">Request Uji Sampel</span></a>
      </li> -->
      <li id="terjadwal_sampel">
        <a href="<?=site_url('SampelController/terjadwal_sampel')?>"><i class="fa fa-database"></i> <span class="nav-label">Jadwal Uji Sampel</span></a>
      </li>
      <li id="finis_sampel">
        <a href="<?=site_url('SampelController/finis_sampel')?>"><i class="fa fa-database"></i> <span class="nav-label">Hasil Uji Sampel</span></a>
      </li>

      <li id="balasan_sampel">
        <a href="<?=site_url('SampelController/balasan_sampel')?>"><i class="fa fa-database"></i> <span class="nav-label">Hasil Uji Labor</span></a>
      </li>

      <li id="logout">
        <a href="#" class="logout"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
      </li>
  </div>
</nav>
<script>
$(document).ready(function() {});
</script>