<?php

namespace App\Controllers\Saw;

use App\Controllers\CrudController;
use App\Models\Saw\Mahasiswa;

class MahasiswaController extends CrudController {

    protected $model = Mahasiswa::class;

    protected function getTitle()
    {
        return 'Mahasiswa';
    }

    protected function getSlug()
    {
        return 'mahasiswa';
    }

    protected function columns()
    {
        return [
            'nama' => [
                'label' => 'Nama'
            ],
            'tahun_masuk' => [
                'label' => 'Tahun Masuk'
            ],
            'semester_berjalan' => [
                'label' => 'Semester Berjalan'
            ],
        ];
    }

    protected function details()
    {
        return [];
    }

    protected function fields()
    {
        return [
            'nama' => [
                'label' => 'Nama',
                'type' => 'text'
            ],
            'tahun_masuk' => [
                'label' => 'Tahun Masuk',
                'type' => 'number'
            ],
            'semester_berjalan' => [
                'label' => 'Semester Berjalan',
                'type' => 'number'
            ],
        ];
    }

}