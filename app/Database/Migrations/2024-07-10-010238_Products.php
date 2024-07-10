<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
{
    public function up()
    {

        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => '10',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'productName' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'qty' => [
                'type' => 'INT',
                'constraint' => 10
            ],
            'status'      => [
                'type'           => 'TINYINT',
                'default' => 1
            ]
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable('products', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
