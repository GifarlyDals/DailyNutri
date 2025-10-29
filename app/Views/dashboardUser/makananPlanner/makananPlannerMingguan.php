<?php echo $this->extend('dashboardUser/makananPlanner/layoutplanner'); ?>
<?php echo $this->section('content'); ?>

<div class="d-flex justify-content-center mb-3">
    <a href="<?= base_url("/planmakan") ?>" class="btn btn-light px-4 mx-1 tab-btn ">Harian</a>
    <a href="<?= base_url("/planmakan/mingguan") ?>" class="btn btn-light px-4 mx-1 tab-btn active">Mingguan</a>
    <a href="<?= base_url("/planmakan/bulanan") ?>" class="btn btn-light px-4 mx-1 tab-btn">Bulanan</a>
</div>

<div class="container mt-4">

    <!-- Navigasi Minggu -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="<?= base_url('planmakan/mingguan?tanggal=' . date('Y-m-d', strtotime($weekStart . ' -7 days'))) ?>"
           class="btn btn-light">
           <i class="bi bi-chevron-left"></i> Minggu Sebelumnya
        </a>

        <h5 class="fw-bold mb-0">
            Minggu:
            <?= date('d M', strtotime($weekStart)) ?> - <?= date('d M Y', strtotime($weekEnd)) ?>
        </h5>

        <a href="<?= base_url('planmakan/mingguan?tanggal=' . date('Y-m-d', strtotime($weekStart . ' +7 days'))) ?>"
           class="btn btn-light">
           Minggu Selanjutnya <i class="bi bi-chevron-right"></i>
        </a>
    </div>

    <!-- Summary Weekly -->
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="p-3 bg-light rounded-4 border text-center">
                <h6 class="mb-1 text-muted">Total Kalori Minggu Ini</h6>
                <h3 class="fw-bold text-success">
                    <?= number_format($totalKaloriMinggu) ?> kal
                </h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-3 bg-light rounded-4 border text-center">
                <h6 class="mb-1 text-muted">Total Porsi</h6>
                <h3 class="fw-bold text-success">
                    <?= number_format($totalPorsiMinggu) ?>
                </h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-3 bg-light rounded-4 border text-center">
                <h6 class="mb-1 text-muted">Hari yang Terisi</h6>
                <h3 class="fw-bold text-success">
                    <?= $jumlahHariTerisi ?> / 7 hari
                </h3>
            </div>
        </div>

    </div>


    <!-- ✅ DESKTOP VERSION (Horizontal) -->
    <div class="d-none d-md-flex overflow-auto flex-nowrap gap-1 pb-1 mb-4">

        <?php foreach ($rekap as $day): ?>
            <div class="card shadow-sm p-3 flex-shrink-0">

                <div class="text-center mb-2">
                    <strong><?= date('l', strtotime($day['tanggal'])) ?></strong><br>
                    <small class="text-muted"><?= date('d M Y', strtotime($day['tanggal'])) ?></small>
                </div>

                <?php foreach ([
                    'sarapan' => '🌞 Sarapan',
                    'siang'   => '🍽️ Siang',
                    'malam'   => '🌙 Malam',
                    'camilan' => '🍪 Camilan'
                ] as $key => $label): ?>

                    <div class="mb-3">
                        <div class="fw-bold small mb-1"><?= $label ?></div>

                        <?php if (empty($day['detail'][$key])): ?>
                            <button class="btn btn-sm btn-outline-secondary w-100">
                                Belum Terencana
                            </button>
                        <?php endif; ?>

                        <?php foreach ($day['detail'][$key] as $item): ?>
                            <div class="border rounded p-2 small mb-2">
                                <strong><?= esc($item['makanan']) ?></strong>
                                <div class="text-muted mt-1">
                                    <i class="bi bi-clock"></i> <?= esc($item['waktu']) ?><br>
                                    <i class="bi bi-people"></i> <?= esc($item['porsi']) ?> porsi
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

    </div>



    <!-- ✅ MOBILE VERSION (Vertical) -->
    <div class="d-flex d-md-none flex-column gap-3 pb-3">

        <?php foreach ($rekap as $day): ?>
            <div class="card shadow-sm p-3">

                <div class="text-center mb-2">
                    <strong><?= date('l', strtotime($day['tanggal'])) ?></strong><br>
                    <small class="text-muted"><?= date('d M Y', strtotime($day['tanggal'])) ?></small>
                </div>

                <?php foreach ([
                    'sarapan' => '🌞 Sarapan',
                    'siang'   => '🍽️ Siang',
                    'malam'   => '🌙 Malam',
                    'camilan' => '🍪 Camilan'
                ] as $key => $label): ?>

                    <div class="mb-3">
                        <div class="fw-bold small mb-1"><?= $label ?></div>

                        <?php if (empty($day['detail'][$key])): ?>
                            <button class="btn btn-sm btn-outline-secondary w-100">
                                Belum Terencana
                            </button>
                        <?php endif; ?>

                        <?php foreach ($day['detail'][$key] as $item): ?>
                            <div class="border rounded p-2 small mb-2">
                                <strong><?= esc($item['makanan']) ?></strong>
                                <div class="text-muted mt-1">
                                    <i class="bi bi-clock"></i> <?= esc($item['waktu']) ?><br>
                                    <i class="bi bi-people"></i> <?= esc($item['porsi']) ?> porsi
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                <?php endforeach; ?>

            </div>
        <?php endforeach; ?>

    </div>

</div>

<?php echo $this->endSection(); ?>
