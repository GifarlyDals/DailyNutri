<?php echo $this->extend('layout/landingpageLayout'); ?>
<?php echo $this->section('content'); ?>


  <section class="signup">
    <div class="signup-form">
      <form>
        <label>Email</label>
        <input type="email" placeholder="Enter your email" required>

        <label>Password</label>
        <input type="password" placeholder="Enter your password" required>

        <button type="submit" class="btn-register">Register</button>
      </form>
    </div>

    <div class="signup-image">
      <div class="image-card">
        <img src="https://cdn.pixabay.com/photo/2017/02/15/10/39/salad-2068220_1280.jpg" alt="Healthy Meal">
        <div class="icon-heart">💚</div>
      </div>
    </div>
  </section>

<?php echo $this->endSection(); ?>
