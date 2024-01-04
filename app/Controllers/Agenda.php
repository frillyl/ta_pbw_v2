<?php

namespace App\Controllers;

use App\Models\ModelAgenda;

class Agenda extends BaseController
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
            'sub'   => 'Master Agenda',
            'isi'   => 'admin/agenda/v_index',
            'agenda' => $this->ModelAgenda->allData(),
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add_agenda()
    {
        if ($this->validate([
            'id_user' => [
                'label' => 'Dibuat Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'tgl_agenda' => [
                'label' => 'Tanggal Agenda',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'judul_agenda' => [
                'label' => 'Judul Agenda',
                'rules' => 'required|max_length[150]',
                'errors' => [
                    'required' => '{field} Wajib Diisi.',
                    'max_length' => '{field} Maksimal Memiliki Panjang 150 Karakter.'
                ]
            ],
            'ket' => [
                'label' => 'Keterangan',
                'rules' => 'required|max_length[250]',
                'errors' => [
                    'required' => '{field} Wajib Diisi.',
                    'max_length' => '{field} Maksimal Memiliki Panjang 250 Karakter.'
                ]
            ]
        ])) {
            $data = [
                'id_user' => $this->request->getPost('id_user'),
                'tgl_agenda' => $this->request->getPost('tgl_agenda'),
                'judul_agenda' => $this->request->getPost('judul_agenda'),
                'ket' => $this->request->getPost('ket'),
            ];
            $this->ModelAgenda->add($data);
            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
            return redirect()->to(base_url('admin/agenda'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('admin/agenda'));
        }
    }

    public function edit_agenda($id_agenda)
    {
        if ($this->validate([
            'id_user' => [
                'label' => 'Dibuat Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'tgl_agenda' => [
                'label' => 'Tanggal Agenda',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'judul_agenda' => [
                'label' => 'Judul Agenda',
                'rules' => 'required|max_length[150]',
                'errors' => [
                    'required' => '{field} Wajib Diisi.',
                    'max_length' => '{field} Maksimal Memiliki Panjang 150 Karakter.'
                ]
            ],
            'ket' => [
                'label' => 'Keterangan',
                'rules' => 'required|max_length[250]',
                'errors' => [
                    'required' => '{field} Wajib Diisi.',
                    'max_length' => '{field} Maksimal Memiliki Panjang 250 Karakter.'
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
                'id_agenda' => $id_agenda,
                'id_user' => $this->request->getPost('id_user'),
                'tgl_agenda' => $this->request->getPost('tgl_agenda'),
                'judul_agenda' => $this->request->getPost('judul_agenda'),
                'ket' => $this->request->getPost('ket'),
                'edited_by' => $this->request->getPost('edited_by'),
            ];
            $this->ModelAgenda->edit($data);
            session()->setFlashdata('pesan', 'Data berhasil diedit');
            return redirect()->to(base_url('admin/agenda'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('admin/agenda'));
        }
    }

    public function delete_agenda($id_agenda)
    {
        $data = [
            'id_agenda' => $id_agenda,
        ];
        $this->ModelAgenda->delete_data($data);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to(base_url('admin/agenda'));
    }
}
