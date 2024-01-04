<?php

namespace App\Controllers;

use App\Models\ModelAgenda;

class User extends BaseController
{
    public function __construct()
    {
        helper('form');
        helper('text');
        $this->ModelAgenda = new ModelAgenda();
    }

    public function index()
    {
        $data = [
            'title' => 'Lembaga Penelitian UG',
            'sub'   => 'Dashboard',
            'isi'   => 'admin/dashboard',
            'agenda' => $this->ModelAgenda->allData(),
        ];
        return view('layout/v_wrapper', $data);
    }
}
