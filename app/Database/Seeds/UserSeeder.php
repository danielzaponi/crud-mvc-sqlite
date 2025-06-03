<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\CLI\CLI;
use Faker\Factory;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('pt_BR');
        $total = 1000;
        for ($i = 0; $i < $total; $i++) {
            $data = [
                'name'  => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
            ];

            $this->db->table('users')->insert($data);
            CLI::showProgress($i + 1, $total, 'Inserindo usuários: ' . ($i + 1) . '/' . $total, 'green');
        }

        echo "✅ Inserção concluída!\n";
    }
}