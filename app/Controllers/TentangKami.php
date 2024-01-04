<?php

namespace App\Controllers;

use App\Models\ModelTentangKami;
use App\Models\ModelAgenda;

class TentangKami extends BaseController
{
    public function __construct()
    {
        helper('form');
        helper('text');
        $this->ModelTentangKami = new ModelTentangKami();
        $this->ModelAgenda = new ModelAgenda();
    }

    public function index()
    {
        $data = [
            'title' => 'Lembaga Penelitian UG',
            'sub'   => 'Master Tentang Kami',
            'isi'   => 'admin/profil/tentang_kami/v_index',
            'tentang_kami' => $this->ModelTentangKami->allData(),
            'agenda' => $this->ModelAgenda->allData(),
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add_tentang_kami()
    {
        if ($this->validate([
            'id_user' => [
                'label' => 'Dibuat Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.',
                ]
            ],
            'isi' => [
                'label' => 'Isi Tentang Kami',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.',
                ]
            ],
            'edited_by' => [
                'label' => 'Diedit Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.',
                ]
            ],
        ])) {
            $data = [
                'id_user' => $this->request->getPost('id_user'),
                'isi' => $this->request->getPost('isi'),
                'edited_by' => $this->request->getPost('id_user'),
            ];
            $this->ModelTentangKami->add($data);
            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
            return redirect()->to(base_url('admin/profil/tentang-kami'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('admin/profil/tentang-kami'));
        }
    }

    public function edit_tentang_kami($id_tentang_kami)
    {
        if ($this->validate([
            'id_user' => [
                'label' => 'Dibuat Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.',
                ]
            ],
            'isi' => [
                'label' => 'Isi Tentang Kami',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.',
                ]
            ],
            'edited_by' => [
                'label' => 'Diedit Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.',
                ]
            ],
        ])) {
            $data = [
                'id_tentang_kami' => $id_tentang_kami,
                'id_user' => $this->request->getPost('id_user'),
                'isi' => $this->request->getPost('isi'),
                'edited_by' => $this->request->getPost('edited_by'),
            ];
            $this->ModelTentangKami->edit($data);
            session()->setFlashdata('pesan', 'Data berhasil diubah.');
            return redirect()->to(base_url('admin/profil/tentang-kami'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('admin/profil/tentang-kami'));
        }
    }

    public function delete_tentang_kami($id_tentang_kami)
    {
        $data = [
            'id_tentang_kami' => $id_tentang_kami,
        ];
        $this->ModelTentangKami->delete_data($data);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to(base_url('admin/profil/tentang-kami'));
    }
}
