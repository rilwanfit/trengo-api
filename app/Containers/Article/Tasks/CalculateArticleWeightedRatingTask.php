<?php
declare(strict_types=1);

namespace App\Containers\Article\Tasks;

use App\Containers\Article\Data\Repositories\ArticleRatingRepository;

class CalculateArticleWeightedRatingTask
{
    /**
     * @var ArticleRatingRepository
     */
    private $repository;

    public function __construct(ArticleRatingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        $ratings = $this->repository->getAllRatings();
        $results = [];
        foreach($ratings as $rating)
        {
            $totalVotes = $rating["S1"] + $rating["S2"] + $rating["S3"] + $rating["S4"] + $rating["S5"];

            if (!$totalVotes) {
                return [];
            }

            $totalWeight = 1 * $rating["S1"];
            $totalWeight += 2 * $rating["S2"];
            $totalWeight += 3 * $rating["S3"];
            $totalWeight += 4 * $rating["S4"];
            $totalWeight += 5 * $rating["S5"];

            $minimumRequired = 10;
            $averate = $totalWeight / $totalVotes;

            $results[] = [
                'article_id' => $rating['article_id'],
                'weighted_average' => round($averate * $totalVotes / ($totalVotes + $minimumRequired), 1)
            ];
        }

        return $results;
    }
}
