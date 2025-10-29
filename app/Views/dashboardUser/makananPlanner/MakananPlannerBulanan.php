<?php echo $this->extend('dashboardUser/makananPlanner/layoutplanner'); ?>
<?php echo $this->section('content'); ?>

<div class="d-flex justify-content-center mb-3">
    <a href="<?= base_url("/planmakan") ?>" class="btn btn-light px-4 mx-1 tab-btn">Harian</a>
    <a href="<?= base_url("/planmakan/mingguan") ?>" class="btn btn-light px-4 mx-1 tab-btn">Mingguan</a>
    <a href="<?= base_url("/planmakan/bulanan") ?>" class="btn btn-light px-4 mx-1 tab-btn active">Bulanan</a>
</div>

<div class="container">

    <!-- Header Bulan -->
    <div class="d-flex justify-content-between mb-4">
        <a href="<?= base_url("planmakan/bulanan?bulan=" . date("Y-m", strtotime($bulan . " -1 month"))) ?>" class="btn btn-light">
            <i class="bi bi-chevron-left"></i> Sebelumnya
        </a>

        <h4 class="fw-bold mb-0"><?= date("F Y", strtotime($bulan)) ?></h4>

        <a href="<?= base_url("planmakan/bulanan?bulan=" . date("Y-m", strtotime($bulan . " +1 month"))) ?>" class="btn btn-light">
            Berikutnya <i class="bi bi-chevron-right"></i>
        </a>
    </div>

    <!-- Statistik Bulanan -->
    <div class="row g-3 mb-4">

        <div class="col-md-3">
            <div class="p-3 bg-light border rounded-4 text-center">
                <h6 class="text-muted">Total Menu Bulan Ini</h6>
                <h3 class="fw-bold text-success"><?= $totalMenu ?></h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="p-3 bg-light border rounded-4 text-center">
                <h6 class="text-muted">Total Kalori Bulan Ini</h6>
                <h3 class="fw-bold text-primary"><?= number_format($totalKaloriBulan) ?> kal</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="p-3 bg-light border rounded-4 text-center">
                <h6 class="text-muted">Rata-rata Kalori / Hari</h6>
                <h3 class="fw-bold text-warning"><?= number_format($avgKalori) ?> kal</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="p-3 bg-light border rounded-4 text-center">
                <h6 class="text-muted">Hari Terisi</h6>
                <h3 class="fw-bold text-dark"><?= $hariTerisi ?> Hari</h3>
            </div>
        </div>

    </div>

    <!-- Kalender Bulanan -->
    <div class="border rounded-4 p-3">

        <!-- Header hari -->
        <div class="row text-center fw-bold text-muted mb-2">
            <div class="col">Sen</div>
            <div class="col">Sel</div>
            <div class="col">Rab</div>
            <div class="col">Kam</div>
            <div class="col">Jum</div>
            <div class="col">Sab</div>
            <div class="col">Min</div>
        </div>

        <?php
        $startDayOfWeek = date("N", strtotime($firstDay)); // 1 (Mon) - 7 (Sun)
        $daysInMonth = date("t", strtotime($firstDay));
        $col = 1;
        ?>

        <div class="row text-center g-2">

            <!-- Kosong sebelum tanggal 1 -->
            <?php for ($i = 1; $i < $startDayOfWeek; $i++): ?>
                <div class="col"></div>
                <?php $col++; ?>
            <?php endfor; ?>

            <!-- Render tanggal -->
            <?php for ($d = 1; $d <= $daysInMonth; $d++): ?>

                <?php
                $tgl = date("Y-m-", strtotime($firstDay)) . str_pad($d, 2, "0", STR_PAD_LEFT);

                $dataTgl = $hariData[$tgl] ?? null;
                $status  = $dataTgl["status"] ?? "empty";
                $kalori  = $dataTgl["kalori"] ?? 0;

                // Warna bootstrap transparan
                $color = [
                    "full"  => "bg-success bg-opacity-50 text-white",
                    "half"  => "bg-warning bg-opacity-50 text-dark",
                    "empty" => "bg-secondary bg-opacity-10"
                ][$status];
                ?>

                <div class="col">
                    <div class="rounded p-2 <?= $color ?>">
                        <div class="fw-bold"><?= $d ?></div>
                        <small><?= $kalori ?> kal</small>
                    </div>
                </div>

                <?php if ($col % 7 == 0): ?>
                    </div><div class="row text-center g-2 mt-1">
                <?php endif; ?>

                <?php $col++; ?>

            <?php endfor; ?>

        </div>

    </div>

</div>

<?php echo $this->endSection(); ?>
