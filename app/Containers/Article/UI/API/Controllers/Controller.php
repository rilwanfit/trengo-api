<?php

namespace App\Containers\Article\UI\API\Controllers;

use App\Containers\Article\UI\API\Requests\CreateArticleRequest;
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
}
