<?php echo $this->extend('dashboardUser/layout'); ?>
<?php echo $this->section('content'); ?>


    <style>
        .tab-btn {
            border: 1px solid #ced4da;
            border-radius: 50px;
            font-weight: 500;
            transition: background 0.3s, color 0.3s;
        }

        .tab-btn.active {
            background: #28a745 !important;
            color: white !important;
        }

        .calendar-day {
            padding: 10px;
            border-radius: 8px;
            font-weight: 500;
        }

        .bg-full {
            background: #d9f9df !important;
        }

        .bg-half {
            background: #fff3cd !important;
        }

        .bg-empty {
            background: #f8f9fa !important;
        }
    </style>
    <div class="flex-grow-1 p-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Rencanakan Makanan Sehat Anda</h3>

            <div class="dropdown">
                <button class="btn btn-light rounded-circle p-2" data-bs-toggle="dropdown">
                    <i class="bi bi-person fs-4 text-success"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-person-circle me-2"></i>Profil</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                </ul>
            </div>
        </div>

        <p class="text-muted mb-4">Atur menu makan harian, mingguan, dan bulanan untuk gaya hidup sehat.</p>

        <!-- TAB BUTTONS -->
        <div class="d-flex justify-content-center mb-3">
            <button class="btn btn-light px-4 mx-1 tab-btn active" onclick="showTab('daily')">Harian</button>
            <button class="btn btn-light px-4 mx-1 tab-btn" onclick="showTab('weekly')">Mingguan</button>
            <button class="btn btn-light px-4 mx-1 tab-btn" onclick="showTab('monthly')">Bulanan</button>
        </div>

        <!-- =============================== -->
        <!--            TAB: HARIAN          -->
        <!-- =============================== -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="?tanggal=<?= date('Y-m-d', strtotime($tanggal . ' -1 day')) ?>" class="btn btn-light">
                <i class="bi bi-chevron-left"></i> Kemarin
            </a>

            <input type="date" class="form-control w-auto"
                value="<?= $tanggal ?>"
                onchange="window.location='?tanggal='+this.value">

            <a href="?tanggal=<?= date('Y-m-d', strtotime($tanggal . ' +1 day')) ?>" class="btn btn-light">
                Besok <i class="bi bi-chevron-right"></i>
            </a>
        </div>

        <div id="daily" class="tab-content">

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="p-3 border rounded-4 bg-light">
                        <h6>Total Kalori</h6>
                        <h4 class="text-success"><?= $plan['totalKalori'] ?> kal </h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 border rounded-4 bg-light">
                        <h6>Total Porsi</h6>
                        <h4 class="text-success"><?= $plan['totalPorsi'] ?></h4>
                    </div>
                </div>
            </div>

            <!-- Meal Blocks -->
            <div class="row g-3">

    <!-- ==========================
         SARAPAN
    =========================== -->
    <div class="col-md-6">
        <div class="p-3 rounded-4 border bg-white">
            <h6 class="fw-bold">🌞 Sarapan</h6>

            <?php if(empty($sarapan)): ?>
                <div class="text-muted small mt-2">Belum ada makanan.</div>
            <?php endif; ?>

            <?php foreach($sarapan as $item): ?>
                <div class="border p-3 rounded-3 mt-2">
                    <strong><?= $item['makanan'] ?? 'makanan' ?></strong>
                    <span class="badge bg-dark float-end"><?= $item['kalori'] ?> kal</span>

                    <div class="mt-2 small text-muted">
                        <i class="bi bi-clock me-1"></i><?= $item['waktu'] ?>
                        <i class="bi bi-people ms-3 me-1"></i><?= $item['porsi'] ?> porsi
                    </div>

                    <a href="<?= base_url('planmakan/hapus/'.$item['idDetail'].'/'.$plan['idPlanMakan']) ?>" 
                       class="text-danger small d-block mt-2">Hapus</a>
                </div>
            <?php endforeach; ?>

            <button class="btn btn-light w-100 mt-3"
                data-bs-toggle="modal" data-bs-target="#modalTambah"
                onclick="setKategori('sarapan')">
                + Tambah
            </button>
        </div>
    </div>


    <!-- ==========================
         MAKAN SIANG
    =========================== -->
    <div class="col-md-6">
        <div class="p-3 rounded-4 border bg-white">
            <h6 class="fw-bold">🍽️ Makan Siang</h6>

            <?php if(empty($siang)): ?>
                <div class="text-muted small mt-2">Belum ada makanan.</div>
            <?php endif; ?>

            <?php foreach($siang as $item): ?>
                <div class="border p-3 rounded-3 mt-2">
                    <strong><?= $item['makanan'] ?? 'makanan' ?></strong>
                    <span class="badge bg-dark float-end"><?= $item['kalori'] ?> kal</span>

                    <div class="mt-2 small text-muted">
                        <i class="bi bi-clock me-1"></i><?= $item['waktu'] ?>
                        <i class="bi bi-people ms-3 me-1"></i><?= $item['porsi'] ?> porsi
                    </div>

                    <a href="<?= base_url('planmakan/hapus/'.$item['idDetail'].'/'.$plan['idPlanMakan']) ?>" 
                       class="text-danger small d-block mt-2">Hapus</a>
                </div>
            <?php endforeach; ?>

            <button class="btn btn-light w-100 mt-3"
                data-bs-toggle="modal" data-bs-target="#modalTambah"
                onclick="setKategori('siang')">
                + Tambah
            </button>
        </div>
    </div>


    <!-- ==========================
         MAKAN MALAM
    =========================== -->
    <div class="col-md-6">
        <div class="p-3 rounded-4 border bg-white">
            <h6 class="fw-bold">🌜 Makan Malam</h6>

            <?php if(empty($malam)): ?>
                <div class="text-muted small mt-2">Belum ada makanan.</div>
            <?php endif; ?>

            <?php foreach($malam as $item): ?>
                <div class="border p-3 rounded-3 mt-2">
                    <strong><?= $item['makanan'] ?? 'makanan' ?></strong>
                    <span class="badge bg-dark float-end"><?= $item['kalori'] ?> kal</span>

                    <div class="mt-2 small text-muted">
                        <i class="bi bi-clock me-1"></i><?= $item['waktu'] ?>
                        <i class="bi bi-people ms-3 me-1"></i><?= $item['porsi'] ?> porsi
                    </div>

                    <a href="<?= base_url('planmakan/hapus/'.$item['idDetail'].'/'.$plan['idPlanMakan']) ?>" 
                       class="text-danger small d-block mt-2">Hapus</a>
                </div>
            <?php endforeach; ?>

            <button class="btn btn-light w-100 mt-3"
                data-bs-toggle="modal" data-bs-target="#modalTambah"
                onclick="setKategori('malam')">
                + Tambah
            </button>
        </div>
    </div>


    <!-- ==========================
         CAMILAN
    =========================== -->
    <div class="col-md-6">
        <div class="p-3 rounded-4 border bg-white">
            <h6 class="fw-bold">🍪 Camilan</h6>

            <?php if(empty($camilan)): ?>
                <div class="text-muted small mt-2">Belum ada makanan.</div>
            <?php endif; ?>

            <?php foreach($camilan as $item): ?>
                <div class="border p-3 rounded-3 mt-2">
                    <strong><?= $item['makanan'] ?? 'makanan' ?></strong>
                    <span class="badge bg-dark float-end"><?= $item['kalori'] ?> kal</span>

                    <div class="mt-2 small text-muted">
                        <i class="bi bi-clock me-1"></i><?= $item['waktu'] ?>
                        <i class="bi bi-people ms-3 me-1"></i><?= $item['porsi'] ?> porsi
                    </div>

                    <a href="<?= base_url('planmakan/hapus/'.$item['idDetail'].'/'.$plan['idPlanMakan']) ?>" 
                       class="text-danger small d-block mt-2">Hapus</a>
                </div>
            <?php endforeach; ?>

            <button class="btn btn-light w-100 mt-3"
                data-bs-toggle="modal" data-bs-target="#modalTambah"
                onclick="setKategori('camilan')">
                + Tambah
            </button>
        </div>
        </div>

    </div>

    <div class="modal fade" id="modalTambah">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= base_url('planmakan/tambah') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Makanan</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="idPlanMakan" value="<?= $plan['idPlanMakan'] ?>">
                    <input type="hidden" name="kategori" id="kategoriInput">

                    <div class="mb-3">
                        <label class="form-label">Makanan</label>
                        <input type="text" name="makanan" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Porsi</label>
                        <input type="number" name="porsi" class="form-control" required value="1">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kalori</label>
                        <input type="number" name="kalori" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Waktu</label>
                        <input type="time" name="waktu" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-success">Simpan</button>
                </div>

                </form>
            </div>
        </div>
    </div>
        <script>
        function setKategori(kategori) {
            document.getElementById('kategoriInput').value = kategori;
        }
        </script>
        <!-- =============================== -->
        <!--            TAB: MINGGUAN        -->
        <!-- =============================== -->
        <div id="weekly" class="tab-content d-none">

            <div class="p-3 border rounded-4 mb-3">
                <h6><i class="bi bi-calendar-week me-2"></i>Perencanaan Mingguan</h6>
            </div>

            <!-- Statistics -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-light text-center">
                        <h4 class="text-success">21</h4>
                        <small>Menu Direncanakan</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-light text-center">
                        <h4 class="text-success">8,450</h4>
                        <small>Kalori Mingguan</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded-4 bg-light text-center">
                        <h4 class="text-success">7</h4>
                        <small>Hari Terjadwal</small>
                    </div>
                </div>
            </div>

            <!-- Weekly Cards -->
            <div class="row g-3">

                <!-- Repeat 7 times -->
                <div class="col-md-3">
                    <div class="border rounded-4 p-3 text-center">
                        <h6 class="fw-bold">Senin</h6>
                        <small class="text-muted">22 Sep</small>
                        <hr>
                        <button class="btn btn-sm btn-outline-success w-100 mb-2">+ Sarapan</button>
                        <button class="btn btn-sm btn-outline-success w-100 mb-2">+ Siang</button>
                        <button class="btn btn-sm btn-outline-success w-100">+ Malam</button>
                    </div>
                </div>

                <!-- copy untuk selasa, rabu, dst -->

            </div>

        </div>

        <!-- =============================== -->
        <!--            TAB: BULANAN         -->
        <!-- =============================== -->
        <div id="monthly" class="tab-content d-none">

            <div class="p-3 border rounded-4 mb-3">
                <h6><i class="bi bi-calendar3 me-2"></i>Perencanaan Bulanan</h6>
            </div>

            <!-- Monthly Stat -->
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="p-3 rounded-4 bg-light text-center">
                        <h4 class="text-success">84</h4>
                        <small>Total Menu</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 rounded-4 bg-light text-center">
                        <h4 class="text-success">28</h4>
                        <small>Hari Direncanakan</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 rounded-4 bg-light text-center">
                        <h4 class="text-success">1850</h4>
                        <small>Rata-rata Kalori</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 rounded-4 bg-light text-center">
                        <h4 class="text-success">76</h4>
                        <small>Menu Sehat</small>
                    </div>
                </div>
            </div>

            <!-- Calendar -->
            <div class="border rounded-4 p-4 mb-4">

                <h6 class="fw-bold mb-3">Kalender Menu</h6>

                <div class="row text-center fw-bold text-muted mb-2">
                    <div class="col">Sen</div>
                    <div class="col">Sel</div>
                    <div class="col">Rab</div>
                    <div class="col">Kam</div>
                    <div class="col">Jum</div>
                    <div class="col">Sab</div>
                    <div class="col">Min</div>
                </div>

                <div class="row g-2 text-center">

                    <div class="col"><div class="calendar-day bg-full">15</div></div>
                    <div class="col"><div class="calendar-day bg-half">9</div></div>
                    <div class="col"><div class="calendar-day bg-empty">3</div></div>
                    <div class="col"><div class="calendar-day bg-full">20</div></div>
                    <div class="col"><div class="calendar-day bg-half">6</div></div>

                    <!-- Lanjutkan sesuai kebutuhan -->

                </div>

            </div>

            <!-- Monthly Targets -->
            <div class="p-4 border rounded-4">

                <h6 class="fw-bold mb-3">🎯 Target Bulanan</h6>

                <div class="mb-2">Sarapan Sehat</div>
                <div class="progress mb-3"><div class="progress-bar bg-success" style="width: 80%"></div></div>

                <div class="mb-2">Sayuran Harian</div>
                <div class="progress mb-3"><div class="progress-bar bg-success" style="width: 70%"></div></div>

                <div class="mb-2">Protein Cukup</div>
                <div class="progress mb-3"><div class="progress-bar bg-primary" style="width: 90%"></div></div>

                <div class="mb-2">Hidrasi</div>
                <div class="progress mb-3"><div class="progress-bar bg-info" style="width: 85%"></div></div>

            </div>

        </div>

    </div>

    <script>
    function showTab(tab) {
        document.querySelectorAll('.tab-content').forEach(c => c.classList.add('d-none'));
        document.getElementById(tab).classList.remove('d-none');

        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');
    }
    </script>

<?php echo $this->endSection(); ?>