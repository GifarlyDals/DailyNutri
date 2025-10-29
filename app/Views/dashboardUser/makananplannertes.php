<!-- Info Total -->
    <div class="alert alert-success">
        <strong>Total Kalori:</strong> <?= $plan['totalKalori'] ?> kal <br>
        <strong>Total Porsi:</strong> <?= $plan['totalPorsi'] ?>
    </div>

    <!-- =======================
         KATEGORI SARAPAN
    ======================== -->
    <div class="card mb-3">
        <div class="card-header bg-light d-flex justify-content-between">
            <h6 class="m-0">Sarapan</h6>
            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalTambah" onclick="setKategori('sarapan')">
                + Tambah
            </button>
        </div>
        <ul class="list-group list-group-flush">
            <?php if(empty($sarapan)): ?>
                <li class="list-group-item text-muted">Belum ada makanan.</li>
            <?php endif; ?>

            <?php foreach($sarapan as $item): ?>
            <li class="list-group-item d-flex justify-content-between">
                <?= $item['porsi'] ?>x Makanan (<?= $item['kalori'] ?> kal)
                <a href="<?= base_url('mealplanner/hapus/'.$item['idDetail'].'/'.$plan['idPlanMakan']) ?>" 
                   class="text-danger small">Hapus</a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- KATEGORI SIANG -->
    <div class="card mb-3">
        <div class="card-header bg-light d-flex justify-content-between">
            <h6 class="m-0">Makan Siang</h6>
            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalTambah" onclick="setKategori('siang')">
                + Tambah
            </button>
        </div>
        <ul class="list-group list-group-flush">
            <?php if(empty($siang)): ?>
                <li class="list-group-item text-muted">Belum ada makanan.</li>
            <?php endif; ?>

            <?php foreach($siang as $item): ?>
            <li class="list-group-item d-flex justify-content-between">
                <?= $item['porsi'] ?>x Makanan (<?= $item['kalori'] ?> kal)
                <a href="<?= base_url('mealplanner/hapus/'.$item['idDetail'].'/'.$plan['idPlanMakan']) ?>" 
                   class="text-danger small">Hapus</a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- KATEGORI MALAM -->
    <div class="card mb-3">
        <div class="card-header bg-light d-flex justify-content-between">
            <h6 class="m-0">Makan Malam</h6>
            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalTambah" onclick="setKategori('malam')">
                + Tambah
            </button>
        </div>
        <ul class="list-group list-group-flush">
            <?php if(empty($malam)): ?>
                <li class="list-group-item text-muted">Belum ada makanan.</li>
            <?php endif; ?>

            <?php foreach($malam as $item): ?>
            <li class="list-group-item d-flex justify-content-between">
                <?= $item['porsi'] ?>x Makanan (<?= $item['kalori'] ?> kal)
                <a href="<?= base_url('mealplanner/hapus/'.$item['idDetail'].'/'.$plan['idPlanMakan']) ?>" 
                   class="text-danger small">Hapus</a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- KATEGORI CAMILAN -->
    <div class="card mb-3">
        <div class="card-header bg-light d-flex justify-content-between">
            <h6 class="m-0">Camilan</h6>
            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalTambah" onclick="setKategori('camilan')">
                + Tambah
            </button>
        </div>
        <ul class="list-group list-group-flush">
            <?php if(empty($camilan)): ?>
                <li class="list-group-item text-muted">Belum ada makanan.</li>
            <?php endif; ?>

            <?php foreach($camilan as $item): ?>
            <li class="list-group-item d-flex justify-content-between">
                <?= $item['porsi'] ?>x Makanan (<?= $item['kalori'] ?> kal)
                <a href="<?= base_url('mealplanner/hapus/'.$item['idDetail'].'/'.$plan['idPlanMakan']) ?>" 
                   class="text-danger small">Hapus</a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

</div>


<!-- =====================
     MODAL TAMBAH
===================== -->
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('mealplanner/tambah') ?>" method="post">
            <?= csrf_field() ?>
            <div class="modal-header">
                <h5 class="modal-title">Tambah Makanan</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="idPlanMakan" value="<?= $plan['idPlanMakan'] ?>">
                <input type="hidden" name="kategori" id="kategoriInput">

                <div class="mb-3">
                    <label class="form-label">ID Makanan</label>
                    <input type="number" name="idMakanan" class="form-control" required>
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