<?php

use App\Product;

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prod = [
            [
                'store_id' => 1,
                'product_type_id' => 1,
                'name' => 'Product Type 1 Product 1',
                'short_code' => 'PRD1-1',
                'description' => 'Product Type 1 Product 1',
                'image_path' => '',
                'status' => 'STATUS.Active',
                'remarks' => ''
            ],
            [
                'store_id' => 1,
                'product_type_id' => 1,
                'name' => 'Product Type 1 Product 2',
                'short_code' => 'PRD1-2',
                'description' => 'Product Type 1 Product 2',
                'image_path' => '',
                'status' => 'STATUS.Active',
                'remarks' => ''
            ],
            [
                'store_id' => 1,
                'product_type_id' => 2,
                'name' => 'Product Type 2 Product 1',
                'short_code' => 'PRD2-1',
                'description' => 'Product Type 2 Product 1',
                'image_path' => '',
                'status' => 'STATUS.Active',
                'remarks' => ''
            ],
            [
                'store_id' => 1,
                'product_type_id' => 2,
                'name' => 'Product Type 2 Product 2',
                'short_code' => 'PRD2-2',
                'description' => 'Product Type 2 Product 2',
                'image_path' => '',
                'status' => 'STATUS.Active',
                'remarks' => ''
            ],
            [
                'store_id' => 1,
                'product_type_id' => 2,
                'name' => 'Product Type 2 Product 3',
                'short_code' => 'PRD2-3',
                'description' => 'Product Type 2 Product 3',
                'image_path' => '',
                'status' => 'STATUS.Active',
                'remarks' => ''
            ],
            [
                'store_id' => 1,
                'product_type_id' => 3,
                'name' => 'Product Type 3 Product 1',
                'short_code' => 'PRD3-1',
                'description' => 'Product Type 3 Product 1',
                'image_path' => '',
                'status' => 'STATUS.Active',
                'remarks' => ''
            ],
        ];

        foreach ($prod as $key => $value) {
            Product::create($value);
        }
    }
}