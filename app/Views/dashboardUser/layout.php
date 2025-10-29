<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DailyNutri Dashboard</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <style>
    @media (max-width: 768px) {
      .offcanvas {
        width: 220px !important;
        opacity: 0.97;
      }
    }
  </style>
</head>
<body class="bg-light">

  <!-- Navbar -->
  <nav class="navbar navbar-light bg-white shadow-sm fixed-top px-3">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <!-- Toggle button for mobile -->
      <button class="btn btn-outline-success border-0 d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
        <i class="bi bi-list fs-4"></i>
      </button>

      <!-- Brand -->
      <a class="navbar-brand d-flex align-items-center gap-2 m-0" href="<?= base_url('/') ?>">
        <img src="<?= base_url('assets/png/logoDN.png') ?>" alt="DailyNutri Logo" width="26" height="26">
        <span class="fw-bold text-success">DailyNutri</span>
      </a>

      <div class="dropdown">
        <a href="#" class="d-inline-flex align-items-center justify-content-center border rounded-circle text-success" 
          style="width:40px; height:40px;" 
          id="profileDropdown" 
          data-bs-toggle="dropdown" 
          aria-expanded="false">
          <i class="bi bi-person fs-5"></i>
        </a>

        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2" aria-labelledby="profileDropdown" style="min-width: 200px;">
          <li class="px-3 py-2">
            <p class="mb-0 fw-semibold"><?= esc(session()->get('username')) ?></p>
            <small class="text-muted"><?= esc(session()->get('email')) ?></small>
          </li>
          <li><hr class="dropdown-divider"></li>
          <li>
            <a class="dropdown-item text-danger fw-semibold" href="<?= base_url('logout') ?>">
              <i class="bi bi-box-arrow-right me-2"></i> Logout
            </a>
            <a class="dropdown-item text-warning fw-semibold" href="<?= base_url('/editprofile') ?>">
              <i class="bi bi-pencil-square me-2"></i> Edit Profil
            </a>
          </li>
        </ul>
      </div>

    </div>
  </nav>

  <!-- Layout wrapper -->
  <div class="d-flex" style="margin-top:60px;">
    <!-- Sidebar (offcanvas for mobile, static for desktop) -->
    <div class="offcanvas-md offcanvas-start bg-white shadow-sm"
         tabindex="-1" id="sidebarMenu"
         aria-labelledby="sidebarMenuLabel"
         data-bs-scroll="true"
         data-bs-backdrop="true">

      <!-- Offcanvas header (visible only on mobile) -->
      <div class="offcanvas-header d-md-none">
        <h5 class="offcanvas-title fw-bold text-success" id="sidebarMenuLabel">Menu</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>

      <!-- Sidebar content -->
      <div class="offcanvas-body d-flex flex-column flex-shrink-0 p-3">
        <ul class="nav nav-pills flex-column mb-auto text-center text-md-start">
          <li class="nav-item">
            <a href="#" class="nav-link text-dark">
              <i class="bi bi-house-door fs-5"></i>
              <span class="d-md-inline ms-2">Dashboard</span>
            </a>
          </li>
          <li>
            <a href="#" class="nav-link text-dark">
              <i class="bi bi-egg-fried fs-5"></i>
              <span class="d-md-inline ms-2">Meal Planner</span>
            </a>
          </li>
          <li>
            <a href="#" class="nav-link text-dark">
              <i class="bi bi-droplet fs-5"></i>
              <span class="d-md-inline ms-2">Water Tracking</span>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <!-- Main Content -->
    <?php echo $this->renderSection('content') ?>
  </div>

  <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/offcanvasFix.js') ?>"></script>
</body>
</html>
