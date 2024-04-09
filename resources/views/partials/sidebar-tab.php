<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
  <div class="navbar-wrapper">
    <div class="m-header">
      <a href="index.html" class="b-brand">
        <!-- ========   Change your logo from here   ============ -->
        <img src="<?= asset('assets/images/logo-dark.svg') ?>" alt="" class="logo logo-lg">
        <img src="<?= asset('assets/images/favicon.svg') ?>" alt="" class="logo logo-sm">
      </a>
    </div>
    <div class="tab-container">
      <div class="tab-sidemenu">
        <ul class="pc-tab-link nav flex-column" role="tablist" id="pc-layout-submenus">
        </ul>
      </div>
      <div class="tab-link">
        <div class="navbar-content">
          <div class="tab-content" id="pc-layout-tab">
          </div>
          <ul class="pc-navbar">
            <?= $this->include('partials/menu-list') ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>
<!-- [ Sidebar Menu ] end -->