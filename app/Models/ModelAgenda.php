<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAgenda extends Model
{
    protected $table = "tb_agenda";
    protected $primaryKey = "id_agenda";
    protected $returnType = "object";
    protected $allowedFields = ['id_user', 'created_at', 'tgl_agenda', 'judul_agenda', 'ket', 'edited_by', 'edited_at'];

    public function allData()
    {
        return $this->db->table('tb_agenda')
            ->select('tb_agenda.*, tb_user.*')
            ->join('tb_user', 'tb_user.id_user = tb_agenda.id_user OR tb_user.id_user = tb_agenda.edited_by', 'left')
            ->orderBy('tb_agenda.created_at', 'ASC')
            ->get()->getResultArray();
    }

    public function detailData($id_agenda)
    {
        return $this->db->table('tb_agenda')
            ->select('tb_agenda.*, tb_user.*')
            ->join('tb_user', 'tb_user.id_user = tb_agenda.id_user OR tb_user.id_user = tb_agenda.edited_by', 'left')
            ->where('tb_agenda.id_misi', $id_agenda)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tb_agenda')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tb_agenda')
            ->where('id_agenda', $data['id_agenda'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tb_agenda')
            ->where('id_agenda', $data['id_agenda'])
            ->delete($data);
    }

    public function reset_data()
    {
        $this->db->query('TRUNCATE TABLE tb_agenda');
    }
}
