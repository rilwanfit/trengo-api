<?php

namespace App\Containers\Article\Data\Seeders;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Seeders\Seeder;
use BlogArticleFaker\FakerProvider;
use Faker\Generator;

class ArticleArticlesSeeder_2 extends Seeder
{
    /**
     * @var Generator
     */
    private $faker;

    public function __construct(Generator $faker)
    {
        $faker->addProvider(new FakerProvider($faker));

        $this->faker = $faker;
    }

    public function run()
    {
        for($i = 0; $i < 10; ++$i) {
            $data = [
                'title' => 'Title ' . $i . $this->faker->articleTitle,
                'body' => 'Body ' . $i . $this->faker->articleContent,
                'categories' => [
                    rand(1, 5),
                    rand(6, 10),
                ]
            ];

            Apiato::call('Article@CreateArticleTask', [$data]);
        }
    }
}
