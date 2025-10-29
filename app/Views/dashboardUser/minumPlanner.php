<?php echo $this->extend('dashboardUser/layout'); ?>
<?php echo $this->section('content'); ?>

<div class="container py-4">

    <div class="row g-4">

        <!-- LEFT: Water Tracker -->
        <div class="col-lg-6">

            <div class="card border-0 shadow-sm p-4 rounded-4">

                <h4 class="fw-bold mb-1">Daily Nutri • Water Tracker</h4>
                <small class="text-muted">
                    Bangun kebiasaan minum — progress air berdasarkan data harian.
                </small>

                <!-- Glass -->
                <div class="d-flex justify-content-center my-4">
                    <div class="water-glass position-relative">
                        <div 
                            class="water-fill position-absolute bottom-0 start-0 w-100"
                            style="height: <?= $progress ?>%; background: #0d6efd; opacity:.7;">
                        </div>

                        <div class="glass-border"></div>
                    </div>
                </div>

                <!-- Progress Text -->
                <h3 class="text-center fw-bold"><?= $progress ?>%</h3>

                <p class="text-center text-muted">
                    Total hari ini <b><?= $todayMl ?></b> ml • 
                    Sisa <b><?= max(0, $targetMl - $todayMl) ?></b> ml
                </p>

                <!-- Buttons -->
                <div class="d-flex justify-content-center gap-2 flex-wrap">

                    <form method="POST" action="<?= base_url('/planminum/add') ?>">
                        <input type="hidden" name="ml" value="125">
                        <button class="btn btn-outline-primary btn-sm">+125 ml</button>
                    </form>

                    <form method="POST" action="<?= base_url('/planminum/add') ?>">
                        <input type="hidden" name="ml" value="250">
                        <button class="btn btn-outline-primary btn-sm">+250 ml</button>
                    </form>

                    <form method="POST" action="<?= base_url('/planminum/add') ?>">
                        <input type="hidden" name="ml" value="500">
                        <button class="btn btn-outline-primary btn-sm">+500 ml</button>
                    </form>

                    <form method="POST" action="<?= base_url('/planminum/reset') ?>">
                        <button class="btn btn-secondary btn-sm">Reset</button>
                    </form>

                </div>

                <!-- Target -->
                <div class="mt-4 text-center">
                    <label class="fw-semibold">Set Target (ml):</label>

                    <form method="POST" action="<?= base_url('/planminum/target') ?>" class="input-group mt-1 w-75 mx-auto">
                        <input 
                            type="number"
                            name="target"
                            class="form-control form-control-sm"
                            value="<?= $targetMl ?>">
                        <button class="btn btn-success btn-sm">Set</button>
                    </form>
                </div>

            </div>
        </div>

        <!-- RIGHT: Insights -->
        <div class="col-lg-6">

            <div class="card border-0 shadow-sm p-4 rounded-4">

                <h5 class="fw-bold mb-1">History & Insights</h5>
                <small class="text-muted">Pilih periode untuk melihat data</small>

                <!-- Tabs -->
                <div class="btn-group my-3">
                    <a href="?filter=day" class="btn btn-outline-secondary <?= $filter=='day'?'active':'' ?>">Per Hari</a>
                    <a href="?filter=week" class="btn btn-outline-secondary <?= $filter=='week'?'active':'' ?>">Minggu</a>
                    <a href="?filter=month" class="btn btn-outline-secondary <?= $filter=='month'?'active':'' ?>">Bulan</a>
                </div>

                <!-- Chart -->
                <div class="mt-4">
                    <canvas id="waterChart" height="140"></canvas>
                </div>

                <!-- Stats -->
                <div class="row g-3 text-center mt-3">

                    <div class="col-4">
                        <div class="p-3 rounded bg-light">
                            <div class="fw-bold"><?= $avgMl ?></div>
                            <small>Rata-rata (ml)</small>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="p-3 rounded bg-light">
                            <div class="fw-bold"><?= $bestDay ?></div>
                            <small>Hari Terbaik</small>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="p-3 rounded bg-light">
                            <div class="fw-bold"><?= $targetSuccess ?></div>
                            <small>Target Tercapai</small>
                        </div>
                    </div>

                </div>

                <!-- ✅ Rekap Mingguan / Bulanan -->
                <?php if ($filter == 'week' || $filter == 'month'): ?>

                    <h6 class="fw-bold mt-4">
                        Rekap <?= $filter == 'week' ? 'Mingguan' : 'Bulanan' ?>
                    </h6>
                    <small class="text-muted">Ringkasan total minum per tanggal</small>

                    <div class="table-responsive mt-2">
                        <table class="table table-bordered table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Total (ml)</th>
                                    <th class="text-center">Target</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($history as $h): ?>
                                <tr>
                                    <td class="text-center"><?= $h['tanggal'] ?></td>
                                    <td class="text-center"><?= $h['currentML'] ?> ml</td>
                                    <td class="text-center"><?= $h['targetML'] ?> ml</td>
                                    <td class="text-center">
                                        <?php if ($h['currentML'] >= $h['targetML']): ?>
                                            <span class="badge bg-success">Tercapai</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Belum</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3 p-3 bg-light rounded border">
                        <b>Total Minum:</b> 
                        <?= number_format(array_sum(array_column($history, 'currentML'))) ?> ml  
                        <br>
                        <b>Rata-rata per Hari:</b> <?= $avgMl ?> ml  
                        <br>
                        <b>Hari Tercapai Target:</b> <?= $targetSuccess ?> / <?= count($history) ?> hari
                    </div>

                <?php endif; ?>

            </div>
        </div>

    </div>

</div>

<style>
.water-glass {
    width: 150px;
    height: 280px;
    border-radius: 15px;
    position: relative;
    overflow: hidden;
    background: #e9f4ff;
    border: 3px solid #bcdcff;
}
.glass-border {
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    border-radius: 15px;
    border: 3px solid #90c7ff;
    pointer-events: none;
}
</style>

<!-- Chart.js -->
<script>
    const labels = <?= json_encode($chartLabels) ?>;
    const values = <?= json_encode($chartValues) ?>;

    document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('waterChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($chartLabels) ?>,
            datasets: [{
                label: 'Total Minum (ml)',
                data: <?= json_encode($chartValues) ?>,
                fill: true,
                tension: 0.35,
                borderWidth: 2,
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13,110,253,0.15)',
                pointBackgroundColor: '#0d6efd',
                pointRadius: 4
            }]
        },
        options: {
            responsive: true,
        }
    });
});

</script>

<?php echo $this->endSection(); ?>
