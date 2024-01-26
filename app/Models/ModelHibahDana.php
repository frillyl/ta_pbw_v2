<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelHibahDana extends Model
{
    protected $table = "tb_hibah_dana";
    protected $primaryKey = "id_hibah_dana";
    protected $returnType = "object";
    protected $allowedFields = ['id_hibah_dana', 'tahun', 'batch', 'ka_peneliti', 'judul', 'created_at', 'created_by', 'edited_at', 'edited_by'];

    public function allData()
    {
        return $this->db->table('tb_hibah_dana')
            ->select('tb_hibah_dana.*, tb_user.*')
            ->join('tb_user', 'tb_user.id_user = tb_hibah_dana.created_by OR tb_user.id_user = tb_hibah_dana.edited_by', 'left')
            ->orderBy('tb_hibah_dana.created_at', 'ASC')
            ->get()->getResultArray();
    }

    public function detailData($id_hibah_dana)
    {
        return $this->db->table('tb_hibah_dana')
            ->select('tb_hibah_dana.*, tb_user.*')
            ->join('tb_user', 'tb_user.id_user = tb_hibah_dana.created_by OR tb_user.id_user = tb_hibah_dana.edited_by', 'left')
            ->where('tb_hibah_dana.id_hibah_dana', $id_hibah_dana)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tb_hibah_dana')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tb_hibah_dana')
            ->where('id_hibah_dana', $data['id_hibah_dana'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tb_hibah_dana')
            ->where('id_hibah_dana', $data['id_hibah_dana'])
            ->delete($data);
    }
}
