<?php

namespace App\Models\Saw;

use CodeIgniter\Model;

class Kriteria extends Model {

    protected $table = 'tb_kriteria';
    protected $allowedFields = ['nama','bobot'];

}