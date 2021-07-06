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
            ['id'=>1, 'name'=>'Bedroom', 'image'=>'assets/productTypes/01.jpg'],
            ['id'=>2, 'name'=>'Bathroom', 'image'=>'assets/productTypes/02.jpg'],
            ['id'=>3, 'name'=>'Living Room', 'image'=>'assets/productTypes/03.jpg'],
            ['id'=>4, 'name'=>'Kitchen', 'image'=>'assets/productTypes/04.jpg'],
            ['id'=>5, 'name'=>'Dining', 'image'=>'assets/productTypes/05.jpg'],
            ['id'=>6, 'name'=>'Office', 'image'=>'assets/productTypes/06.jpg']
        ]);
    }
}