<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelVisi extends Model
{
    protected $table = "tb_visi";
    protected $primaryKey = "id_visi";
    protected $returnType = "object";
    protected $allowedFields = ['id_user', 'created_at', 'isi', 'edited_by', 'edited_at'];

    public function allData()
    {
        return $this->db->table('tb_visi')
            ->select('tb_visi.*, tb_user.*')
            ->join('tb_user', 'tb_user.id_user = tb_visi.id_user OR tb_user.id_user = tb_visi.edited_by', 'left')
            ->orderBy('tb_visi.created_at', 'ASC')
            ->get()->getResultArray();
    }

    public function detailData($id_visi)
    {
        return $this->db->table('tb_visi')
            ->select('tb_visi.*, tb_user.*')
            ->join('tb_user', 'tb_user.id_user = tb_visi.id_user OR tb_user.id_user = tb_visi.edited_by', 'left')
            ->where('tb_visi.id_visi', $id_visi)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tb_visi')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tb_visi')
            ->where('id_visi', $data['id_visi'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tb_visi')
            ->where('id_visi', $data['id_visi'])
            ->delete($data);
    }
}
