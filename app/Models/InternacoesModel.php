<?php

namespace App\Models;

use CodeIgniter\Model;

class InternacoesModel extends Model
{
    protected $table      = 'internacoes';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'data_geracao',
        'regional',
        'uf',
        'unidade',
        'tipo',
        'clinica',
        'convenio',
        'paciente',
        'data_nascimento',
        'cpf',
        'sexo',
        'numero_atendimento',
        'apartamento',
        'leito',
        'diaria',
        'data_internacao',
    ];

    protected $useTimestamps = true; // Habilita created_at, updated_at
    protected $useSoftDeletes = true; // Se você estiver usando deleted_at

    protected $validationRules = [];

    public $createRules = [
        'data_geracao'     => 'required|valid_date',
        'regional'         => 'required|max_length[20]',
        'uf'               => 'required|exact_length[2]',
        'unidade'          => 'required|max_length[100]',
        'tipo'             => 'required|max_length[10]',
        'clinica'          => 'required|max_length[100]',
        'convenio'         => 'required|max_length[100]',
        'paciente'         => 'required|max_length[150]',
        'data_nascimento'  => 'permit_empty|valid_date',
        'cpf'              => 'permit_empty|exact_length[14]|valid_cpf',
        'sexo' => 'permit_empty|in_list[M,F,O]',
        'numero_atendimento' => 'permit_empty|max_length[50]',
        'apartamento'      => 'permit_empty|max_length[50]',
        'leito'            => 'permit_empty|max_length[50]',
        'diaria'           => 'required|integer',
        'data_internacao'  => 'required|valid_date',
    ];

    public $updateRules = [
        'data_geracao'     => 'required|valid_date',
        'regional'         => 'required|max_length[20]',
        'uf'               => 'required|exact_length[2]',
        'unidade'          => 'required|max_length[100]',
        'tipo'             => 'required|max_length[10]',
        'clinica'          => 'required|max_length[100]',
        'convenio'         => 'required|max_length[100]',
        'paciente'         => 'required|max_length[150]',
        'data_nascimento'  => 'permit_empty|valid_date',
        'cpf'              => 'permit_empty|exact_length[14]|valid_cpf',
        'sexo'             => 'permit_empty|in_list[M,F,O]',
        'numero_atendimento' => 'permit_empty|max_length[50]',
        'apartamento'      => 'permit_empty|max_length[50]',
        'leito'            => 'permit_empty|max_length[50]',
        'diaria'           => 'required|integer',
        'data_internacao'  => 'required|valid_date',
    ];

    public function getAllowedFields(): array
    {
        return $this->allowedFields;
    }
}