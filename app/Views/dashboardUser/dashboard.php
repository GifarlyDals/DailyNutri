<?php echo $this->extend('dashboardUser/layout'); ?>
<?php echo $this->section('content'); ?>

    <main class="flex-grow-1 p-4">
      <!-- Greeting -->
      <div class="alert alert-success bg-opacity-10 border-success text-success shadow-sm">
        <h5 class="fw-bold mb-1">Selamat Datang, <?= (session()->get('username')); ?> 👋</h5>
        <p class="mb-0 text-success">Pantau kalori dan kebutuhan air Anda dengan mudah dan teratur</p>
      </div>

      <!-- Dashboard cards -->
      <div class="row g-4 mt-3">
        <!-- Meal Planner Card -->
        <div class="col-md-6">
          <div class="card border-success shadow-sm h-100">
            <div class="card-body">
              <h6 class="card-title text-success fw-semibold">
                <i class="bi bi-egg-fried me-1"></i> Meal Planner
              </h6>
              <p class="mb-1 small mt-3">Kalori</p>
              <small>1330/2000 kal</small>
              <div class="progress mb-3" style="height:6px;">
                <div class="progress-bar bg-success" style="width:67%;"></div>
              </div>
              <p class="mb-1 small">Makanan</p>
              <small>3/4 makanan</small>
              <div class="progress mb-3" style="height:6px;">
                <div class="progress-bar bg-success" style="width:75%;"></div>
              </div>
              <button class="btn btn-success w-100 fw-semibold">Lihat Detail</button>
            </div>
          </div>
        </div>

        <!-- Water Tracking Card -->
        <div class="col-md-6">
          <div class="card border-primary shadow-sm h-100">
            <div class="card-body">
              <h6 class="card-title text-primary fw-semibold">
                <i class="bi bi-droplet me-1"></i> Water Tracking
              </h6>
              <p class="mb-1 small mt-3">Air Minum</p>
              <small>1.5L/2.5L</small>
              <div class="progress mb-3" style="height:6px;">
                <div class="progress-bar bg-success" style="width:60%;"></div>
              </div>
              <p class="mb-1 small">Gelas hari ini</p>
              <small>6 gelas</small>
              <div class="progress mb-3" style="height:6px;">
                <div class="progress-bar bg-success" style="width:75%;"></div>
              </div>
              <button class="btn btn-primary w-100 fw-semibold">Lihat Detail</button>
            </div>
          </div>
        </div>
      </div>
    </main>

<?php echo $this->endSection(); ?>
