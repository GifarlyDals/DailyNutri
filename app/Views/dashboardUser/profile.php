<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile - DailyNutri</title>
  <link rel="icon" href="<?= base_url("assets/png/logoDN.png") ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <style>
    .card-custom {
        border-radius: 12px;
        border: none;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    .progress {
        height: 8px;
    }
    .profile-img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #e8e8e8;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 32px;
        color: #777;
    }
    .back-button {
        font-size: 20px;
        cursor: pointer;
    }
  </style>
</head>
<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar bg-white shadow-sm px-4 py-3">
    <div class="d-flex align-items-center gap-3">
        <a href="<?= previous_url() ?>" class="text-dark back-button">
            <i class="bi bi-arrow-left"></i>
        </a>

        <a class="navbar-brand fw-semibold d-flex align-items-center gap-2" href="#">
            <img src="<?= base_url('assets/png/logoDN.png') ?>" width="26">
            <span class="fw-bold text-success">DailyNutri</span>
        </a>
    </div>

    <!-- PROFILE DROPDOWN -->
    <div class="dropdown ms-auto">
        <a href="#" class="d-flex align-items-center justify-content-center border rounded-circle text-success"
           style="width:40px; height:40px;" data-bs-toggle="dropdown">
            <i class="bi bi-person fs-5"></i>
        </a>

        <ul class="dropdown-menu dropdown-menu-end shadow-sm mt-2 border-0" style="min-width:200px;">
            <li class="px-3 py-2">
                <p class="fw-semibold mb-0"><?= esc(session()->get('username')) ?></p>
                <small class="text-muted"><?= esc(session()->get('email')) ?></small>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <a href="<?= base_url('logout') ?>" class="dropdown-item text-danger fw-semibold">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- PAGE CONTENT -->
<div class="container py-4">

  <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>
  <?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
  <?php endif; ?>
  <?php if(isset($errors)): ?>
    <div class="alert alert-danger">
      <?php foreach($errors as $e): ?>
        <div><?= esc($e) ?></div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <div class="card mb-4">
    <div class="row g-0 align-items-center">
      <div class="col-md-3 text-center p-4 border-end">
        <?php if(!empty($user['profilPict'])): ?>
          <img src="<?php echo base_url('uploads/profile/'.$user['profilPict']) ?>" alt="photo" class="rounded-circle" style="width:90px;height:90px;object-fit:cover;">
        <?php else: ?>
          <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center" style="width:90px;height:90px;">
            <i class="bi bi-person fs-2 text-muted"></i>
          </div>
        <?php endif; ?>
        <h5 class="mt-2"><?= esc($user['username']) ?></h5>
      </div>

      <div class="col-md-7 p-4">
        <h6 class="text-primary">User Information</h6>
        <p class="mb-1"><strong>Full Name:</strong> <?= esc($user['username']) ?></p>
        <p class="mb-1"><strong>Email:</strong> <?= esc($user['email']) ?></p>
      </div>

      <div class="col-md-2 text-center p-4">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
      </div>
    </div>
  </div>

</div>

<!-- Modal Edit Profile -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="<?= base_url('editprofile/update/'.$user['idUser']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="modal-header">
          <h5 class="modal-title" id="editProfileLabel">Edit Profile</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3 text-center">
            <img id="photoPreview" src="<?= !empty($user['profilPict']) ? base_url('writable/uploads/profile/'.$user['profilPict']) : '' ?>" alt="preview" style="width:100px;height:100px;object-fit:cover;border-radius:50%;">
          </div>

          <div class="mb-3">
            <label class="form-label">Username</label>
            <input name="username" class="form-control" value="<?= esc(old('username', $user['username'])) ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" type="email" class="form-control" value="<?= esc(old('email', $user['email'])) ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Password Baru <small class="text-muted">(kosongkan jika tidak ingin diubah)</small></label>
            <input name="password" type="password" class="form-control" placeholder="Min. 6 karakter">
          </div>

          <div class="mb-3">
            <label class="form-label">Foto Profil</label>
            <input name="photo" id="photoInput" type="file" accept="image/*" class="form-control">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

<!-- preview JS -->
<script>
document.getElementById('photoInput')?.addEventListener('change', function(e){
  const file = e.target.files[0];
  if (!file) return;
  const reader = new FileReader();
  reader.onload = function(ev){
    document.getElementById('photoPreview').src = ev.target.result;
  }
  reader.readAsDataURL(file);
});
</script>
</body>
</html>
