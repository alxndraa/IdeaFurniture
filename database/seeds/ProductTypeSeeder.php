<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_types')->insert([
            ['id'=>1, 'name'=>'Bathroom Furniture'],
            ['id'=>2, 'name'=>'Bed Frames'],
            ['id'=>3, 'name'=>'Bookshelves'],
            ['id'=>4, 'name'=>'Dinnerware'],
            ['id'=>5, 'name'=>'Home Desks'],
            ['id'=>6, 'name'=>'Kitchen Furnitures'],
            ['id'=>7, 'name'=>'Office Chairs'],
            ['id'=>8, 'name'=>'Sofas'],
            ['id'=>9, 'name'=>'Wardrobes'],
        ]);
    }
}