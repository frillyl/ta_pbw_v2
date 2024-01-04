<?php

namespace App\Controllers;

use App\Models\ModelUnduh;
use App\Models\ModelAgenda;

class Unduh extends BaseController
{
    public function __construct()
    {
        helper('form');
        helper('text');
        $this->ModelUnduh = new ModelUnduh();
        $this->ModelAgenda = new ModelAgenda();
    }

    public function index()
    {
        $data = [
            'title' => 'Lembaga Penelitian UG',
            'sub'   => 'Master Unduh',
            'isi'   => 'admin/unduh/v_index',
            'agenda' => $this->ModelAgenda->allData(),
            'unduh' => $this->ModelUnduh->allData(),
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add_unduh()
    {
        if ($this->validate([
            'id_user' => [
                'label' => 'Dipublikasi Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'keterangan' => [
                'label' => 'Keterangan',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => '{field} Wajib Diisi.',
                    'max_length' => '{field} Maksimal Memiliki Panjang 100 Karakter.'
                ]
            ],
            'file' => [
                'label' => 'File',
                'rules' => 'uploaded[file]|max_size[file,2048]|mime_in[file,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} Wajib Diunggah.',
                    'max_size' => 'Ukuran file {field} maksimal 2 MB.',
                    'mime_in' => 'Format file {field} yang diizinkan adalah PDF.'
                ]
            ]
        ])) {
            $file = $this->request->getFile('file');
            $nm_file = $file->getRandomName();
            $data = array(
                'id_user' => $this->request->getPost('id_user'),
                'keterangan' => $this->request->getPost('keterangan'),
                'file' => $nm_file
            );
            $file->move('public/assets/docs', $nm_file);
            $this->ModelUnduh->add($data);
            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
            return redirect()->to(base_url('admin/unduh'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('admin/unduh'));
        }
    }

    public function edit_unduh($id_unduh)
    {
        if ($this->validate([
            'id_user' => [
                'label' => 'Dipublikasi Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi.'
                ]
            ],
            'keterangan' => [
                'label' => 'Keterangan',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => '{field} Wajib Diisi.',
                    'max_length' => '{field} Maksimal Memiliki Panjang 100 Karakter.'
                ]
            ],
            'file' => [
                'label' => 'File',
                'rules' => 'max_size[file,2048]|mime_in[pdf,application/pdf]',
                'errors' => [
                    'max_size' => 'Ukuran file {field} maksimal 2 MB.',
                    'mime_in' => 'Format file {field} yang diizinkan adalah PDF.'
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
            $file = $this->request->getFile('file');
            if ($file->getError() == 4) {
                $data = array(
                    'id_unduh' => $id_unduh,
                    'id_user' => $this->request->getPost('id_user'),
                    'keterangan' => $this->request->getPost('keterangan'),
                    'edited_by' => $this->request->getPost('edited_by'),
                );
                $this->ModelUnduh->edit($data);
            } elseif ($file->getError() != 4) {
                $unduh = $this->ModelUnduh->detailData($id_unduh);
                if ($unduh['file'] != "") {
                    unlink('public/assets/docs/' . $unduh['file']);
                }
                $nm_file = $file->getRandomName();
                $data = array(
                    'id_unduh' => $id_unduh,
                    'id_user' => $this->request->getPost('id_user'),
                    'keterangan' => $this->request->getPost('keterangan'),
                    'edited_by' => $this->request->getPost('edited_by'),
                    'file' => $nm_file
                );
                $file->move('public/assets/docs', $nm_file);
                $this->ModelUnduh->edit($data);
            }
            session()->setFlashdata('pesan', 'Data berhasil diubah.');
            return redirect()->to(base_url('admin/unduh'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('admin/unduh'));
        }
    }

    public function delete_unduh($id_unduh)
    {
        $unduh = $this->ModelUnduh->detailData($id_unduh);
        if ($unduh['file'] != "") {
            unlink('public/assets/docs/' . $unduh['file']);
        }

        $data = [
            'id_unduh' => $id_unduh,
        ];
        $this->ModelUnduh->delete_data($data);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to(base_url('admin/unduh'));
    }
}
