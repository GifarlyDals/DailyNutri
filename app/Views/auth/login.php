<?php echo $this->extend('layout/landingpageLayout'); ?>
<?php echo $this->section('content'); ?>


  <section class="signup py-5">
    <div class="container">
      <div class="row align-items-center justify-content-between">
        <div class="col-lg-6 mb-4 mb-lg-0">


          <form action="<?= base_url('/login/ceklogin') ?>" method="post" class="p-4 shadow-sm bg-white rounded-4">

            <div class="mb-3">
              <label class="form-label fw-semibold">Email</label>
              <input type="email" class="form-control" name="email" placeholder="Masukkan Email Anda...." required>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Password</label>
              <input type="password" class="form-control" name="password" placeholder="Masukkan Password Anda" required>
            </div>

            <button type="submit" class="btn btn-success w-100 fw-semibold py-2">Masuk</button>

            <p class="mt-3 text-center">Belum Punya Akun? <a href="<?= base_url('login') ?>" class="text-success fw-semibold">Login</a></p>
          </form>
        </div>

        <div class="col-lg-5 d-flex justify-content-center">
          <div class="card border-0 shadow image-card position-relative" style="border-radius: 16px;">
            <img src="https://cdn.pixabay.com/photo/2017/02/15/10/39/salad-2068220_1280.jpg" alt="Healthy Meal" class="card-img-top rounded-4">
            <div class="position-absolute top-0 end-0 m-3 bg-white rounded-circle p-2 fs-5 text-success">💚</div>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php echo $this->endSection(); ?>
