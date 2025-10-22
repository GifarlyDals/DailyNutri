<?php echo $this->extend('layout/landingpageLayout'); ?>
<?php echo $this->section('content'); ?>

  <!-- Hero Section -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row align-items-center justify-content-between">
        <div class="col-lg-6 mb-4 mb-lg-0">
          <h1 class="fw-bold mb-3">Track Your Health Journey<br>with <span class="text-success">DailyNutri</span></h1>
          <p class="text-secondary mb-4">Monitor your nutrition, plan your meals, and stay hydrated with our comprehensive health tracking platform. Start your wellness journey today.</p>
          <div class="d-flex gap-3 flex-wrap">
            <button class="btn btn-success fw-semibold px-4 py-2">Get Started Free</button>
            <button class="btn btn-outline-success fw-semibold px-4 py-2">Admin</button>
          </div>
        </div>
        <div class="col-lg-5 d-flex justify-content-center">
          <div class="card border-0 shadow image-card position-relative" style="border-radius: 16px;">
            <img src="https://cdn.pixabay.com/photo/2017/02/15/10/39/salad-2068220_1280.jpg" alt="Healthy Meal" class="card-img-top rounded-4">
            <div class="position-absolute top-0 end-0 m-3 bg-white rounded-circle p-2 fs-5 text-success">❤️</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section class="text-center py-5">
    <div class="container">
      <h2 class="fw-bold mb-2">Everything You Need for Healthy Living</h2>
      <p class="text-secondary mb-5">Comprehensive tools to track and improve your daily nutrition habits</p>
      <div class="row justify-content-center g-4">
        <div class="col-md-4">
          <div class="card h-100 border-0 shadow-sm p-4 rounded-4">
            <div class="fs-2 mb-3">🥗</div>
            <h3 class="h6 fw-semibold mb-2">Meal Planning</h3>
            <p class="text-secondary">Plan your weekly meals with personalized recommendations and nutritional insights.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100 border-0 shadow-sm p-4 rounded-4">
            <div class="fs-2 mb-3">💧</div>
            <h3 class="h6 fw-semibold mb-2">Water Tracking</h3>
            <p class="text-secondary">Stay hydrated with smart reminders and daily water intake monitoring.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100 border-0 shadow-sm p-4 rounded-4">
            <div class="fs-2 mb-3">📊</div>
            <h3 class="h6 fw-semibold mb-2">Health Analytics</h3>
            <p class="text-secondary">Track your progress with detailed analytics and health insights.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php echo $this->endSection(); ?>