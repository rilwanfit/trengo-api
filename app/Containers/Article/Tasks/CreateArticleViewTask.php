<?php

namespace App\Containers\Article\Tasks;

use App\Containers\Article\Data\Repositories\ArticleViewRepository;
use App\Containers\Article\Exceptions\CreateArticleViewFailedException;
use App\Containers\Article\Models\Article;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateArticleViewTask extends Task
{
    protected $repository;

    public function __construct(ArticleViewRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     *
     * @return mixed
     * @throws CreateArticleViewFailedException
     */
    public function run(Article $article, string $ip)
    {
        try {
            $article->views()->create([
                'ip_address' => $ip,
            ]);
        } catch (Exception $exception) {
            throw new CreateArticleViewFailedException();
        }

        return $article;
    }
}
