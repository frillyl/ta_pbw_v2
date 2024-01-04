<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMisi extends Model
{
    protected $table = "tb_misi";
    protected $primaryKey = "id_misi";
    protected $returnType = "object";
    protected $allowedFields = ['id_user', 'created_at', 'isi', 'edited_by', 'edited_at'];

    public function allData()
    {
        return $this->db->table('tb_misi')
            ->select('tb_misi.*, tb_user.*')
            ->join('tb_user', 'tb_user.id_user = tb_misi.id_user OR tb_user.id_user = tb_misi.edited_by', 'left')
            ->orderBy('tb_misi.created_at', 'ASC')
            ->get()->getResultArray();
    }

    public function detailData($id_misi)
    {
        return $this->db->table('tb_misi')
            ->select('tb_misi.*, tb_user.*')
            ->join('tb_user', 'tb_user.id_user = tb_misi.id_user OR tb_user.id_user = tb_misi.edited_by', 'left')
            ->where('tb_misi.id_misi', $id_misi)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tb_misi')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tb_misi')
            ->where('id_misi', $data['id_misi'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tb_misi')
            ->where('id_misi', $data['id_misi'])
            ->delete($data);
    }
}
