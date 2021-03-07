<?php

namespace App\Containers\Article\Tasks;

use App\Containers\Article\Data\Repositories\ArticleRatingRepository;
use App\Containers\Article\Exceptions\CreateArticleFailedException;
use App\Containers\Article\Exceptions\RateArticleFailedException;
use App\Containers\Article\Models\Article;
use App\Containers\Article\Models\ArticleRating;
use App\Ship\Parents\Tasks\Task;
use Exception;

class RateArticleTask extends Task
{
    protected $repository;

    public function __construct(ArticleRatingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     *
     * @return mixed
     * @throws CreateArticleFailedException
     */
    public function run(array $data)
    {
        try {
            /** @var ArticleRating $article */
            $articleRating =  $this->repository->create($data);
        } catch (Exception $exception) {
            var_dump($exception->getMessage());die;
            throw new RateArticleFailedException();
        }

        return $articleRating;
    }
}
