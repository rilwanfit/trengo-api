<?php

namespace App\Containers\Article\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Article\Exceptions\ArticleViewNotFoundException;
use App\Containers\Article\Models\Article;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class FindArticleByIdAction extends Action
{
    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  Article
     */
    public function run(DataTransporter $data): Article
    {
        $article = Apiato::call('Article@FindArticleByIdTask', [$data->id]);

        if (!$article) {
            throw new NotFoundException();
        }

        try {
            Apiato::call('Article@FindArticleViewByIpTask', [$article->id, $data->ip]);
        } catch (ArticleViewNotFoundException $exception) {
            $article = Apiato::call('Article@CreateArticleViewTask', [$article, $data->ip]);
        }

        return $article;
    }
}
