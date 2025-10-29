<?php echo $this->extend('dashboardAdmin/layout'); ?>
<?php echo $this->section('content'); ?>

    <main class="flex-grow-1 p-4">
    <div class="content">

      <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
          <h4 class="fw-bold mb-1">User Management</h4>
          <p class="text-secondary mb-0">Manage and monitor all users on the DailyNutri platform</p>
        </div>
      </div>

      <!-- Cards Section -->
      <div class="row g-3 mb-4">
        <div class="col-md-3">
          <div class="card-metric">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <p class="text-secondary mb-1 small">Total Users</p>
                <h5 class="fw-bold mb-0"><?php echo $totalUsers ?>
              </div>
              <i class="bi bi-person text-primary fs-3"></i>
            </div>
          </div>
        </div>
      </div>
      <?php if (session()->getFlashdata('tambah')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?= session()->getFlashdata('tambah') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>
            <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?= session()->getFlashdata('error') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>
      <?php if (session()->getFlashdata('hapus')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?= session()->getFlashdata('hapus') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>
      <?php if (session()->getFlashdata('edit')) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <?= session()->getFlashdata('edit') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>


      <div class="card shadow-sm border-0">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <h6 class="fw-bold mb-0">User Management</h6>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahUserModal">
              <i class="bi bi-person-plus me-1"></i> Add User
            </button>
          </div>

          <form action="<?= base_url('usermanage') ?>" method="get" class="d-flex gap-2 mb-3 flex-wrap">
            <div class="input-group" style="max-width: 300px;">
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                <input type="text" name="search" class="form-control border-start-0" placeholder="Search by name or email..." value="<?= esc($_GET['search'] ?? '') ?>">
            </div>

            <select name="role" class="form-select" style="max-width: 160px;">
                <option value="all">All Roles</option>
                <option value="admin" <?= ($_GET['role'] ?? '') == 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="user" <?= ($_GET['role'] ?? '') == 'user' ? 'selected' : '' ?>>User</option>
            </select>

            <button type="submit" class="btn btn-success"><i class="bi bi-funnel me-1"></i> Filter</button>
            </form>

          <div class="table-responsive">
            <table class="table align-middle">
              <thead class="table-light">
                <tr>
                  <th>No</th>
                  <th>ID User</th>
                  <th>User</th>
                  <th>Role</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                <?php $no = 1;
			    foreach ($user as $users => $value) { ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo$value['idUser']?></td>
                  <td>
                    <div class="d-flex align-items-center">
                      
                      <!-- Avatar -->
                      <?php if (!empty($value['profilPict'])): ?>
                        <img src="<?= base_url('uploads/profile/'.$value['profilPict']) ?>" 
                            class="me-2 rounded-circle" 
                            style="width:40px; height:40px; object-fit:cover;">
                      <?php else: ?>
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2"
                            style="width:40px;height:40px;">
                          <i class="bi bi-person text-muted"></i>
                        </div>
                      <?php endif; ?>

                      <!-- Username + Email -->
                      <div>
                        <strong><?= $value['username'] ?></strong><br>
                        <small class="text-muted"><?= $value['email'] ?></small>
                      </div>

                    </div>
                  </td>

                  <td><span class="badge bg-secondary"><?php echo $value['role'] ?></span></td>
                  <td class="text-end">
                    <div class="dropdown">
                      <button class="btn btn-light btn-sm border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots-vertical"></i>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                        <!-- Edit -->
                        <li>
                          <button class="dropdown-item text-warning" 
                                  data-bs-toggle="modal" 
                                  data-bs-target="#editUserModal<?= $value['idUser'] ?>">
                            <i class="bi bi-pencil-square me-2"></i>Edit
                          </button>
                        </li>
                        <!-- Delete -->
                        <li>
                          <button class="dropdown-item text-danger" 
                            data-bs-toggle="modal" 
                            data-bs-target="#deleteUserModal<?= $value['idUser'] ?>">
                            <i class="bi bi-trash me-2"></i>Hapus
                          </button>
                        </li>
                      </ul>
                    </div>
                  </td>
                </tr>
              </tbody>
              <!-- Modal Hapus User -->
              <div class="modal fade" id="deleteUserModal<?= $value['idUser'] ?>" tabindex="-1" aria-labelledby="deleteUserLabel<?= $value['idUser'] ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content border-0 shadow">
                    <div class="modal-body text-center p-4">
                      <i class="bi bi-exclamation-circle text-danger fs-1 mb-3"></i>
                      <h5 class="mb-3">Hapus user ini?</h5>
                      <p class="text-secondary mb-4"><?= $value['username'] ?> akan dihapus secara permanen.</p>
                      <form action="<?= base_url('usermanage/hapus/'.$value['idUser']) ?>" method="post">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal Edit User -->
              <div class="modal fade" id="editUserModal<?= $value['idUser'] ?>" tabindex="-1" aria-labelledby="editUserLabel<?= $value['idUser'] ?>" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header bg-warning text-white">
                      <h5 class="modal-title" id="editUserLabel<?= $value['idUser'] ?>">Edit User</h5>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="<?= base_url('usermanage/edit/'.$value['idUser']) ?>" method="post">
                      <div class="modal-body">
                        <div class="mb-3">
                          <label class="form-label">Username</label>
                          <input type="text" name="username" class="form-control" value="<?= esc($value['username']) ?>" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Email</label>
                          <input type="email" name="email" class="form-control" value="<?= esc($value['email']) ?>" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Password</label>
                          <input type="password" name="password" class="form-control">
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Role</label>
                          <select name="role" class="form-select" required>
                            <option value="admin" <?= $value['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="user" <?= $value['role'] == 'user' ? 'selected' : '' ?>>User</option>
                          </select>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <?php } ?>


            </table>
            
          </div>
        </div>
      </div>

    </div>
    </main>
    <!-- Add User Modal -->
<div class="modal fade" id="tambahUserModal" tabindex="-1" aria-labelledby="tambahUserModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="tambahUserModal"><i class="bi bi-person-plus me-2"></i>Tambah User Baru</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="<?= base_url('/usermanage/tambahData') ?>" method="post">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Masukkan username..." required>
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Masukkan email..." required>
          </div>

          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password..." required>
          </div>

          <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-select" required>
              <option value="user" selected>User</option>
              <option value="admin">Admin</option>
            </select>
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



<?php echo $this->endSection(); ?>