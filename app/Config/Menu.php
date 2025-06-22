<?php

namespace App\Config;

class Menu {

    static function buildItem($label, $url = false, $slug = '', $icon = '', $controller = false, $roles = [])
    {
        $url = !$url ? "/$slug" : $url;
        return [
            'label' => $label,
            'icon'  => $icon,
            'slug' => $slug,
            'url' => $url,
            'controller' => $controller,
            'roles' => $roles
        ];
    }

    static function get()
    {
        return [
            static::buildItem('Mahasiswa', false, 'mahasiswa', 'fas fa-users', 'Saw\MahasiswaController', ['Admin']),
            static::buildItem('Kriteria', false, 'kriteria', 'fas fa-map-marker', 'Saw\KriteriaController', ['Admin']),
            static::buildItem('Penilaian', false, 'penilaian', 'fas fa-film', 'Saw\PenilaianController', ['Admin']),
            static::buildItem('Hasil', false, 'hasil', 'fas fa-hand-holding-usd', 'Saw\HasilController', ['Admin']),
        ];
    }
}