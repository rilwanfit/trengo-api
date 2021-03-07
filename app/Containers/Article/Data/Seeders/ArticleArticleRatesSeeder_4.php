<?php

namespace App\Containers\Article\Data\Seeders;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Seeders\Seeder;
use Faker\Generator;

class ArticleArticleRatesSeeder_4 extends Seeder
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
        $rates = [];
        for($i = 0; $i < 1000; ++$i) {
            $articleId = rand(1,100);
            $rates[$articleId][] = [
                'article_id' => $articleId,
                'ip_address' => $this->faker->ipv4,
                'rating' => rand(1,5)
            ];
        }

        Apiato::call('Article@CreateMultipleRatesPerArticleTask', [$rates]);
    }
}
