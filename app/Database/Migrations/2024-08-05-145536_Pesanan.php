<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pesanan extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id_pesan' => [
                'type' => 'VARCHAR',
                'constraint' => '36', // UUID length
                'null' => false,
            ],
            'user_id' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'product_id' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'status_id' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'panjang_pesan' => [
                'type' => 'INTEGER',
                'null' => false,
            ],
            'lebar_pesan' => [
                'type' => 'INTEGER',
                'null' => false,
            ],
            'jml_pesan' => [
                'type' => 'INTEGER',
                'null' => false,
            ],
            'total_harga' => [
                'type' => 'INTEGER',
                'null' => false,
            ],
            'file' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'keterangan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
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
        $this->forge->addKey('id_pesan', true); // Primary key
        $this->forge->createTable('pesanans');
    }

    public function down()
    {
        //
        $this->forge->dropTable('pesanans');
    }
}
