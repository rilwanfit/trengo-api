<?php

namespace App\Containers\Article\UI\API\Controllers;

use App\Containers\Article\UI\API\Requests\CreateArticleRequest;
use App\Containers\Article\UI\API\Requests\FindAllArticlesRequest;
use App\Containers\Article\UI\API\Requests\FindArticleByIdRequest;
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

        return $this->accepted([
          'message'           => 'An article created successfully.',
          'stripe_account_id' => $article->id,
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
}
