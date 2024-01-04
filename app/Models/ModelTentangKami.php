<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTentangKami extends Model
{
    protected $table = "tb_ta_pbw";
    protected $primaryKey = "id_tentang_kami";
    protected $returnType = "object";
    protected $allowedFields = ['id_user', 'created_at', 'isi', 'edited_by', 'edited_at', 'status'];

    public function allData()
    {
        return $this->db->table('tb_tentang_kami')
            ->join('tb_user', 'tb_user.id_user = tb_tentang_kami.id_user AND tb_user.id_user = tb_tentang_kami.edited_by', 'left')
            ->orderBy('tb_tentang_kami.created_at', 'ASC')
            ->get()->getResultArray();
    }

    public function detailData($id_tentang_kami)
    {
        return $this->db->table('tb_tentang_kami')
            ->where('id_tentang_kami', $id_tentang_kami)
            ->get()->getRowArray();
    }

    public function tampilData()
    {
        return $this->db->table('tb_tentang_kami')
            ->where('status', 1)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tb_tentang_kami')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tb_tentang_kami')
            ->where('id_tentang_kami', $data['id_tentang_kami'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tb_tentang_kami')
            ->where('id_tentang_kami', $data['id_tentang_kami'])
            ->delete($data);
    }
}
