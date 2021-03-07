<?php

namespace App\Containers\Article\Tasks;

use App\Containers\Article\Data\Repositories\ArticleViewRepository;
use App\Containers\Article\Exceptions\CreateArticleFailedException;
use App\Containers\Article\Exceptions\RateArticleFailedException;
use App\Containers\Article\Models\Article;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateMultipleRatesPerArticleTask extends Task
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
     * @throws CreateArticleFailedException
     */
    public function run(array $articles): void
    {
        try {
            foreach ($articles as $articleId => $rates) {
                /** @var Article $article */
                $article = Article::find($articleId);

                if (!$article) {
                    continue;
                }
                if (!is_array($rates)) {
                    continue;
                }

                try {
                    $article->ratings()->createMany($rates);
                } catch (RateArticleFailedException $exception) {
                    continue;
                }
            }
        } catch (Exception $exception) {
            throw new RateArticleFailedException();
        }
    }
}
