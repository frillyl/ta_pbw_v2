<?php

namespace App\Controllers;

use App\Models\ModelAgenda;
use App\Models\ModelHibahDana;
use App\Models\ModelHibahPenelitian;

class Hibah extends BaseController
{
    public function __construct()
    {
        helper('form');
        helper('text');
        $this->ModelAgenda = new ModelAgenda();
        $this->ModelHibahDana = new ModelHibahDana();
        $this->ModelHibahPenelitian = new ModelHibahPenelitian();
    }

    public function index_dana()
    {
        $data = [
            'title' => 'Lembaga Penelitian UG',
            'sub'   => 'Master Daftar Penerima Hibah Dana',
            'isi'   => 'admin/hibah/dana/v_index',
            'dana'  => $this->ModelHibahDana->allData(),
            'agenda' => $this->ModelAgenda->allData()
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add_dana()
    {
        if ($this->validate([
            'batch' => [
                'label' => 'Batch',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'ka_peneliti' => [
                'label' => 'Ketua Peneliti',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'judul' => [
                'label' => 'Judul',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'created_by' => [
                'label' => 'Dibuat Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ]
        ])) {
            $data = [
                'batch' => $this->request->getPost('batch'),
                'ka_peneliti' => $this->request->getPost('ka_peneliti'),
                'judul' => $this->request->getPost('judul'),
                'created_by' => $this->request->getPost('created_by')
            ];
            $this->ModelHibahDana->add($data);
            session()->setFlashdata('pesan', 'Data Berhasil di Tambahkan.');
            return redirect()->to(base_url('admin/hibah/dana'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('admin/hibah/dana'));
        }
    }

    public function edit_dana()
    {
        if ($this->validate([
            'batch' => [
                'label' => 'Batch',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'ka_peneliti' => [
                'label' => 'Ketua Peneliti',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'judul' => [
                'label' => 'Judul',
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
            ]
        ])) {
            $data = [
                'id_hibah_dana' => $id_hibah_dana,
                'batch' => $this->request->getPost('batch'),
                'ka_peneliti' => $this->request->getPost('ka_peneliti'),
                'judul' => $this->request->getPost('judul'),
                'edited_by' => $this->request->getPost('edited_by')
            ];
            $this->ModelHibahDana->edit($data);
            session()->setFlashdata('pesan', 'Data berhasil diedit.');
            return redirect()->to(base_url('admin/hibah/dana'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('admin/hibah/dana'));
        }
    }

    public function delete_dana($id_hibah_dana)
    {
        $data = [
            'id_hibah_dana' => $id_hibah_dana,
        ];
        $this->ModelHibahDana->delete_data($data);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to(base_url('admin/hibah/dana'));
    }

    public function index_penelitian()
    {
        $data = [
            'title' => 'Lembaga Penelitian UG',
            'sub'   => 'Master Daftar Penerima Hibah Penelitian',
            'isi'   => 'admin/hibah/penelitian/v_index',
            'penelitian' => $this->ModelHibahPenelitian->allData(),
            'agenda' => $this->ModelAgenda->allData()
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add_penelitian()
    {
        if ($this->validate([
            'tahun' => [
                'label' => 'Tahun',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'keterangan' => [
                'label' => 'Keterangan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'skema_penelitian' => [
                'label' => 'Skema Penelitian',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'judul_penelitian' => [
                'label' => 'Judul Penelitian',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'ka_peneliti' => [
                'label' => 'Ketua Peneliti',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'created_by' => [
                'label' => 'Dibuat Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ]
        ])) {
            $data = [
                'tahun' => $this->request->getPost('tahun'),
                'keterangan' => $this->request->getPost('keterangan'),
                'skema_penelitian' => $this->request->getPost('skema_penelitian'),
                'judul_penelitian' => $this->request->getPost('judul_penelitian'),
                'ka_peneliti' => $this->request->getPost('ka_peneliti'),
                'created_by' => $this->request->getPost('created_by')
            ];
            $this->ModelHibahPenelitian->add($data);
            session()->setFlashdata('pesan', 'Data Berhasil di Tambahkan.');
            return redirect()->to(base_url('admin/hibah/penelitian'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('admin/hibah/penelitian'));
        }
    }

    public function edit_penelitian()
    {
        if ($this->validate([
            'tahun' => [
                'label' => 'Tahun',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'keterangan' => [
                'label' => 'Keterangan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'skema_penelitian' => [
                'label' => 'Skema Penelitian',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'judul_penelitian' => [
                'label' => 'Judul Penelitian',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'ka_peneliti' => [
                'label' => 'Ketua Peneliti',
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
            ]
        ])) {
            $data = [
                'id_hibah_penelitian' => $id_hibah_penelitian,
                'tahun' => $this->request->getPost('tahun'),
                'keterangan' => $this->request->getPost('keterangan'),
                'skema_penelitian' => $this->request->getPost('skema_penelitian'),
                'judul_penelitian' => $this->request->getPost('judul_penelitian'),
                'ka_peneliti' => $this->request->getPost('ka_peneliti'),
                'edited_by' => $this->request->getPost('edited_by')
            ];
            $this->ModelHibahPenelitian->edit($data);
            session()->setFlashdata('pesan', 'Data berhasil diedit.');
            return redirect()->to(base_url('admin/hibah/penelitian'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('admin/hibah/penelitian'));
        }
    }

    public function delete_penelitian($id_hibah_penelitian)
    {
        $data = [
            'id_hibah_penelitian' => $id_hibah_penelitian,
        ];
        $this->ModelHibahPenelitian->delete_data($data);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to(base_url('admin/hibah/penelitian'));
    }
}
