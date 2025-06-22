<?= $this->extend('layouts/app') ?>

<?= $this->section('pageTitle') ?>
<?= $page_title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3>Matrix Penilaian</h3>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Mahasiswa</th>
                    <?php foreach($kriteria as $k): ?>
                    <th><?=$k['nama']?> (<?=$k['bobot']/100?>)</th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach($penilaian as $index => $p): ?>
                <tr>
                    <td><?=$index+1?></td>
                    <td><?=$p['nama_mahasiswa']?></td>
                    <?php foreach($kriteria as $k): ?>
                    <td><?=$p[$k['nama']]?></td>
                    <?php endforeach ?>
                </tr>
                <?php endforeach ?>
    
                <?php if(empty($penilaian)): ?>
                <tr>
                    <td colspan="<?=count($columns)+2?>"><i>Tidak ada data</i></td>
                </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3>Max Nilai</h3>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <?php foreach($maxNilai as $nama => $nilai): ?>
                    <th><?=$nama?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach($maxNilai as $nama => $nilai): ?>
                    <td><?=$nilai?></td>
                    <?php endforeach ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3>Normalisasi</h3>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Mahasiswa</th>
                    <?php foreach($kriteria as $k): ?>
                    <th><?=$k['nama']?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach($penilaian as $index => $p): ?>
                <tr>
                    <td><?=$index+1?></td>
                    <td><?=$p['nama_mahasiswa']?></td>
                    <?php foreach($kriteria as $k): ?>
                    <td><?=number_format($p[$k['nama']]/$maxNilai[$k['nama']], 3)?> (<?=$p[$k['nama']]?> / <?=$maxNilai[$k['nama']]?>)</td>
                    <?php endforeach ?>
                </tr>
                <?php endforeach ?>
    
                <?php if(empty($penilaian)): ?>
                <tr>
                    <td colspan="<?=count($columns)+2?>"><i>Tidak ada data</i></td>
                </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3>Hasil</h3>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Ranking</th>
                    <th>Mahasiswa</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($hasilAkhir as $index => $hasil): ?>
                <tr>
                    <td><?=$index+1?></td>
                    <td><?=$hasil['nama']?></td>
                    <td><?=$hasil['nilai_akhir']?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>