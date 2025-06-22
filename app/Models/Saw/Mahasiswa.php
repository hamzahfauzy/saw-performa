<?php

namespace App\Models\Saw;

use CodeIgniter\Model;

class Mahasiswa extends Model {

    protected $table = 'tb_mahasiswa';
    protected $allowedFields = ['nama','tahun_masuk','semester_berjalan'];

}