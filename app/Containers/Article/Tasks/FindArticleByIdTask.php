<?php

namespace App\Containers\Article\Tasks;

use App\Containers\Article\Data\Repositories\ArticleRepository;
use App\Containers\Article\Models\Article;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindArticleByIdTask extends Task
{
    protected $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $articleId
     *
     * @return Article
     * @throws NotFoundException
     */
    public function run($articleId): Article
    {
        try {
            $article = $this->repository->find($articleId);
        } catch (Exception $e) {
            var_dump($e->getMessage());die;
            throw new NotFoundException();
        }

        return $article;
    }
}
