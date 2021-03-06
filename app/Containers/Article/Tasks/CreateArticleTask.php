<?php

namespace App\Containers\Article\Tasks;

use App\Containers\Article\Data\Repositories\ArticleRepository;
use App\Containers\Article\Exceptions\CreateArticleFailedException;
use App\Containers\Article\Models\Article;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateArticleTask extends Task
{
    protected $repository;

    public function __construct(ArticleRepository $repository)
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
            $categories = $data['categories'];
            unset($data['categories']);

            /** @var Article $article */
            $article =  $this->repository->create($data);

            $article->categories()->attach($categories);
        } catch (Exception $exception) {
            throw new CreateArticleFailedException();
        }

        return $article;
    }
}
