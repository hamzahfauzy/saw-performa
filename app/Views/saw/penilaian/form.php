<?= $this->extend('layouts/app') ?>

<?= $this->section('pageTitle') ?>
<?= $page_title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <form action="" method="POST">
        <div class="card-body">
            <?= csrf_field() ?>
            
            <div style="margin-bottom:1rem;">
                <label for="">Mahasiswa</label>
                <select name="mahasiswa_id" id="mahasiswa_id" class="form-control">
                    <option value="">Pilih</option>
                    <?php foreach($mahasiswa as $mhs): ?>
                    <option value="<?=$mhs['id']?>" <?=isset($data['id']) && $data['id'] == $mhs['id'] ? 'selected=""' : ''?>><?=$mhs['nama']?></option>
                    <?php endforeach ?>
                </select>
            </div>
            
            <?php foreach($kriteria as $k): ?>
            <div style="margin-bottom:1rem;">
                <label for=""><?=$k['nama']?></label>
                <input type="number" name="kriteria[<?=$k['id']?>]" id="kriteria_<?=$k['id']?>" class="form-control" value="<?=isset($data[$k['nama']]) ? $data[$k['nama']] : ''?>">
            </div>
            <?php endforeach ?>
        </div>
        
        <div class="card-action">
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>