<?php echo $this->extend('layout/landingpageLayout'); ?>
<?php echo $this->section('content'); ?>

<section class="hero">
    <div class="hero-text">
      <h1>Track Your Health Journey<br>with <span class="highlight">DailyNutri</span></h1>
      <p>Monitor your nutrition, plan your meals, and stay hydrated with our comprehensive health tracking platform. Start your wellness journey today.</p>
      <div class="hero-buttons">
        <button class="btn-primary">Get Started Free</button>
        <button class="btn-secondary">Admin</button>
      </div>
    </div>
    <div class="hero-image">
      <div class="image-card">
        <img src="https://cdn.pixabay.com/photo/2017/02/15/10/39/salad-2068220_1280.jpg" alt="Healthy Meal">
        <div class="icon-heart">❤️</div>
      </div>
    </div>
  </section>

  <section class="features">
    <h2>Everything You Need for Healthy Living</h2>
    <p>Comprehensive tools to track and improve your daily nutrition habits</p>
    <div class="feature-cards">
      <div class="card">
        <div class="icon">🥗</div>
        <h3>Meal Planning</h3>
        <p>Plan your weekly meals with personalized recommendations and nutritional insights.</p>
      </div>
      <div class="card">
        <div class="icon">💧</div>
        <h3>Water Tracking</h3>
        <p>Stay hydrated with smart reminders and daily water intake monitoring.</p>
      </div>
      <div class="card">
        <div class="icon">📊</div>
        <h3>Health Analytics</h3>
        <p>Track your progress with detailed analytics and health insights.</p>
      </div>
    </div>
  </section>
  
<?php echo $this->endSection(); ?>