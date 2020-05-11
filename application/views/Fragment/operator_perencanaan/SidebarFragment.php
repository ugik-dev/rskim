<div id="wrapper">

<nav class="navbar-default navbar-static-side" role="navigation">
  <div class="sidebar-collapse">
    <ul class="nav metismenu" id="side-menu">
      <?= $this->load->view('Fragment/SidebarHeaderFragment', NULL, TRUE);?>
      <li id="dashboard">
        <a href="<?=site_url('OPPerencanaanController/')?>"><i class="fa fa-home"></i> <span class="nav-label">Beranda</span></a>
      </li>
      <li id="daftar_hsbj"><a href="<?=site_url('HSBJController/daftar_hsbj_page')?>"><i class="fa fa-book"></i> <span class="nav-label">Daftar HSBJ</span></a></li>
      <li id="import_rpjmd">
        <a href="<?=site_url('OPPerencanaanController/import_rpjmd')?>"><i class="fa fa-file-import"></i> <span class="nav-label">Import RPJMD</span></a>
      </li>
      <li id="daftar_pimpinan">
        <a href="<?=site_url('OPPerencanaanController/daftar_pimpinan')?>"><i class="fa fa-user"></i> <span class="nav-label">Daftar Pimpinan</span></a>
      </li>
      <li id="cascade">
        <a href="#"><i class="fa fa-tasks"></i> <span class="nav-label">Setting Cascade</span> <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level" aria-expanded="true">
          <li id="cascade_rpjmd"><a href="<?=site_url('OPPerencanaanController/cascade_rpjmd')?>">1. Sasaran RPJMD </a></li>
          <li id="cascade_renstra"><a href="<?=site_url('OPPerencanaanController/cascade_renstra')?>">2. Sasaran Renstra </a></li>
          <li id="cascade_program"><a href="<?=site_url('OPPerencanaanController/cascade_program')?>">3. Program </a></li>
          <li id="cascade_kegiatan"><a href="<?=site_url('OPPerencanaanController/cascade_kegiatan')?>">4. Kegiatan </a></li>
        </ul>
      </li>
      <li id="cascade_result">
        <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Cascade RPJMD</span> <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level" aria-expanded="true">
          <li id="table"><a href="<?=site_url('OPPerencanaanController/cascade_table')?>">Tabel </a></li>
          <li id="tree"><a href="<?=site_url('OPPerencanaanController/cascade_tree')?>">Diagram Pohon</a></li>
        </ul>
      </li>
      <li id="rka">
        <a href="<?=site_url('OPPerencanaanController/rka')?>"><i class="fa fa-file-alt"></i> <span class="nav-label">RKA OPD</span></a>
      </li>
      <li id="cascade_2">
      <a href="#"><i class="fa fa-tasks"></i> <span class="nav-label">Setting Cascade 2</span> <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level" aria-expanded="true">
          <li id="cascade_kegiatan_2"><a href="<?=site_url('OPPerencanaanController/cascade_kegiatan_2')?>">1. Kegiatan </a></li>
        </ul>
      </li>
      <li id="cascade_result_2">
        <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Cascade RPJMD 2</span> <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level" aria-expanded="true">
          <li id="table"><a href="<?=site_url('OPPerencanaanController/cascade_table_2')?>">Tabel </a></li>
          <li id="tree"><a href="<?=site_url('OPPerencanaanController/cascade_tree_2')?>">Diagram Pohon</a></li>
        </ul>
      </li>
      <li id="panduan">
        <a href="<?=site_url('OPPerencanaanController/panduan')?>"><i class="fa fa-question"></i> <span class="nav-label">Panduan</span></a>
      </li>
      <li id="logout">
        <a href="#" class="logout"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
      </li>
  </div>
</nav>
<script>
$(document).ready(function() {});
</script>