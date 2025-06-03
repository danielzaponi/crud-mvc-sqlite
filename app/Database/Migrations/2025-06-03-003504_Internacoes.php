<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Internacoes extends Migration
{
    public function up()
{
    $this->forge->addField([
        'id' => [
            'type'           => 'INT',
            'auto_increment' => true,
            'unsigned'       => true
        ],
        'data_geracao' => ['type' => 'DATE', 'null' => true],
        'regional' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        'uf' => ['type' => 'VARCHAR', 'constraint' => 2, 'null' => true],
        'unidade' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        'tipo' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        'clinica' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        'convenio' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        'paciente' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        'cpf' => ['type' => 'VARCHAR', 'constraint' => 14, 'null' => true],
        'sexo' => ['type' => 'CHAR', 'constraint' => 1, 'null' => true],
        'numero_atendimento' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
        'data_nascimento' => ['type' => 'DATE', 'null' => true],
        'apartamento' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
        'leito' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
        'diaria' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true],
        'data_internacao' => ['type' => 'DATE', 'null' => true],
        'created_at' => ['type' => 'DATETIME', 'null' => true],
        'updated_at' => ['type' => 'DATETIME', 'null' => true],
    ]);

    $this->forge->addKey('id', true);
    $this->forge->createTable('internacoes');
}

    public function down()
    {
        $this->forge->dropTable('internacoes');
    }
}