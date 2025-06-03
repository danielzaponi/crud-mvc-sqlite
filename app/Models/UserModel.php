<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'email', 'phone'];

    protected $useTimestamps = true; // Ativa os campos `created_at` e `updated_at`

    protected $validationRules = [];

    public $createRules = [
        'name'  => 'required|min_length[3]|max_length[100]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'phone' => 'permit_empty|max_length[20]',
    ];

    public $updateRules = [
        'name'  => 'required|min_length[3]|max_length[100]',
        'email' => 'required|valid_email',
        'phone' => 'permit_empty|max_length[20]',
    ];

    public function getAllowedFields(): array
    {
        return $this->allowedFields;
    }

}