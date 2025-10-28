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

      <!-- Table Card -->
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <h6 class="fw-bold mb-0">User Management</h6>
            <button class="btn btn-success"><i class="bi bi-person-plus me-1"></i> Add User</button>
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
                      <div>
                        <strong><?php echo $value['username'] ?></strong><br>
                        <small class="text-muted"><?php echo $value['email'] ?></small>
                      </div>
                    </div>
                  </td>
                  <td><span class="badge bg-secondary"><?php echo $value['role'] ?></span></td>
                  <td><i class="bi bi-three-dots-vertical"></i></td>
                </tr>
              </tbody>
              <?php } ?>
            </table>
            
          </div>
        </div>
      </div>

    </div>
    </main>


<?php echo $this->endSection(); ?>
