<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // tabel user
        $data = [
            'username'  => 'admin',
            'name'      => 'Admin',
            'email'     => 'admin@example.com',
            'password'  => '$2y$10$sOKww3LkoNzBtuW5SKxcJOVcY5eN3L1UsTMZpzgWLDd5MfiZ2mmNe',
            'status'    => 'Active',
            'level'     => 'Admin'
        ];
        $this->db->table('users')->insert($data);

        // tabel categories
        $data = [
            'category_name' => 'baju'
        ];
        $this->db->table('categories')->insert($data);

        // tabel products
        $data = [
            'category_id'   => 1,
            'product_name'   => 'hem batik duong',
            'product_price'   => 50_000,
            'product_sku'   => 'h1',
            'product_image'   => 'hem_duong',
            'product_description'   => 'bahan katun pewarnaan sablon',

        ];
        $this->db->table('products')->insert($data);
    }
}
