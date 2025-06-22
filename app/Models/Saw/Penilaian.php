<?php

namespace App\Models\Saw;

use CodeIgniter\Model;

class Penilaian extends Model {

    protected $table = 'tb_penilaian';
    protected $allowedFields = ['mahasiswa_id','kriteria_id','nilai'];

}