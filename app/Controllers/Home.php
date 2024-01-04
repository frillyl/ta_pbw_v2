<?php

namespace App\Controllers;

use App\Models\ModelTentangKami;
use App\Models\ModelAgenda;

class Home extends BaseController
{
    public function __construct()
    {
        helper('form');
        helper('text');
        $this->ModelAgenda = new ModelAgenda();
        $this->ModelTentangKami = new ModelTentangKami();
    }

    public function index()
    {
        $data = [
            'title' => 'Lembaga Penelitian UG',
            'sub'   => '',
            'agenda' => $this->ModelAgenda->allData(),
        ];
        return view('index', $data);
    }

    public function profil()
    {
        $data = [
            'title' => 'Lembaga Penelitian UG',
            'sub'   => 'Profil',
            'tentang_kami' => $this->ModelTentangKami->tampilData(),
        ];
        return view('profil', $data);
    }
}
