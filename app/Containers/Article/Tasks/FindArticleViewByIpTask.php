<?php

namespace App\Containers\Article\Tasks;

use App\Containers\Article\Data\Repositories\ArticleViewRepository;
use App\Containers\Article\Exceptions\ArticleViewNotFoundException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Database\Eloquent\Collection;

class FindArticleViewByIpTask extends Task
{
    protected $repository;

    public function __construct(ArticleViewRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $articleId
     * @param $ip
     *
     * @return Collection
     * @throws ArticleViewNotFoundException
     */
    public function run(string $articleId, string $ip): Collection
    {
        /** @var Collection $articleView */
        $articleView = $this->repository->findWhere([
            'article_id' => $articleId,
            'ip_address' => $ip
        ]);

        if ($articleView->count() === 0) {
            throw new ArticleViewNotFoundException();
        }

        return $articleView;
    }
}
