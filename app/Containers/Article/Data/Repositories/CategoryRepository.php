<?php

namespace App\Containers\Article\Data\Repositories;

use App\Containers\Article\Models\Category;
use App\Ship\Parents\Repositories\Repository;

class CategoryRepository extends Repository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }
}
