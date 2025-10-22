<?php echo $this->extend('layout/landingpageLayout'); ?>
<?php echo $this->section('content'); ?>


  <!-- Sign Up Section -->
  <section class="signup">
    <div class="signup-form">
    <?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade-show" role="alert">
        <strong><?= session()->getFlashdata('error'); ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('tambah')) : ?>
        <div class="alert alert-success alert-dismissible fade-show" role="alert">
            <strong><?= session()->getFlashdata('tambah'); ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
      <form action="<?= base_url('register/prosesregister') ?>" method="post">
        <label>Username</label>
        <input type="text" name="username" placeholder="Masukkan Nama Anda...." required>
        <label>Email</label>
        <input type="email" name="email" placeholder="Masukkan Email Anda...." required>
        <label>Password</label>
        <input type="password" name="password" placeholder="Masukkan Password Anda" required>
        <label>Konfirmasi Password</label>
        <input type="password" name="confirm" placeholder="Masukkan Kembali Password Anda...." required>
        <button type="submit" class="btn-signin">Daftar</button>

        <p class="alt-link">Sudah Punya Akun? <a href="#">Login</a></p>
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
