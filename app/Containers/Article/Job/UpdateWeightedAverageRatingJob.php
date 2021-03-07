<?php
declare(strict_types=1);

namespace App\Containers\Article\Job;


use App\Ship\Parents\Jobs\Job;
use Illuminate\Support\Facades\DB;

class UpdateWeightedAverageRatingJob  extends Job
{
    private $recipients;

    public function __construct(array $recipients)
    {
        $this->recipients = $recipients;
    }

    public function handle()
    {
        foreach ($this->recipients as $recipient) {
            DB::table('articles')
                ->where('id', $recipient['article_id'])
                ->update(['average_rating' => $recipient['weighted_average']]);
        }
    }
}
