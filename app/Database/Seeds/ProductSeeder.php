<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'productName' => 'Mie Instant',
                'category' => 'Food',
                'qty' => 40,
            ],
            [
                'productName' => 'C-1000',
                'category' => 'Drink',
                'qty' => 10,
            ],
            [
                'productName' => 'Chitato',
                'category' => 'snack',
                'qty' => 10
            ]
        ];

        foreach ($data as $item) {
            $this->db->table('products')->insert($item);
        }
    }
}
