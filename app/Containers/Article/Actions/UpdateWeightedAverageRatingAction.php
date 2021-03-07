<?php

declare(strict_types=1);

namespace App\Containers\Article\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use Apiato\Core\Traits\HasRequestCriteriaTrait;
use App\Containers\Article\Job\UpdateWeightedAverageRatingJob;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Contracts\Pagination\Paginator;

class UpdateWeightedAverageRatingAction extends Action
{
    use HasRequestCriteriaTrait;

    public function run(DataTransporter $data)
    {
        /** @var Paginator $articles */
        $weightedAverage =  Apiato::call('Article@CalculateArticleWeightedRatingTask', [$data]);

        dispatch(new UpdateWeightedAverageRatingJob($weightedAverage));

        return $weightedAverage;
    }
}
