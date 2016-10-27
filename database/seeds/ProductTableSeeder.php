<?php

use App\Model\Product;
use App\Model\ProductUnit;

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
        $prod11 = new Product();
        $prod11->store_id = 1;
        $prod11->product_type_id = 1;
        $prod11->name = 'Product Type 1 Product 1';
        $prod11->short_code = 'PRD1-1';
        $prod11->description = 'Product Type 1 Product 1';
        $prod11->image_path = '';
        $prod11->status = 'STATUS.ACTIVE';
        $prod11->remarks = '';

        $prod11->save();

        $produnit11_1 = new ProductUnit();
        $produnit11_1->unit_id = 1;
        $produnit11_1->is_base = true;
        $produnit11_1->conversion_value = 1;

        $prod11->productUnits()->save($produnit11_1);

        $produnit11_2 = new ProductUnit();
        $produnit11_2->unit_id = 3;
        $produnit11_2->is_base = false;
        $produnit11_2->conversion_value = 1000;

        $prod11->productUnits()->save($produnit11_2);

        $prod12 = new Product();
        $prod12->store_id = 1;
        $prod12->product_type_id = 1;
        $prod12->name = 'Product Type 1 Product 2';
        $prod12->short_code = 'PRD1-2';
        $prod12->description = 'Product Type 1 Product 2';
        $prod12->image_path = '';
        $prod12->status = 'STATUS.ACTIVE';
        $prod12->remarks = '';

        $prod12->save();

        $produnit12_1 = new ProductUnit();
        $produnit12_1->unit_id = 1;
        $produnit12_1->is_base = true;
        $produnit12_1->conversion_value = 1;

        $prod12->productUnits()->save($produnit12_1);

        $produnit12_2 = new ProductUnit();
        $produnit12_2->unit_id = 3;
        $produnit12_2->is_base = false;
        $produnit12_2->conversion_value = 1000;

        $prod12->productUnits()->save($produnit12_2);

        $prod21 = new Product();
        $prod21->store_id = 1;
        $prod21->product_type_id = 2;
        $prod21->name = 'Product Type 2 Product 1';
        $prod21->short_code = 'PRD2-1';
        $prod21->description = 'Product Type 2 Product 1';
        $prod21->image_path = '';
        $prod21->status = 'STATUS.ACTIVE';
        $prod21->remarks = '';

        $prod21->save();

        $produnit21_1 = new ProductUnit();
        $produnit21_1->unit_id = 1;
        $produnit21_1->is_base = true;
        $produnit21_1->conversion_value = 1;

        $prod21->productUnits()->save($produnit21_1);

        $produnit21_2 = new ProductUnit();
        $produnit21_2->unit_id = 3;
        $produnit21_2->is_base = false;
        $produnit21_2->conversion_value = 1000;

        $prod21->productUnits()->save($produnit21_2);

        $prod22 = new Product();
        $prod22->store_id = 1;
        $prod22->product_type_id = 2;
        $prod22->name = 'Product Type 2 Product 2';
        $prod22->short_code = 'PRD2-2';
        $prod22->description = 'Product Type 2 Product 2';
        $prod22->image_path = '';
        $prod22->status = 'STATUS.ACTIVE';
        $prod22->remarks = '';

        $prod22->save();

        $produnit22_1 = new ProductUnit();
        $produnit22_1->unit_id = 1;
        $produnit22_1->is_base = true;
        $produnit22_1->conversion_value = 1;

        $prod22->productUnits()->save($produnit22_1);

        $produnit22_2 = new ProductUnit();
        $produnit22_2->unit_id = 3;
        $produnit22_2->is_base = false;
        $produnit22_2->conversion_value = 1000;

        $prod22->productUnits()->save($produnit22_2);

        $prod23 = new Product();
        $prod23->store_id = 1;
        $prod23->product_type_id = 2;
        $prod23->name = 'Product Type 2 Product 2';
        $prod23->short_code = 'PRD2-2';
        $prod23->description = 'Product Type 2 Product 2';
        $prod23->image_path = '';
        $prod23->status = 'STATUS.ACTIVE';
        $prod23->remarks = '';

        $prod23->save();

        $produnit23_1 = new ProductUnit();
        $produnit23_1->unit_id = 1;
        $produnit23_1->is_base = true;
        $produnit23_1->conversion_value = 1;

        $prod23->productUnits()->save($produnit23_1);

        $produnit23_2 = new ProductUnit();
        $produnit23_2->unit_id = 3;
        $produnit23_2->is_base = false;
        $produnit23_2->conversion_value = 1000;

        $prod23->productUnits()->save($produnit23_2);

        $prod31 = new Product();
        $prod31->store_id = 1;
        $prod31->product_type_id = 3;
        $prod31->name = 'Product Type 3 Product 1';
        $prod31->short_code = 'PRD3-1';
        $prod31->description = 'Product Type 3 Product 1';
        $prod31->image_path = '';
        $prod31->status = 'STATUS.ACTIVE';
        $prod31->remarks = '';

        $prod31->save();

        $produnit31_1 = new ProductUnit();
        $produnit31_1->unit_id = 1;
        $produnit31_1->is_base = true;
        $produnit31_1->conversion_value = 1;

        $prod31->productUnits()->save($produnit31_1);

        $produnit31_2 = new ProductUnit();
        $produnit31_2->unit_id = 3;
        $produnit31_2->is_base = false;
        $produnit31_2->conversion_value = 1000;

        $prod31->productUnits()->save($produnit31_2);

        $produnit31_3 = new ProductUnit();
        $produnit31_3->unit_id = 4;
        $produnit31_3->is_base = false;
        $produnit31_3->conversion_value = 50;

        $prod31->productUnits()->save($produnit31_3);
    }
}