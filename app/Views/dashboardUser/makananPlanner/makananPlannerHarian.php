<?php echo $this->extend('dashboardUser/makananPlanner/layoutplanner'); ?>
<?php echo $this->section('content'); ?>

        <div class="d-flex justify-content-center mb-3">
            <a href="<?= base_url("/planmakan") ?>" class="btn btn-light px-4 mx-1 tab-btn active">Harian</a>
            <a href="<?= base_url("/planmakan/mingguan") ?>" class="btn btn-light px-4 mx-1 tab-btn">Mingguan</a>
            <a href="<?= base_url("/planmakan/bulanan") ?>" class="btn btn-light px-4 mx-1 tab-btn ">Bulanan</a>
        </div>



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
    </div>

<?php echo $this->endSection(); ?>

