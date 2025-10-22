<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DailyNutri</title>
  <link rel="stylesheet" href="<?= base_url('assets/LandingPage.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/signup.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/loginpage.css') ?>">
  <link rel="stylesheet" href="<?= base_url('/assets/css/bootstrap.min.css') ?>">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
  <header>
    <nav class="navbar">
      <div class="logo">
        <img src="<?= base_url('assets\png\logoDN.png') ?>" alt="logo">
        <h1>DailyNutri</h1>
      </div>
      <div class="nav-links">
        <a href="<?= base_url('login') ?>">Login</a>
        <a class="btn-signup" href="<?= base_url('register') ?>">Sign Up</a>
      </div>
    </nav>
  </header>


  <?php echo $this->renderSection('content') ?>
  <footer class="py-3 my-4">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
    </ul>
    <p class="text-center text-muted">&copy; 2024 DAILY NUTRI</p>
  </footer>
</body>
<script src="<?= base_url('assets\js\bootstrap.min.js') ?>"></script>
</html>
