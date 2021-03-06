<?php

namespace App\Containers\Article\Data\Seeders;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Seeders\Seeder;

class ArticleCategoriesSeeder_1 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 10; ++$i) {
            $category = [
                'title' => 'category' . $i
            ];
            Apiato::call('Article@CreateCategoryTask', [$category]);
        }
    }
}
