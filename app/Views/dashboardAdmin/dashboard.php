<?php echo $this->extend('dashboardAdmin/layout'); ?>
<?php echo $this->section('content'); ?>
    <main class="flex-grow-1 p-4">
      <!-- Greeting -->
      <div class="alert alert-success bg-opacity-10 border-success text-success shadow-sm">
        <h5 class="fw-bold mb-1">Selamat Datang, Admin <?= (session()->get('username')); ?> 👋</h5>
      </div>
    </main>


<?php echo $this->endSection(); ?>
