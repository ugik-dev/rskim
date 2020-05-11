<div id="wrapper">

<nav class="navbar-default navbar-static-side" role="navigation">
  <div class="sidebar-collapse">
    <ul class="nav metismenu" id="side-menu">
      <?= $this->load->view('Fragment/SidebarHeaderFragment', NULL, TRUE);?>
      <li id="monevAll">
        <a href="<?=site_url('PimpinanController/monevAll')?>"><i class="fa fa-home"></i> <span class="nav-label">Monitoring</span></a>
      </li>
      <li id="chat">
        <a href="<?=site_url('PimpinanController/chat')?>"><i class="fa fa-comments"></i> <span class="nav-label">Chat</span></a>
      </li>
      <li id="panduan">
        <a href="<?=site_url('PimpinanController/panduan')?>"><i class="fa fa-question"></i> <span class="nav-label">Panduan</span></a>
      </li>
      <li id="logout">
        <a href="#" class="logout"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
      </li>
  </div>
</nav>
<script>
$(document).ready(function() {});
</script>