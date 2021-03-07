<?php

namespace App\Containers\Article\Tasks;

use App\Containers\Article\Data\Repositories\ArticleRatingRepository;
use App\Containers\Article\Exceptions\ArticleAlreadyRatedByThisUserException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Database\Eloquent\Collection;

class FindArticleRateByIpTask extends Task
{
    protected $repository;

    public function __construct(ArticleRatingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $articleId
     * @param $ip
     *
     * @throws ArticleAlreadyRatedByThisUserException
     */
    public function run(string $articleId, string $ip)
    {
        /** @var Collection $articleView */
        $articleRate = $this->repository->findWhere([
            'article_id' => $articleId,
            'ip_address' => $ip
        ]);

        if ($articleRate->count()) {
            throw new ArticleAlreadyRatedByThisUserException();
        }
    }
}
