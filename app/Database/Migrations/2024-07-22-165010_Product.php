<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Product extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id_product' => [
                'type' => 'VARCHAR',
                'constraint' => '36', // UUID length
                'null' => false,
            ],
            'nama_product' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'jenis_product' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'deskripsi_product' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'panjang' => [
                'type' => 'INTEGER',
                'null' => false,
            ],
            'lebar' => [
                'type' => 'INTEGER',
                'null' => false,
            ],
            'harga' => [
                'type' => 'INTEGER',
                'null' => false,
            ],
            'min_pesan' => [
                'type' => 'INTEGER',
                'null' => false,
            ],
            'gambar' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_product', true); // Primary key
        $this->forge->createTable('products');
    }

    public function down()
    {
        //
        $this->forge->dropTable('products');
    }
}
