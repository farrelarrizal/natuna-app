<!-- [ Header Topbar ] start -->
<header class="pc-header">
  <div class="header-wrapper"> @include('partials/header-content') </div>
</header>
<div class="offcanvas pc-announcement-offcanvas offcanvas-end" tabindex="-1" id="announcement" aria-labelledby="announcementLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="announcementLabel">What’s new announcement?</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <p class="text-span">Today</p>
    <div class="card mb-3">
      <div class="card-body">
        <div class="align-items-center d-flex flex-wrap gap-2 mb-3">
          <div class="badge bg-light-success f-12">New Feature</div>
          <p class="mb-0 text-muted">2 min ago</p>
          <span class="badge dot bg-warning"></span>
        </div>
        <h5 class="mb-3">Select Business Unit</h5>
        <p class="text-muted">You can use the Analytics Dashboard to explore how many new users download reports daily and monthly</p>
        <img src="<?= asset('assets/images/layout/img-announcement-1.svg') ?>" alt="img" class="img-fluid mb-3">
        <div class="row">
          <div class="col-6">
            <div class="d-grid"><button class="btn btn-outline-secondary">Skip Intro</button></div>
          </div>
          <div class="col-6">
            <div class="d-grid"><button class="btn btn-primary">Next</button></div>
          </div>
        </div>
      </div>
    </div>
    <div class="card mb-3">
      <div class="card-body">
        <div class="align-items-center d-flex flex-wrap gap-2 mb-3">
          <div class="badge bg-light-warning f-12">Meeting</div>
          <p class="mb-0 text-muted">2 hour ago</p>
          <span class="badge dot bg-warning"></span>
        </div>
        <h5 class="mb-3">General Meeting for update</h5>
        <p class="text-muted">You can use the Analytics Dashboard to explore how many new users download reports daily and monthly</p>
        <img src="<?= asset('assets/images/layout/img-announcement-2.svg') ?>" alt="img" class="img-fluid">
      </div>
    </div>

    <p class="text-span mt-4">Yesterday</p>
    <div class="card mb-3">
      <div class="card-body">
        <div class="align-items-center d-flex flex-wrap gap-2 mb-3">
          <div class="badge bg-light-primary f-12">Improvement</div>
          <p class="mb-0 text-muted">12 hour ago</p>
          <span class="badge dot bg-warning"></span>
        </div>
        <h5 class="mb-3">Widgets update</h5>
        <p class="text-muted">We've made some updates to the emendable widget which we think you are going to love.</p>
        <img src="<?= asset('assets/images/layout/img-announcement-3.svg') ?>" alt="img" class="img-fluid">
      </div>
    </div>
    <div class="card mb-3">
      <div class="card-body">
        <div class="align-items-center d-flex flex-wrap gap-2 mb-3">
          <div class="badge bg-light-primary f-12">Improvement</div>
          <p class="mb-0 text-muted">12 hour ago</p>
          <span class="badge dot bg-warning"></span>
        </div>
        <h5 class="mb-3">Coming soon dark mode</h5>
        <p class="text-muted">We've made some updates to the emendable widget which we think you are going to love.</p>
        <img src="<?= asset('assets/images/layout/img-announcement-4.svg') ?>" alt="img" class="img-fluid">
      </div>
    </div>
  </div>
</div>
<!-- [ Header ] end -->
