<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInitialTables extends Migration
{
    public function up()
    {
        // Create Roles table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'role_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('roles');

        // Create Users table
        $this->forge->addField([
            'user_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'role_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('user_id');
        $this->forge->addForeignKey('role_id', 'roles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('users');

        // Create Calculations table
        $this->forge->addField([
            'calculation_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('calculation_id');
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('calculations');

        // Create Internships table
        $this->forge->addField([
            'internship_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'salary' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'distance' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'work_hour' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'transport_fee' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addPrimaryKey('internship_id');
        $this->forge->createTable('internships');

        // Create AlternativeBind table
        $this->forge->addField([
            'calculation_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'internship_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'score' => [
                'type' => 'FLOAT',
                'default' => null,
            ],
        ]);
        $this->forge->addKey(['calculation_id', 'internship_id']);
        $this->forge->addForeignKey('calculation_id', 'calculations', 'calculation_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('internship_id', 'internships', 'internship_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('alternative_bind');
    }

    public function down()
    {
        $this->forge->dropTable('alternative_bind');
        $this->forge->dropTable('internships');
        $this->forge->dropTable('calculations');
        $this->forge->dropTable('users');
        $this->forge->dropTable('roles');
    }
}
