<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBerita extends Model
{
    protected $table = "tb_berita";
    protected $primaryKey = "id_berita";
    protected $returnType = "object";
    protected $allowedFields = ['id_user', 'created_at', 'judul_berita', 'sub_judul', 'kategori', 'isi_berita', 'edited_by', 'edited_at'];

    public function allData()
    {
        return $this->db->table('tb_berita')
            ->select('tb_berita.*, tb_user.*')
            ->join('tb_user', 'tb_user.id_user = tb_berita.id_user OR tb_user.id_user = tb_berita.edited_by', 'left')
            ->orderBy('tb_berita.created_at', 'ASC')
            ->get()->getResultArray();
    }

    public function detailData($id_berita)
    {
        return $this->db->table('tb_berita')
            ->select('tb_berita.*, tb_user.*')
            ->join('tb_user', 'tb_user.id_user = tb_berita.id_user OR tb_user.id_user = tb_berita.edited_by', 'left')
            ->where('tb_berita.id_misi', $id_berita)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tb_berita')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tb_berita')
            ->where('id_berita', $data['id_berita'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tb_berita')
            ->where('id_berita', $data['id_berita'])
            ->delete($data);
    }
}
