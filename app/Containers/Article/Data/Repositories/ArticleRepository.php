<?php

namespace App\Containers\Article\Data\Repositories;

use App\Containers\Article\Models\Article;
use App\Ship\Parents\Repositories\Repository;

class ArticleRepository extends Repository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Article::class;
    }
}
