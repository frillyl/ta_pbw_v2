<?php

namespace App\Controllers;

use App\Models\ModelMisi;
use App\Models\ModelAgenda;

class Misi extends BaseController
{
    public function __construct()
    {
        helper('form');
        helper('text');
        $this->ModelMisi = new ModelMisi();
        $this->ModelAgenda = new ModelAgenda();
    }

    public function index()
    {
        $data = [
            'title' => 'Lembaga Penelitian UG',
            'sub'   => 'Master Misi',
            'isi'   => 'admin/profil/misi/v_index',
            'misi'  => $this->ModelMisi->allData(),
            'agenda' => $this->ModelAgenda->allData(),
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add_misi()
    {
        if ($this->validate([
            'id_user' => [
                'label' => 'Dibuat Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'isi' => [
                'label' => 'Isi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ]
        ])) {
            $data = [
                'id_user' => $this->request->getPost('id_user'),
                'isi' => $this->request->getPost('isi'),
            ];
            $this->ModelMisi->add($data);
            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
            return redirect()->to(base_url('admin/profil/misi'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('admin/profil/misi'));
        }
    }

    public function edit_misi($id_misi)
    {
        if ($this->validate([
            'id_user' => [
                'label' => 'Dibuat Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'isi' => [
                'label' => 'Isi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'edited_by' => [
                'label' => 'Diedit Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
        ])) {
            $data = [
                'id_misi' => $id_misi,
                'id_user' => $this->request->getPost('id_user'),
                'isi' => $this->request->getPost('isi'),
                'edited_by' => $this->request->getPost('edited_by'),
            ];
            $this->ModelMisi->edit($data);
            session()->setFlashdata('pesan', 'Data berhasil diedit.');
            return redirect()->to(base_url('admin/profil/misi'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('admin/profil/misi'));
        }
    }

    public function delete_misi($id_misi)
    {
        $data = [
            'id_misi' => $id_misi,
        ];
        $this->ModelMisi->delete_data($data);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to(base_url('admin/profil/misi'));
    }
}
