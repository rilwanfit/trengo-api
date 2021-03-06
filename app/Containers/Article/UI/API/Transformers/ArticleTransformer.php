<?php

namespace App\Containers\Article\UI\API\Transformers;

use App\Containers\Article\Models\Article;
use App\Ship\Parents\Transformers\Transformer;

class ArticleTransformer extends Transformer
{
    /**
     * @var  array
     */
    protected $availableIncludes = [

    ];

    /**
     * @var  array
     */
    protected $defaultIncludes = [

    ];

    /**
     * @param Article $article
     *
     * @return array
     */
    public function transform(Article $article)
    {
        return [
            'object' => 'Article',
            'id' => $article->getHashedKey(),
            'title' => $article->title,
            'body' => $article->body,
            'created_at' => $article->created_at,
            'updated_at' => $article->updated_at,
            'readable_created_at' => $article->created_at === null ? '' : $article->created_at->diffForHumans(),
            'readable_updated_at' => $article->updated_at === null ? '' : $article->updated_at->diffForHumans(),
        ];
    }
}
