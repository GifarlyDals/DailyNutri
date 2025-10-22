<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DailyNutri Dashboard</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <style>
    /* Sedikit style tambahan agar sidebar tidak menutup layar penuh */
    @media (max-width: 768px) {
      .offcanvas {
        width: 200px !important; /* Sidebar lebih kecil */
        opacity: 0.97;
      }
    }
  </style>
</head>
<body class="bg-light">

  <!-- Navbar (Mobile topbar with toggle) -->
  <nav class="navbar navbar-light bg-white shadow-sm px-3 d-md-none fixed-top">
    <button class="btn btn-outline-success border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
      <i class="bi bi-list fs-4"></i>
    </button>
    <a class="navbar-brand ms-2 fw-bold text-success" href="#">
      <img src="<?= base_url('assets/png/logoDN.png') ?>" alt="Logo" width="24" height="24" class="me-1"> DailyNutri
    </a>
  </nav>

  <div class="d-flex" style="margin-top:56px;">
    <!-- Sidebar -->
  <div class="offcanvas-md offcanvas-start bg-white border-end shadow-sm" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="sidebarMenuLabel">Daily Nutri</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

      <div class="offcanvas-body d-flex flex-column flex-shrink-0 p-3" style="width: 240px; min-height: 100vh;">
        <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
          <img src="<?= base_url('assets/png/logoDN.png') ?>" alt="Logo" width="24" height="24" class="me-2">
          <span class="fs-5 fw-bold text-success d-none d-md-inline">DailyNutri</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto text-center text-md-start">
          <li class="nav-item">
            <a href="#" class="nav-link active bg-success text-white">
              <i class="bi bi-house-door fs-5"></i><span class="d-none d-md-inline ms-2">Dashboard</span>
            </a>
          </li>
          <li>
            <a href="#" class="nav-link text-dark">
              <i class="bi bi-egg-fried fs-5"></i><span class="d-none d-md-inline ms-2">Meal Planner</span>
            </a>
          </li>
          <li>
            <a href="#" class="nav-link text-dark">
              <i class="bi bi-droplet fs-5"></i><span class="d-none d-md-inline ms-2">Water Tracking</span>
            </a>
          </li>
        </ul>
        <div class="mt-auto text-center">
          <a href="#" class="d-inline-flex align-items-center justify-content-center border rounded-circle text-success" style="width:40px; height:40px;">
            <i class="bi bi-person fs-5"></i>
          </a>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <main class="flex-grow-1 p-4">
      <div class="alert alert-success bg-opacity-10 border-success text-success shadow-sm">
        <h5 class="fw-bold mb-1">Selamat Datang, <?= session()->get('username'); ?></h5>
        <p class="mb-0 text-success">Pantau kalori dan kebutuhan air anda dengan mudah dan teratur</p>
      </div>

      <div class="row g-4 mt-3">
        <div class="col-md-6">
          <div class="card border-success shadow-sm">
            <div class="card-body">
              <h6 class="card-title text-success fw-semibold"><i class="bi bi-egg-fried me-1"></i> Meal Planner</h6>
              <p class="mb-1 small mt-3">Kalori</p>
              <small>1330/2000 kal</small>
              <div class="progress mb-3" style="height: 6px;">
                <div class="progress-bar bg-success" style="width: 67%;"></div>
              </div>
              <p class="mb-1 small">Makanan</p>
              <small>3/4 makanan</small>
              <div class="progress mb-3" style="height: 6px;">
                <div class="progress-bar bg-success" style="width: 75%;"></div>
              </div>
              <button class="btn btn-success w-100 fw-semibold">Lihat Detail</button>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card border-primary shadow-sm">
            <div class="card-body">
              <h6 class="card-title text-primary fw-semibold"><i class="bi bi-droplet me-1"></i> Water Tracking</h6>
              <p class="mb-1 small mt-3">Air Minum</p>
              <small>1.5L/2.5L</small>
              <div class="progress mb-3" style="height: 6px;">
                <div class="progress-bar bg-success" style="width: 60%;"></div>
              </div>
              <p class="mb-1 small">Gelas hari ini</p>
              <small>6 gelas</small>
              <div class="progress mb-3" style="height: 6px;">
                <div class="progress-bar bg-success" style="width: 75%;"></div>
              </div>
              <button class="btn btn-primary w-100 fw-semibold">Lihat Detail</button>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/offcanvasFix.js') ?>"></script>
</body>
</html>
