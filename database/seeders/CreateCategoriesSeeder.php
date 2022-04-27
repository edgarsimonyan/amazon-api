<?php

namespace Database\Seeders;

use App\Models\Admin\Category;
use Illuminate\Database\Seeder;

class CreateCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'category_name' => 'Electronics',
                'parent_id' => null

            ],
            [
                'category_name' => 'Computers',
                'parent_id' => 1
            ] ,
            [
                'category_name' => 'Phones',
                'parent_id' => 1
            ] ,
            [
                'category_name' => 'Laptops',
                'parent_id' => 1
            ] ,
            [
                'category_name' => 'Garden',
                'parent_id' => null
            ] ,
            [
                'category_name' => 'For Kids',
                'parent_id' => null
            ] ,
            [
                'category_name' => 'Accessories',
                'parent_id' => null
            ],
            [
                'category_name' => 'Women',
                'parent_id' => null
            ],
            [
                'category_name' => 'Men',
                'parent_id' => null
            ] ,
            [
                'category_name' => 'T-shirt',
                'parent_id' => 6
            ] ,
            [
                'category_name' => 'Jeans',
                'parent_id' => 6
            ] ,
            [
                'category_name' => 'Jackets',
                'parent_id' => 6
            ] ,
            [
                'category_name' => 'Accessories',
                'parent_id' => null
            ],
        ];

        Category::insert($data);
    }
}
