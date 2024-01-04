<?php

namespace App\Controllers;

use App\Models\ModelVisi;
use App\Models\ModelAgenda;

class Visi extends BaseController
{
    public function __construct()
    {
        helper('form');
        helper('text');
        $this->ModelVisi = new ModelVisi();
        $this->ModelAgenda = new ModelAgenda();
    }

    public function index()
    {
        $data = [
            'title' => 'Lembaga Penelitian UG',
            'sub'   => 'Master Visi',
            'isi'   => 'admin/profil/visi/v_index',
            'visi'  => $this->ModelVisi->allData(),
            'agenda' => $this->ModelAgenda->allData(),
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add_visi()
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
                'id_user'  => $this->request->getPost('id_user'),
                'isi' => $this->request->getPost('isi'),
            ];
            $this->ModelVisi->add($data);
            session()->setFlashdata('pesan', 'Data Berhasil di Tambahkan.');
            return redirect()->to(base_url('admin/profil/visi'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('admin/profil/visi'));
        }
    }

    public function edit_visi($id_visi)
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
                'label' => 'Isi',
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
                'id_visi' => $id_visi,
                'id_user' => $this->request->getPost('id_user'),
                'isi' => $this->request->getPost('isi'),
                'edited_by' => $this->request->getPost('edited_by'),
            ];
            $this->ModelVisi->edit($data);
            session()->setFlashdata('pesan', 'Data berhasil diedit.');
            return redirect()->to(base_url('admin/profil/visi'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('admin/profil/visi'));
        }
    }

    public function delete_visi($id_visi)
    {
        $data = [
            'id_visi' => $id_visi,
        ];
        $this->ModelVisi->delete_data($data);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to(base_url('admin/profil/visi'));
    }
}
