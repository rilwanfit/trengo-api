<?php

namespace App\Containers\Article\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class FindAllArticlesAction extends Action
{
    public function run(DataTransporter $data)
    {
        return Apiato::call('Article@FindAllArticlesTask', [$data], ['addRequestCriteria']);
    }
}
