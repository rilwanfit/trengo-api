<?php

declare(strict_types=1);

namespace App\Containers\Article\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use Apiato\Core\Traits\HasRequestCriteriaTrait;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class RateArticleAction extends Action
{
    use HasRequestCriteriaTrait;

    public function run(DataTransporter $data)
    {
        $sanitizedData = $data->sanitizeInput([
            'article_id',
            'score',
        ]);

        Apiato::call('Article@FindArticleRateByIpTask', [$sanitizedData['article_id'], $data->ip]);

        $data = [
            'article_id' => (int) $sanitizedData['article_id'],
            'rating' => $sanitizedData['score'],
            'ip_address' => $data->ip,
        ];

        Apiato::call('Article@RateArticleTask', [$data]);

        return $sanitizedData;
    }
}
