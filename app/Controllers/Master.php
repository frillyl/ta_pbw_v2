<?php

namespace App\Controllers;

use App\Models\ModelAgenda;
use App\Models\ModelPengguna;

class Master extends BaseController
{
    public function __construct()
    {
        helper('form');
        helper('text');
        $this->ModelPengguna = new ModelPengguna();
        $this->ModelAgenda = new ModelAgenda();
    }

    public function index_pengguna()
    {
        $data = [
            'title' => 'Lembaga Penelitian UG',
            'sub'   => 'Master Pengguna',
            'isi'   => 'admin/master/pengguna/v_index',
            'pengguna' => $this->ModelPengguna->allData(),
            'agenda'   => $this->ModelAgenda->allData()
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add_pengguna()
    {
        if ($this->validate([
            'nm_user' => [
                'label' => 'Nama Pengguna',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'email' => [
                'label'  => 'Email',
                'rules'  => 'required|is_unique[tb_user.email]|valid_email',
                'errors' => [
                    'required' => '{field} Wajib Diisi.',
                    'is_unique' => '{field} Sudah Terdaftar.',
                    'valid_email' => 'Format {field} Salah.'
                ]
            ],
            'role' => [
                'label' => 'Posisi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ]
        ])) {
            $data = [
                'nm_user' => $this->request->getPost('nm_user'),
                'email' => $this->request->getPost('email'),
                'role' => $this->request->getPost('role')
            ];
            $this->ModelPengguna->add($data);
            session()->setFlashdata('success', 'Data berhasil ditambahkan.');
            return redirect()->to(base_url('admin/master/pengguna'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('admin/master/pengguna'));
        }
    }
}
