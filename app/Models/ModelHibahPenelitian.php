<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelHibahPenelitian extends Model
{
    protected $table = "tb_hibah_penelitian";
    protected $primaryKey = "id_hibah_penelitian";
    protected $returnType = "object";
    protected $allowedFields = ['id_hibah_penelitian', 'tahun', 'keterangan', 'skema_penelitian', 'judul_penelitian', 'ka_peneliti', 'created_at', 'created_by', 'edited_at', 'edited_by', 'edited_at', 'edited_by'];

    public function allData()
    {
        return $this->db->table('tb_hibah_penelitian')
            ->select('tb_hibah_penelitian.*, tb_user.*')
            ->join('tb_user', 'tb_user.id_user = tb_hibah_penelitian.created_by OR tb_user.id_user = tb_hibah_penelitian.edited_by', 'left')
            ->orderBy('tb_hibah_penelitian.created_at', 'ASC')
            ->get()->getResultArray();
    }

    public function detailData($id_hibah_penelitian)
    {
        return $this->db->table('tb_hibah_penelitian')
            ->select('tb_hibah_penelitian.*, tb_user.*')
            ->join('tb_user', 'tb_user.id_user = tb_hibah_penelitian.created_by OR tb_user.id_user = tb_hibah_penelitian.edited_by', 'left')
            ->where('tb_hibah_penelitian.id_hibah_penelitian', $id_hibah_penelitian)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tb_hibah_penelitian')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tb_hibah_penelitian')
            ->where('id_hibah_penelitian', $data['id_hibah_penelitian'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tb_hibah_penelitian')
            ->where('id_hibah_penelitian', $data['id_hibah_penelitian'])
            ->delete($data);
    }
}
