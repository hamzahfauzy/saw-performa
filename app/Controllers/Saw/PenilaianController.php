<?php

namespace App\Controllers\Saw;

use App\Controllers\CrudController;
use App\Libraries\Page;
use App\Models\Saw\Kriteria;
use App\Models\Saw\Mahasiswa;
use App\Models\Saw\Penilaian;

class PenilaianController extends CrudController {

    protected $model = Penilaian::class;

    protected function getModel()
    {
        $kriteria = (new Kriteria)->findAll();
        $query = '';
        foreach ($kriteria as $k) {
            $nama = $k['nama'];
            $query .= ", MAX(CASE WHEN tb_kriteria.nama = '$nama' THEN tb_penilaian.nilai END) AS `$nama`";
        }
        $model = new $this->model;
        $model->select('tb_mahasiswa.id, tb_mahasiswa.nama nama_mahasiswa'.$query)
            ->join('tb_mahasiswa', 'tb_mahasiswa.id=tb_penilaian.mahasiswa_id')
            ->join('tb_kriteria', 'tb_kriteria.id=tb_penilaian.kriteria_id')
            ->groupBy('tb_mahasiswa.id, tb_mahasiswa.nama')
            ->orderBy('tb_mahasiswa.nama')
            ;
        return $model;
    }

    protected function getTitle()
    {
        return 'Penilaian';
    }

    protected function getSlug()
    {
        return 'penilaian';
    }

    protected function columns()
    {
        $columns = [
            'nama_mahasiswa' => [
                'label' => 'Mahasiswa'
            ]
        ];

        $kriteria = (new Kriteria)->findAll();

        foreach($kriteria as $k)
        {
            $columns[$k['nama']] = [
                'label' => $k['nama']
            ];
        }

        return $columns;
    }

    public function create()
    {
        $page = new Page;
        $page->setTitle('Tambah ' . $this->getTitle());
        $page->setSlug($this->getSlug());
        $page->setBreadcrumbs([
            [
                'label' => $this->getTitle(),
                'url' => '/'.$this->getSlug()
            ],
            [
                'label' => 'Tambah Data',
                'url' => false
            ],
        ]);

        $mahasiswa = (new Mahasiswa)->findAll();
        $kriteria = (new Kriteria)->findAll();

        return $page->render('saw/penilaian/form', [
            'data' => [],
            'kriteria' => $kriteria,
            'mahasiswa' => $mahasiswa
        ]);
    }

    public function store()
    {
        $data = $this->request->getPost();
        foreach($data['kriteria'] as $id => $nilai)
        {
            $this->getModel()->insert([
                'mahasiswa_id' => $data['mahasiswa_id'],
                'kriteria_id' => $id,
                'nilai' => $nilai
            ]);
        }
        
        return redirect()->to('/'. $this->getSlug() . (isset($_GET['filter']) ? '?'.http_build_query($_GET) : ''));
    }

    public function edit($id)
    {
        $data = $this->getModel()->where('tb_mahasiswa.id', $id)->first();

        $page = new Page;
        $page->setTitle('Edit ' . $this->getTitle());
        $page->setSlug($this->getSlug());
        $page->setBreadcrumbs([
            [
                'label' => $this->getTitle(),
                'url' => '/'.$this->getSlug()
            ],
            [
                'label' => 'Edit Data',
                'url' => false
            ],
            [
                'label' => $id,
                'url' => false
            ],
        ]);

        $mahasiswa = (new Mahasiswa)->findAll();
        $kriteria = (new Kriteria)->findAll();

        return $page->render('saw/penilaian/form', [
            'data' => $data,
            'kriteria' => $kriteria,
            'mahasiswa' => $mahasiswa
        ]);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        
        (new $this->model)->where('mahasiswa_id', $id)->delete();

        foreach($data['kriteria'] as $id => $nilai)
        {
            $model = new $this->model;
            $model->insert([
                'mahasiswa_id' => $data['mahasiswa_id'],
                'kriteria_id' => $id,
                'nilai' => $nilai
            ]);
        }
        
        return redirect()->to('/'. $this->getSlug() . (isset($_GET['filter']) ? '?'.http_build_query($_GET) : ''));
    }

}