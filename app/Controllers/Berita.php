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
            ],
            'main_image' => [
                'label' => 'Foto Utama',
                'rules' => 'uploaded[main_image]|mime_in[main_image,image/png,image/jpg]',
                'errors' => [
                    'uploaded' => '{field} Required.',
                    'mime_in' => 'Format File {field} Harus JPG/PNG.'
                ]
            ],
            'image1' => [
                'label' => 'Foto 1',
                'rules' => 'mime_in[image1,image/png,image/jpg]',
                'errors' => [
                    'mime_in' => 'Format File {field} Harus JPG/PNG.'
                ]
            ],
            'image2' => [
                'label' => 'Foto 2',
                'rules' => 'mime_in[image2,image/png,image/jpg]',
                'errors' => [
                    'mime_in' => 'Format File {field} Harus JPG/PNG.'
                ]
            ],
            'image3' => [
                'label' => 'Foto 3',
                'rules' => 'mime_in[image3,image/png,image/jpg]',
                'errors' => [
                    'mime_in' => 'Format File {field} Harus JPG/PNG.'
                ]
            ]
        ])) {
            $main_image = $this->request->getFile('main_image');
            $image1 = $this->request->getFile('image1');
            $image2 = $this->request->getFile('image2');
            $image3 = $this->request->getFile('image3');
            if ($main_image->getError() != 4 && $image1->getError() == 4 && $image2->getError() == 4 && $image3->getError() == 4) {
                $nm_main_image = $main_image->getRandomName();
                $data = array(
                    'id_user' => $this->request->getPost('id_user'),
                    'judul_berita' => $this->request->getPost('judul_berita'),
                    'sub_judul' => $this->request->getPost('sub_judul'),
                    'kategori' => $this->request->getPost('kategori'),
                    'isi_berita' => $this->request->getPost('isi_berita'),
                    'main_image' => $nm_main_image
                );
                $main_image->move('public/assets/media', $nm_main_image);
                $this->ModelBerita->add($data);
            } elseif ($main_image->getError() != 4 && $image1->getError() != 4 && $image2->getError() == 4 && $image3->getError() == 4) {
                $nm_main_image = $main_image->getRandomName();
                $nm_image1 = $image1->getRandomName();
                $data = array(
                    'id_user' => $this->request->getPost('id_user'),
                    'judul_berita' => $this->request->getPost('judul_berita'),
                    'sub_judul' => $this->request->getPost('sub_judul'),
                    'kategori' => $this->request->getPost('kategori'),
                    'isi_berita' => $this->request->getPost('isi_berita'),
                    'main_image' => $nm_main_image,
                    'image1' => $nm_image1,
                );
                $main_image->move('public/assets/media', $nm_main_image);
                $image1->move('public/assets/media', $nm_image1);
                $this->ModelBerita->add($data);
            } elseif ($main_image->getError() != 4 && $image1->getError() != 4 && $image2->getError() != 4 && $image3->getError() == 4) {
                $nm_main_image = $main_image->getRandomName();
                $nm_image1 = $image1->getRandomName();
                $nm_image2 = $image2->getRandomName();
                $data = array(
                    'id_user' => $this->request->getPost('id_user'),
                    'judul_berita' => $this->request->getPost('judul_berita'),
                    'sub_judul' => $this->request->getPost('sub_judul'),
                    'kategori' => $this->request->getPost('kategori'),
                    'isi_berita' => $this->request->getPost('isi_berita'),
                    'main_image' => $nm_main_image,
                    'image1' => $nm_image1,
                    'image2' => $nm_image2,
                );
                $main_image->move('public/assets/media', $nm_main_image);
                $image1->move('public/assets/media', $nm_image1);
                $image2->move('public/assets/media', $nm_image2);
                $this->ModelBerita->add($data);
            } elseif ($main_image->getError() != 4 && $image1->getError() != 4 && $image2->getError() != 4 && $image3->getError() != 4) {
                $nm_main_image = $main_image->getRandomName();
                $nm_image1 = $image1->getRandomName();
                $nm_image2 = $image2->getRandomName();
                $nm_image3 = $image3->getRandomName();
                $data = array(
                    'id_user' => $this->request->getPost('id_user'),
                    'judul_berita' => $this->request->getPost('judul_berita'),
                    'sub_judul' => $this->request->getPost('sub_judul'),
                    'kategori' => $this->request->getPost('kategori'),
                    'isi_berita' => $this->request->getPost('isi_berita'),
                    'main_image' => $nm_main_image,
                    'image1' => $nm_image1,
                    'image2' => $nm_image2,
                    'image3' => $nm_image3,
                );
                $main_image->move('public/assets/media', $nm_main_image);
                $image1->move('public/assets/media', $nm_image1);
                $image2->move('public/assets/media', $nm_image2);
                $image3->move('public/assets/media', $nm_image3);
                $this->ModelBerita->add($data);
            } elseif ($main_image->getError() != 4 && $image1->getError() == 4 && $image2->getError() != 4 && $image3->getError() == 4) {
                $nm_main_image = $main_image->getRandomName();
                $nm_image2 = $image2->getRandomName();
                $data = array(
                    'id_user' => $this->request->getPost('id_user'),
                    'judul_berita' => $this->request->getPost('judul_berita'),
                    'sub_judul' => $this->request->getPost('sub_judul'),
                    'kategori' => $this->request->getPost('kategori'),
                    'isi_berita' => $this->request->getPost('isi_berita'),
                    'main_image' => $nm_main_image,
                    'image2' => $nm_image2,
                );
                $main_image->move('public/assets/media', $nm_main_image);
                $image2->move('public/assets/media', $nm_image2);
                $this->ModelBerita->add($data);
            } elseif ($main_image->getError() != 4 && $image1->getError() == 4 && $image2->getError() == 4 && $image3->getError() != 4) {
                $nm_main_image = $main_image->getRandomName();
                $nm_image3 = $image3->getRandomName();
                $data = array(
                    'id_user' => $this->request->getPost('id_user'),
                    'judul_berita' => $this->request->getPost('judul_berita'),
                    'sub_judul' => $this->request->getPost('sub_judul'),
                    'kategori' => $this->request->getPost('kategori'),
                    'isi_berita' => $this->request->getPost('isi_berita'),
                    'main_image' => $nm_main_image,
                    'image3' => $nm_image3,
                );
                $main_image->move('public/assets/media', $nm_main_image);
                $image3->move('public/assets/media', $nm_image3);
                $this->ModelBerita->add($data);
            } elseif ($main_image->getError() != 4 && $image1->getError() == 4 && $image2->getError() != 4 && $image3->getError() != 4) {
                $nm_main_image = $main_image->getRandomName();
                $nm_image2 = $image2->getRandomName();
                $nm_image3 = $image3->getRandomName();
                $data = array(
                    'id_user' => $this->request->getPost('id_user'),
                    'judul_berita' => $this->request->getPost('judul_berita'),
                    'sub_judul' => $this->request->getPost('sub_judul'),
                    'kategori' => $this->request->getPost('kategori'),
                    'isi_berita' => $this->request->getPost('isi_berita'),
                    'main_image' => $nm_main_image,
                    'image2' => $nm_image2,
                    'image3' => $nm_image3,
                );
                $main_image->move('public/assets/media', $nm_main_image);
                $image2->move('public/assets/media', $nm_image2);
                $image3->move('public/assets/media', $nm_image3);
                $this->ModelBerita->add($data);
            } elseif ($main_image->getError() != 4 && $image1->getError() != 4 && $image2->getError() == 4 && $image3->getError() != 4) {
                $nm_main_image = $main_image->getRandomName();
                $nm_image1 = $image1->getRandomName();
                $nm_image3 = $image3->getRandomName();
                $data = array(
                    'id_user' => $this->request->getPost('id_user'),
                    'judul_berita' => $this->request->getPost('judul_berita'),
                    'sub_judul' => $this->request->getPost('sub_judul'),
                    'kategori' => $this->request->getPost('kategori'),
                    'isi_berita' => $this->request->getPost('isi_berita'),
                    'main_image' => $nm_main_image,
                    'image1' => $nm_image1,
                    'image3' => $nm_image3,
                );
                $main_image->move('public/assets/media', $nm_main_image);
                $image1->move('public/assets/media', $nm_image1);
                $image3->move('public/assets/media', $nm_image3);
                $this->ModelBerita->add($data);
            }
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
            'main_image' => [
                'label' => 'Foto Utama',
                'rules' => 'mime_in[main_image,image/png,image/jpg]',
                'errors' => [
                    'mime_in' => 'Format File {field} Harus JPG/PNG.'
                ]
            ],
            'image1' => [
                'label' => 'Foto 1',
                'rules' => 'mime_in[image1,image/png,image/jpg]',
                'errors' => [
                    'mime_in' => 'Format File {field} Harus JPG/PNG.'
                ]
            ],
            'image2' => [
                'label' => 'Foto 2',
                'rules' => 'mime_in[image2,image/png,image/jpg]',
                'errors' => [
                    'mime_in' => 'Format File {field} Harus JPG/PNG.'
                ]
            ],
            'image3' => [
                'label' => 'Foto 3',
                'rules' => 'mime_in[image3,image/png,image/jpg]',
                'errors' => [
                    'mime_in' => 'Format File {field} Harus JPG/PNG.'
                ]
            ]
        ])) {
            $main_image = $this->request->getFile('main_image');
            $image1 = $this->request->getFile('image1');
            $image2 = $this->request->getFile('image2');
            $image3 = $this->request->getFile('image3');
            if ($main_image->getError() != 4 && $image1->getError() == 4 && $image2->getError() == 4 && $image3->getError() == 4) {
                $berita = $this->ModelBerita->detailData($id_berita);
                if ($berita['main_image'] != "") {
                    unlink('public/assets/media/' . $berita['main_image']);
                }
                $nm_main_image = $main_image->getRandomName();
                $data = array(
                    'id_user' => $this->request->getPost('id_user'),
                    'judul_berita' => $this->request->getPost('judul_berita'),
                    'sub_judul' => $this->request->getPost('sub_judul'),
                    'kategori' => $this->request->getPost('kategori'),
                    'isi_berita' => $this->request->getPost('isi_berita'),
                    'main_image' => $nm_main_image
                );
                $main_image->move('public/assets/media', $nm_main_image);
                $this->ModelBerita->add($data);
            } elseif ($main_image->getError() != 4 && $image1->getError() != 4 && $image2->getError() == 4 && $image3->getError() == 4) {
                $berita = $this->ModelBerita->detailData($id_berita);
                if ($berita['main_image'] != "") {
                    if ($berita['image1'] != "") {
                        unlink('public/assets/media/' . $berita['main_image']);
                        unlink('public/assets/media/' . $berita['image1']);
                    }
                }
                $nm_main_image = $main_image->getRandomName();
                $nm_image1 = $image1->getRandomName();
                $data = array(
                    'id_user' => $this->request->getPost('id_user'),
                    'judul_berita' => $this->request->getPost('judul_berita'),
                    'sub_judul' => $this->request->getPost('sub_judul'),
                    'kategori' => $this->request->getPost('kategori'),
                    'isi_berita' => $this->request->getPost('isi_berita'),
                    'main_image' => $nm_main_image,
                    'image1' => $nm_image1,
                );
                $main_image->move('public/assets/media', $nm_main_image);
                $image1->move('public/assets/media', $nm_image1);
                $this->ModelBerita->add($data);
            } elseif ($main_image->getError() != 4 && $image1->getError() != 4 && $image2->getError() != 4 && $image3->getError() == 4) {
                $berita = $this->ModelBerita->detailData($id_berita);
                if ($berita['main_image'] != "") {
                    if ($berita['image1'] != "") {
                        if ($berita['image2'] != "") {
                            unlink('public/assets/media/' . $berita['main_image']);
                            unlink('public/assets/media/' . $berita['image1']);
                            unlink('public/assets/media/' . $berita['image2']);
                        }
                    }
                }
                $nm_main_image = $main_image->getRandomName();
                $nm_image1 = $image1->getRandomName();
                $nm_image2 = $image2->getRandomName();
                $data = array(
                    'id_user' => $this->request->getPost('id_user'),
                    'judul_berita' => $this->request->getPost('judul_berita'),
                    'sub_judul' => $this->request->getPost('sub_judul'),
                    'kategori' => $this->request->getPost('kategori'),
                    'isi_berita' => $this->request->getPost('isi_berita'),
                    'main_image' => $nm_main_image,
                    'image1' => $nm_image1,
                    'image2' => $nm_image2,
                );
                $main_image->move('public/assets/media', $nm_main_image);
                $image1->move('public/assets/media', $nm_image1);
                $image2->move('public/assets/media', $nm_image2);
                $this->ModelBerita->add($data);
            } elseif ($main_image->getError() != 4 && $image1->getError() != 4 && $image2->getError() != 4 && $image3->getError() != 4) {
                $berita = $this->ModelBerita->detailData($id_berita);
                if ($berita['main_image'] != "") {
                    if ($berita['image1'] != "") {
                        if ($berita['image2'] != "") {
                            if ($berita['image3'] != "") {
                                unlink('public/assets/media/' . $berita['main_image']);
                                unlink('public/assets/media/' . $berita['image1']);
                                unlink('public/assets/media/' . $berita['image2']);
                                unlink('public/assets/media/' . $berita['image3']);
                            }
                        }
                    }
                }
                $nm_main_image = $main_image->getRandomName();
                $nm_image1 = $image1->getRandomName();
                $nm_image2 = $image2->getRandomName();
                $nm_image3 = $image3->getRandomName();
                $data = array(
                    'id_user' => $this->request->getPost('id_user'),
                    'judul_berita' => $this->request->getPost('judul_berita'),
                    'sub_judul' => $this->request->getPost('sub_judul'),
                    'kategori' => $this->request->getPost('kategori'),
                    'isi_berita' => $this->request->getPost('isi_berita'),
                    'main_image' => $nm_main_image,
                    'image1' => $nm_image1,
                    'image2' => $nm_image2,
                    'image3' => $nm_image3,
                );
                $main_image->move('public/assets/media', $nm_main_image);
                $image1->move('public/assets/media', $nm_image1);
                $image2->move('public/assets/media', $nm_image2);
                $image3->move('public/assets/media', $nm_image3);
                $this->ModelBerita->add($data);
            } elseif ($main_image->getError() != 4 && $image1->getError() == 4 && $image2->getError() != 4 && $image3->getError() == 4) {
                $berita = $this->ModelBerita->detailData($id_berita);
                if ($berita['main_image'] != "") {
                    if ($berita['image2'] != "") {
                        unlink('public/assets/media/' . $berita['main_image']);
                        unlink('public/assets/media/' . $berita['image2']);
                    }
                }
                $nm_main_image = $main_image->getRandomName();
                $nm_image2 = $image2->getRandomName();
                $data = array(
                    'id_user' => $this->request->getPost('id_user'),
                    'judul_berita' => $this->request->getPost('judul_berita'),
                    'sub_judul' => $this->request->getPost('sub_judul'),
                    'kategori' => $this->request->getPost('kategori'),
                    'isi_berita' => $this->request->getPost('isi_berita'),
                    'main_image' => $nm_main_image,
                    'image2' => $nm_image2,
                );
                $main_image->move('public/assets/media', $nm_main_image);
                $image2->move('public/assets/media', $nm_image2);
                $this->ModelBerita->add($data);
            } elseif ($main_image->getError() != 4 && $image1->getError() == 4 && $image2->getError() == 4 && $image3->getError() != 4) {
                $berita = $this->ModelBerita->detailData($id_berita);
                if ($berita['main_image'] != "") {
                    if ($berita['image3'] != "") {
                        unlink('public/assets/media/' . $berita['main_image']);
                        unlink('public/assets/media/' . $berita['image3']);
                    }
                }
                $nm_main_image = $main_image->getRandomName();
                $nm_image3 = $image3->getRandomName();
                $data = array(
                    'id_user' => $this->request->getPost('id_user'),
                    'judul_berita' => $this->request->getPost('judul_berita'),
                    'sub_judul' => $this->request->getPost('sub_judul'),
                    'kategori' => $this->request->getPost('kategori'),
                    'isi_berita' => $this->request->getPost('isi_berita'),
                    'main_image' => $nm_main_image,
                    'image3' => $nm_image3,
                );
                $main_image->move('public/assets/media', $nm_main_image);
                $image3->move('public/assets/media', $nm_image3);
                $this->ModelBerita->add($data);
            } elseif ($main_image->getError() != 4 && $image1->getError() == 4 && $image2->getError() != 4 && $image3->getError() != 4) {
                $berita = $this->ModelBerita->detailData($id_berita);
                if ($berita['main_image'] != "") {
                    if ($berita['image2'] != "") {
                        if ($berita['image3'] != "") {
                            unlink('public/assets/media/' . $berita['main_image']);
                            unlink('public/assets/media/' . $berita['image2']);
                            unlink('public/assets/media/' . $berita['image3']);
                        }
                    }
                }
                $nm_main_image = $main_image->getRandomName();
                $nm_image2 = $image2->getRandomName();
                $nm_image3 = $image3->getRandomName();
                $data = array(
                    'id_user' => $this->request->getPost('id_user'),
                    'judul_berita' => $this->request->getPost('judul_berita'),
                    'sub_judul' => $this->request->getPost('sub_judul'),
                    'kategori' => $this->request->getPost('kategori'),
                    'isi_berita' => $this->request->getPost('isi_berita'),
                    'main_image' => $nm_main_image,
                    'image2' => $nm_image2,
                    'image3' => $nm_image3,
                );
                $main_image->move('public/assets/media', $nm_main_image);
                $image2->move('public/assets/media', $nm_image2);
                $image3->move('public/assets/media', $nm_image3);
                $this->ModelBerita->add($data);
            } elseif ($main_image->getError() != 4 && $image1->getError() != 4 && $image2->getError() == 4 && $image3->getError() != 4) {
                $berita = $this->ModelBerita->detailData($id_berita);
                if ($berita['main_image'] != "") {
                    if ($berita['image1'] != "") {
                        if ($berita['image3'] != "") {
                            unlink('public/assets/media/' . $berita['main_image']);
                            unlink('public/assets/media/' . $berita['image1']);
                            unlink('public/assets/media/' . $berita['image3']);
                        }
                    }
                }
                $nm_main_image = $main_image->getRandomName();
                $nm_image1 = $image1->getRandomName();
                $nm_image3 = $image3->getRandomName();
                $data = array(
                    'id_user' => $this->request->getPost('id_user'),
                    'judul_berita' => $this->request->getPost('judul_berita'),
                    'sub_judul' => $this->request->getPost('sub_judul'),
                    'kategori' => $this->request->getPost('kategori'),
                    'isi_berita' => $this->request->getPost('isi_berita'),
                    'main_image' => $nm_main_image,
                    'image1' => $nm_image1,
                    'image3' => $nm_image3,
                );
                $main_image->move('public/assets/media', $nm_main_image);
                $image1->move('public/assets/media', $nm_image1);
                $image3->move('public/assets/media', $nm_image3);
                $this->ModelBerita->add($data);
            } elseif ($main_image->getError() == 4 && $image1->getError() == 4 && $image2->getError() == 4 && $image3->getError() == 4) {
                $data = array(
                    'id_user' => $this->request->getPost('id_user'),
                    'judul_berita' => $this->request->getPost('judul_berita'),
                    'sub_judul' => $this->request->getPost('sub_judul'),
                    'kategori' => $this->request->getPost('kategori'),
                    'isi_berita' => $this->request->getPost('isi_berita'),
                );
                $this->ModelBerita->add($data);
            } elseif ($main_image->getError() == 4 && $image1->getError() != 4 && $image2->getError() == 4 && $image3->getError() == 4) {
                $berita = $this->ModelBerita->detailData($id_berita);
                if ($berita['image1'] != "") {
                    unlink('public/assets/media/' . $berita['image1']);
                }
                $nm_image1 = $image1->getRandomName();
                $data = array(
                    'id_user' => $this->request->getPost('id_user'),
                    'judul_berita' => $this->request->getPost('judul_berita'),
                    'sub_judul' => $this->request->getPost('sub_judul'),
                    'kategori' => $this->request->getPost('kategori'),
                    'isi_berita' => $this->request->getPost('isi_berita'),
                    'image1' => $nm_image1,
                );
                $image1->move('public/assets/media', $nm_image1);
                $this->ModelBerita->add($data);
            } elseif ($main_image->getError() == 4 && $image1->getError() != 4 && $image2->getError() != 4 && $image3->getError() == 4) {
                $berita = $this->ModelBerita->detailData($id_berita);
                if ($berita['image1'] != "") {
                    if ($berita['image2'] != "") {
                        unlink('public/assets/media/' . $berita['image1']);
                        unlink('public/assets/media/' . $berita['image2']);
                    }
                }
                $nm_image1 = $image1->getRandomName();
                $nm_image2 = $image2->getRandomName();
                $data = array(
                    'id_user' => $this->request->getPost('id_user'),
                    'judul_berita' => $this->request->getPost('judul_berita'),
                    'sub_judul' => $this->request->getPost('sub_judul'),
                    'kategori' => $this->request->getPost('kategori'),
                    'isi_berita' => $this->request->getPost('isi_berita'),
                    'image1' => $nm_image1,
                    'image2' => $nm_image2,
                );
                $image1->move('public/assets/media', $nm_image1);
                $image2->move('public/assets/media', $nm_image2);
                $this->ModelBerita->add($data);
            } elseif ($main_image->getError() == 4 && $image1->getError() != 4 && $image2->getError() != 4 && $image3->getError() != 4) {
                $berita = $this->ModelBerita->detailData($id_berita);
                if ($berita['image1'] != "") {
                    if ($berita['image2'] != "") {
                        if ($berita['image3'] != "") {
                            unlink('public/assets/media/' . $berita['image1']);
                            unlink('public/assets/media/' . $berita['image2']);
                            unlink('public/assets/media/' . $berita['image3']);
                        }
                    }
                }
                $nm_image1 = $image1->getRandomName();
                $nm_image2 = $image2->getRandomName();
                $nm_image3 = $image3->getRandomName();
                $data = array(
                    'id_user' => $this->request->getPost('id_user'),
                    'judul_berita' => $this->request->getPost('judul_berita'),
                    'sub_judul' => $this->request->getPost('sub_judul'),
                    'kategori' => $this->request->getPost('kategori'),
                    'isi_berita' => $this->request->getPost('isi_berita'),
                    'image1' => $nm_image1,
                    'image2' => $nm_image2,
                    'image3' => $nm_image3,
                );
                $image1->move('public/assets/media', $nm_image1);
                $image2->move('public/assets/media', $nm_image2);
                $image3->move('public/assets/media', $nm_image3);
                $this->ModelBerita->add($data);
            } elseif ($main_image->getError() == 4 && $image1->getError() == 4 && $image2->getError() != 4 && $image3->getError() == 4) {
                $berita = $this->ModelBerita->detailData($id_berita); {
                    if ($berita['image2'] != "") {
                        unlink('public/assets/media/' . $berita['image2']);
                    }
                }
                $nm_image2 = $image2->getRandomName();
                $data = array(
                    'id_user' => $this->request->getPost('id_user'),
                    'judul_berita' => $this->request->getPost('judul_berita'),
                    'sub_judul' => $this->request->getPost('sub_judul'),
                    'kategori' => $this->request->getPost('kategori'),
                    'isi_berita' => $this->request->getPost('isi_berita'),
                    'image2' => $nm_image2,
                );
                $image2->move('public/assets/media', $nm_image2);
                $this->ModelBerita->add($data);
            } elseif ($main_image->getError() == 4 && $image1->getError() == 4 && $image2->getError() == 4 && $image3->getError() != 4) {
                $berita = $this->ModelBerita->detailData($id_berita);
                if ($berita['image3'] != "") {
                    unlink('public/assets/media/' . $berita['image3']);
                }
                $nm_image3 = $image3->getRandomName();
                $data = array(
                    'id_user' => $this->request->getPost('id_user'),
                    'judul_berita' => $this->request->getPost('judul_berita'),
                    'sub_judul' => $this->request->getPost('sub_judul'),
                    'kategori' => $this->request->getPost('kategori'),
                    'isi_berita' => $this->request->getPost('isi_berita'),
                    'image3' => $nm_image3,
                );
                $image3->move('public/assets/media', $nm_image3);
                $this->ModelBerita->add($data);
            } elseif ($main_image->getError() == 4 && $image1->getError() == 4 && $image2->getError() != 4 && $image3->getError() != 4) {
                $berita = $this->ModelBerita->detailData($id_berita);
                    if ($berita['image2'] != "") {
                        if ($berita['image3'] != "") {
                            unlink('public/assets/media/' . $berita['main_image']);
                            unlink('public/assets/media/' . $berita['image2']);
                            unlink('public/assets/media/' . $berita['image3']);
                        }
                    }
                $nm_image2 = $image2->getRandomName();
                $nm_image3 = $image3->getRandomName();
                $data = array(
                    'id_user' => $this->request->getPost('id_user'),
                    'judul_berita' => $this->request->getPost('judul_berita'),
                    'sub_judul' => $this->request->getPost('sub_judul'),
                    'kategori' => $this->request->getPost('kategori'),
                    'isi_berita' => $this->request->getPost('isi_berita'),
                    'image2' => $nm_image2,
                    'image3' => $nm_image3,
                );
                $image2->move('public/assets/media', $nm_image2);
                $image3->move('public/assets/media', $nm_image3);
                $this->ModelBerita->add($data);
            } elseif ($main_image->getError() == 4 && $image1->getError() != 4 && $image2->getError() == 4 && $image3->getError() != 4) {
                $berita = $this->ModelBerita->detailData($id_berita);
                    if ($berita['image1'] != "") {
                        if ($berita['image3'] != "") {
                            unlink('public/assets/media/' . $berita['main_image']);
                            unlink('public/assets/media/' . $berita['image1']);
                            unlink('public/assets/media/' . $berita['image3']);
                        }
                    }
                $nm_image1 = $image1->getRandomName();
                $nm_image3 = $image3->getRandomName();
                $data = array(
                    'id_user' => $this->request->getPost('id_user'),
                    'judul_berita' => $this->request->getPost('judul_berita'),
                    'sub_judul' => $this->request->getPost('sub_judul'),
                    'kategori' => $this->request->getPost('kategori'),
                    'isi_berita' => $this->request->getPost('isi_berita'),
                    'image1' => $nm_image1,
                    'image3' => $nm_image3,
                );
                $image1->move('public/assets/media', $nm_image1);
                $image3->move('public/assets/media', $nm_image3);
                $this->ModelBerita->add($data);
            }
            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
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
