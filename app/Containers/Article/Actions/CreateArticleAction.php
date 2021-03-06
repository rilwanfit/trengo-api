<?php

namespace App\Containers\Article\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class CreateArticleAction.
 */
class CreateArticleAction extends Action
{
    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  mixed
     */
    public function run(DataTransporter $data)
    {
        $sanitizedData = $data->sanitizeInput([
            'title',
            'body',
            'categories',
        ]);

        $account = Apiato::call('Article@CreateArticleTask', [$sanitizedData]);

        return $account;
    }

}
