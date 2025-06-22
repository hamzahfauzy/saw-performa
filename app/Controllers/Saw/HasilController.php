<?php

namespace App\Controllers\Saw;

use App\Controllers\BaseController;
use App\Libraries\Page;
use App\Models\Saw\Kriteria;
use App\Models\Saw\Mahasiswa;
use App\Models\Saw\Penilaian;

class HasilController extends BaseController
{
    public function index(): string
    {
        $kriteria = (new Kriteria())->findAll();
        $mahasiswa = (new Mahasiswa())->findAll();
        
        $query = '';
        foreach ($kriteria as $k) {
            $nama = $k['nama'];
            $query .= ", MAX(CASE WHEN tb_kriteria.nama = '$nama' THEN tb_penilaian.nilai END) AS `$nama`";
        }

        $penilaian = (new Penilaian)->select('tb_mahasiswa.id, tb_mahasiswa.nama nama_mahasiswa, '.$query)
            ->join('tb_mahasiswa', 'tb_mahasiswa.id=tb_penilaian.mahasiswa_id')
            ->join('tb_kriteria', 'tb_kriteria.id=tb_penilaian.kriteria_id')
            ->groupBy('tb_mahasiswa.id, tb_mahasiswa.nama')
            ->orderBy('tb_mahasiswa.nama')
            ->findAll();

        $matrix = [];
        foreach($penilaian as $p)
        {
            $matrix[$p['id']] = [];
            foreach($kriteria as $k)
            {
                $matrix[$p['id']][$k['nama']] = $p[$k['nama']];
            }
        }

        $maxNilai = [];
        foreach ($kriteria as $k) {
            $maxNilai[$k['nama']] = max(array_column($penilaian, $k['nama']));
        }

        $hasilAkhir = [];
        foreach ($mahasiswa as $mhs) {
            $total = 0;

            foreach ($kriteria as $k) {
                $nilaiAsli = $matrix[$mhs['id']][$k['nama']] ?? 0;
                $normalisasi = $maxNilai[$k['nama']] ? $nilaiAsli / $maxNilai[$k['nama']] : 0;
                $total += $normalisasi * ($k['bobot']/100);
            }

            $hasilAkhir[] = [
                'mahasiswa_id' => $mhs['id'],
                'nama' => $mhs['nama'],
                'nilai_akhir' => round($total, 4)
            ];
        }

        usort($hasilAkhir, function ($a, $b) {
            return $b['nilai_akhir'] <=> $a['nilai_akhir'];
        });

        $page = new Page;
        $page->setTitle('Hasil');
        $page->setBreadcrumbs([
            [
                'label' => 'Dashboard',
                'url' => false
            ],
            [
                'label' => 'Hasil',
                'url' => false
            ],
        ]);
        
        return $page->render('saw/penilaian/hasil', [
            'penilaian' => $penilaian,
            'maxNilai' => $maxNilai,
            'kriteria' => $kriteria,
            'hasilAkhir' => $hasilAkhir
        ]);
    }
}
