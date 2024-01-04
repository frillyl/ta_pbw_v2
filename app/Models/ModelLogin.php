<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLogin extends Model
{
    public function login_user($email)
    {
        return $this->db->table('tb_user')->where([
            'email' => $email
        ])->get()->getRowArray();
    }
}
