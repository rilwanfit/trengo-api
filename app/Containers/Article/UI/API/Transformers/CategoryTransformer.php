<?php

namespace App\Containers\Article\UI\API\Transformers;

use App\Containers\Article\Models\Article;
use App\Containers\Article\Models\Category;
use App\Ship\Parents\Transformers\Transformer;

class CategoryTransformer extends Transformer
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
     * @param Category $category
     *
     * @return array
     */
    public function transform(Category $category)
    {
        return [
            'object' => 'Category',
            'id' => $category->getHashedKey(),
            'title' => $category->title,
        ];
    }
}
