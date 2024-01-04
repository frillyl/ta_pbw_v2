<?php

namespace App\Controllers;

use App\Models\ModelAgenda;
use App\Models\ModelBerita;

class Berita extends BaseController
{
    public function __construct()
    {
        helper('form');
        helper('text');
        $this->ModelAgenda = new ModelAgenda();
        $this->ModelBerita = new ModelBerita();
    }

    public function index()
    {
        $data = [
            'title' => 'Lembaga Penelitian UG',
            'sub'   => 'Master Berita',
            'isi'   => 'admin/berita/v_index',
            'agenda' => $this->ModelAgenda->allData(),
            'berita' => $this->ModelBerita->allData(),
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add_berita()
    {
        if ($this->validate([
            'id_user' => [
                'label' => 'Dipublikasi Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'judul_berita' => [
                'label' => 'Judul Berita',
                'rules' => 'required|max_length[150]',
                'errors' => [
                    'required' => '{field} Wajib Diisi.',
                    'max_length' => '{field} Maksimal Memiliki Panjang 150 Karakter'
                ]
            ],
            'sub_judul' => [
                'label' => 'Sub Judul Berita',
                'rules' => 'max_length[100]',
                'errors' => [
                    'max_length' => '{field} Maksimal Memiliki Panjang 100 Karakter'
                ]
            ],
            'kategori' => [
                'label' => 'Kategori',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'isi_berita' => [
                'label' => 'Isi Berita',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ]
        ])) {
            $data = [
                'id_user' => $this->request->getPost('id_user'),
                'judul_berita' => $this->request->getPost('judul_berita'),
                'sub_judul' => $this->request->getPost('sub_judul'),
                'kategori' => $this->request->getPost('kategori'),
                'isi_berita' => $this->request->getPost('isi_berita')
            ];
            $this->ModelBerita->add($data);
            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
            return redirect()->to(base_url('admin/berita'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('admin/berita'));
        }
    }

    public function edit_berita($id_berita)
    {
        if ($this->validate([
            'id_user' => [
                'label' => 'Dipublikasi Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'judul_berita' => [
                'label' => 'Judul Berita',
                'rules' => 'required|max_length[150]',
                'errors' => [
                    'required' => '{field} Wajib Diisi.',
                    'max_length' => '{field} Maksimal Memiliki Panjang 150 Karakter'
                ]
            ],
            'sub_judul' => [
                'label' => 'Sub Judul Berita',
                'rules' => 'max_length[100]',
                'errors' => [
                    'max_length' => '{field} Maksimal Memiliki Panjang 100 Karakter'
                ]
            ],
            'kategori' => [
                'label' => 'Kategori',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'isi_berita' => [
                'label' => 'Isi Berita',
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
                'id_berita' => $id_berita,
                'id_user' => $this->request->getPost('id_user'),
                'judul_berita' => $this->request->getPost('judul_berita'),
                'sub_judul' => $this->request->getPost('sub_judul'),
                'kategori' => $this->request->getPost('kategori'),
                'isi_berita' => $this->request->getPost('isi_berita'),
                'edited_by' => $this->request->getPost('edited_by'),
            ];
            $this->ModelBerita->edit($data);
            session()->setFlashdata('pesan', 'Data berhasil diubah.');
            return redirect()->to(base_url('admin/berita'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('admin/berita'));
        }
    }

    public function delete_berita($id_berita)
    {
        $data = [
            'id_berita' => $id_berita,
        ];
        $this->ModelBerita->delete_data($data);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to(base_url('admin/berita'));
    }
}
