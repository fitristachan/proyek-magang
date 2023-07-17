<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitialDataSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'role_name' => 'admin',
            ],
            [
                'role_name' => 'mahasiswa',
            ],
        ];
        $this->db->table('roles')->insertBatch($roles);

        // Insert admin user
        $adminUser = [
            'nim' => 2107411039,
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'name' => "Fitri Sagita",
            'role_id' => 1, // Assuming 'admin' role has id 1
        ];
        $this->db->table('users')->insert($adminUser);
    }
}
