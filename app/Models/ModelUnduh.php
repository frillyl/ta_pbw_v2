<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUnduh extends Model
{
    protected $table = "tb_unduh";
    protected $primaryKey = "id_unduh";
    protected $returnTypes = "object";
    protected $allowedFields = ['id_user', 'created_at', 'keterangan', 'file', 'edited_by', 'edited_at'];

    public function allData()
    {
        return $this->db->table('tb_unduh')
            ->select('tb_unduh.*, tb_user.*')
            ->join('tb_user', 'tb_user.id_user = tb_unduh.id_user OR tb_user.id_user = tb_unduh.edited_by', 'left')
            ->orderBy('tb_unduh.created_at', 'ASC')
            ->get()->getResultArray();
    }

    public function detailData($id_unduh)
    {
        return $this->db->table('tb_unduh')
            ->select('tb_unduh.*, tb_user.*')
            ->join('tb_user', 'tb_user.id_user = tb_unduh.id_user OR tb_user.id_user = tb_unduh.edited_by', 'left')
            ->where('tb_unduh.id_misi', $id_unduh)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tb_unduh')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tb_unduh')
            ->where('id_unduh', $data['id_unduh'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tb_unduh')
            ->where('id_unduh', $data['id_unduh'])
            ->delete($data);
    }
}
