<?php

namespace App\Containers\Article\UI\API\Controllers;

use App\Containers\Article\Exceptions\ArticleAlreadyRatedByThisUserException;
use App\Containers\Article\UI\API\Requests\CreateArticleRequest;
use App\Containers\Article\UI\API\Requests\FindAllArticlesRequest;
use App\Containers\Article\UI\API\Requests\FindArticleByIdRequest;
use App\Containers\Article\UI\API\Requests\RateArticleRequest;
use App\Containers\Article\UI\API\Transformers\ArticleTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

/**
 * Class Controller
 *
 * @package App\Containers\Article\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param CreateArticleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createArticle(CreateArticleRequest $request)
    {
        $article = Apiato::call('Article@CreateArticleAction', [new DataTransporter($request)]);

        return $this->created([
          'message'           => 'An article created successfully.',
          'article_id' => $article->id,
        ]);
    }

    /**
     * @param FindArticleByIdRequest $request
     *
     * @return  mixed
     */
    public function findArticleById(FindArticleByIdRequest $request)
    {
        $dataTransporter = new DataTransporter($request);
        $dataTransporter->ip = $request->ip();

        $user = Apiato::call('Article@FindArticleByIdAction', [$dataTransporter]);

        return $this->transform($user, ArticleTransformer::class);
    }

    /**
     * @param FindAllArticlesRequest $request
     *
     * @return  mixed
     */
    public function findAllArticles(FindAllArticlesRequest $request)
    {
        $dataTransporter = new DataTransporter($request);

        $user = Apiato::call('Article@FindAllArticlesAction', [$dataTransporter]);

        return $this->transform($user, ArticleTransformer::class);
    }

    /**
     * @param RateArticleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function rateArticle(RateArticleRequest $request)
    {
        $dataTransporter = new DataTransporter($request);
        $dataTransporter->ip = $request->ip();

        try {
            $article = Apiato::call('Article@RateArticleAction', [$dataTransporter]);
        } catch (ArticleAlreadyRatedByThisUserException $exception) {
            // log message
            return $this->accepted([
                'message'           => 'You already rated this article.',
                'article_id' => $dataTransporter->article_id,
            ], 400);
        }

        return $this->accepted([
            'message'           => 'An article rated successfully.',
            'article_id' => $article['article_id'],
        ]);
    }
}
