<?php
declare(strict_types=1);

namespace App\Containers\Article\Tests\Unit;

use App\Containers\Article\Data\Repositories\ArticleRatingRepository;
use App\Containers\Article\Tasks\CalculateArticleRatingTask;
use App\Containers\Article\Tasks\CalculateArticleWeightedRatingTask;
use App\Containers\Article\Tests\TestCase;

class CalculateArticleWeightedRatingTest extends TestCase
{
    /**
     * @test
     * @dataProvider ratings()
     */
    public function it_calculate_article_ratings(array $ratings)
    {
        $repository = $this->prophesize(ArticleRatingRepository::class);
        $repository->getAllRatings()->shouldbeCalled()->WillReturn($ratings['input']);

        $result = (new CalculateArticleWeightedRatingTask($repository->reveal()))->run();

        $this->assertSame($ratings['expected'], $result);
    }

    public function ratings()
    {
        yield [
            [
                'input' => [
                    [
                        "article_id" => 1,
                        "S5" => 853,
                        "S4" => 72,
                        "S3" => 1,
                        "S2" => 4,
                        "S1" => 10
                    ],
                    [
                        "article_id" => 2,
                        "S5" => 1,
                        "S4" => 0,
                        "S3" => 0,
                        "S2" => 0,
                        "S1" => 0
                    ],
                    [
                        "article_id" => 3,
                        "S5" => 0,
                        "S4" => 10,
                        "S3" => 0,
                        "S2" => 0,
                        "S1" => 10
                    ]
                ],
                'expected' => [
                    [
                        'article_id' => 1,
                        'weighted_average' => 4.8
                    ],
                    [
                        'article_id' => 2,
                        'weighted_average' => 0.5
                    ],
                    [
                        'article_id' => 3,
                        'weighted_average' => 1.7
                    ],
                ]
            ],
        ];
    }
}
