<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPengguna extends Model
{
    protected $table = "tb_user";
    protected $primaryKey = "id_user";
    protected $returnType = "object";
    protected $allowedFields = ['id_user', 'nm_user', 'email', 'password', 'role'];

    public function allData()
    {
        return $this->db->table('tb_user')
            ->orderBy('nm_user', 'ASC')
            ->get()->getResultArray();
    }

    public function detailData($id_user)
    {
        $this->db->table('tb_user')
            ->where('id_user', $id_user)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tb_user')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tb_user')
            ->where('id_user', $data['id_user'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tb_user')
            ->where('id_user', $data['id_user'])
            ->delete($data);
    }
}
