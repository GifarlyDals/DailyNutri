<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DailyNutri</title>
  <!-- Bootstrap Local CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/LandingPage.css') ?>">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
    <div class="container d-flex justify-content-between align-items-center">
      <a class="navbar-brand d-flex align-items-center gap-2" href="<?= base_url('/') ?>">
        <img src="assets/png/logoDN.png" alt="DailyNutri Logo" width="24" height="24">
        <h1 class="h5 m-0 fw-bold">DailyNutri</h1>
      </a>
      <div class="d-flex align-items-center gap-3">
        <a href="<?= base_url('login') ?>" class="text-dark fw-medium text-decoration-none">Login</a>
        <a href="<?= base_url('register') ?>" class="btn btn-success fw-semibold px-3">Sign Up</a>
      </div>
    </div>
  </nav>

<?php echo $this->renderSection('content') ?>

  <!-- Bootstrap JS Local -->
  <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
