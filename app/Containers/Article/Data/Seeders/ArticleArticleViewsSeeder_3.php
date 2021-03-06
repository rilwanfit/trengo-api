<?php

namespace App\Containers\Article\Data\Seeders;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Seeders\Seeder;
use Faker\Generator;

class ArticleArticleViewsSeeder_3 extends Seeder
{
    /**
     * @var Generator
     */
    private $faker;

    public function __construct(Generator $faker)
    {
        $this->faker = $faker;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $views = [];
        for($i = 0; $i < 100; ++$i) {
            $views[rand(1,1000)][] = [
                'ip_address' => $this->faker->ipv4
            ];
        }

        Apiato::call('Article@CreateMultipleViewsPerArticleTask', [$views]);
    }
}
