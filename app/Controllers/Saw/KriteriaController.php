<?php

namespace App\Controllers\Saw;

use App\Controllers\CrudController;
use App\Models\Saw\Kriteria;

class KriteriaController extends CrudController {

    protected $model = Kriteria::class;

    protected function getTitle()
    {
        return 'Kriteria';
    }

    protected function getSlug()
    {
        return 'kriteria';
    }

    protected function columns()
    {
        return [
            'nama' => [
                'label' => 'Nama'
            ],
            'bobot' => [
                'label' => 'Bobot'
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
            'bobot' => [
                'label' => 'Bobot',
                'type' => 'number'
            ],
        ];
    }

}