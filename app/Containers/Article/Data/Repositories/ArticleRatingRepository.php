<?php

namespace App\Containers\Article\Data\Repositories;

use App\Containers\Article\Models\ArticleRating;
use App\Ship\Parents\Repositories\Repository;
use Illuminate\Container\Container as Application;

class ArticleRatingRepository extends Repository
{
    /**
     * @var ArticleRating
     */
    private $articleRating;

    public function __construct(Application $app, ArticleRating $articleRating)
    {
        parent::__construct($app);

        $this->articleRating = $articleRating;
    }

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        'average_rating' => '=',
        // ...
    ];

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return ArticleRating::class;
    }

    public function getAllRatings()
    {
        return $this->articleRating->all_ratings;
    }
}
