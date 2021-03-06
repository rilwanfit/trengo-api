<?php

namespace App\Containers\Article\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class ArticleViewRepository
 */
class ArticleViewRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
