<?php

namespace App\Controllers;

use App\Models\ModelAgenda;
use App\Models\ModelBerita;
use App\Models\ModelUnduh;
use App\Models\ModelHibahDana;
use App\Models\ModelHibahPenelitian;

class Home extends BaseController
{
    public function __construct()
    {
        helper('form');
        helper('text');
        $this->ModelAgenda = new ModelAgenda();
        $this->ModelBerita = new ModelBerita();
        $this->ModelUnduh = new ModelUnduh();
        $this->ModelHibahDana = new ModelHibahDana();
        $this->ModelHibahPenelitian = new ModelHibahPenelitian();
    }

    public function index()
    {
        $data = [
            'title' => 'Lembaga Penelitian UG',
            'sub'   => 'Beranda',
            'agenda' => $this->ModelAgenda->allData(),
            'berita' => $this->ModelBerita->allData()
        ];
        return view('index', $data);
    }

    public function profil()
    {
        $data = [
            'title' => 'Lembaga Penelitian UG',
            'sub'   => 'Profil',
        ];
        return view('profil', $data);
    }

    public function berita()
    {
        $data = [
            'title' => 'Lembaga Penelitian UG',
            'sub'   => 'Berita',
            'beritaPenelitian' => $this->ModelBerita->beritaPenelitian(),
            'beritaKegiatan' => $this->ModelBerita->beritaKegiatan()
        ];
        return view('berita', $data);
    }

    public function detailBerita($id_berita)
    {
        $data = [
            'title' => 'Lembaga Penelitian UG',
            'sub'   => 'Berita',
            'berita' => $this->ModelBerita->detailData($id_berita),
        ];
        return view('isiberita', $data);
    }

    public function beritaPenelitian()
    {
        $data = [
            'title' => 'Lembaga Penelitian UG',
            'sub'   => 'Berita Penelitian',
            'beritaPenelitian' => $this->ModelBerita->beritaPenelitian()
        ];
        return view('beritaPenelitian', $data);
    }

    public function beritaKegiatan()
    {
        $data = [
            'title' => 'Lembaga Penelitian UG',
            'sub'   => 'Berita Kegiatan',
            'beritaKegiatan' => $this->ModelBerita->beritaKegiatan()
        ];
        return view('beritaKegiatan', $data);
    }

    public function unduh()
    {
        $data = [
            'title' => 'Lembaga Penelitian UG',
            'sub'   => 'Unduhan',
            'unduh' => $this->ModelUnduh->allData()
        ];
        return view('unduh', $data);
    }

    public function hibahDana()
    {
        $data = [
            'title' => 'Lembaga Penelitian UG',
            'sub'   => 'Dana Penelitian',
            'dana'  => $this->ModelHibahDana->allData()
        ];
        return view('dana', $data);
    }

    public function hibahPenelitian()
    {
        $data = [
            'title' => 'Lembaga Penelitian UG',
            'sub'   => 'Penelitian',
            'penelitian' => $this->ModelHibahPenelitian->allData()
        ];
        return view('penelitian', $data);
    }
}
