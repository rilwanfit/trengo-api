<?php

namespace App\Containers\Article\Models;

use Apiato\Core\Traits\HashIdTrait;
use Apiato\Core\Traits\HasResourceKeyTrait;
use App\Ship\Parents\Models\Model;
use Illuminate\Support\Facades\DB;

class ArticleRating extends Model
{
    use HashIdTrait;
    use HasResourceKeyTrait;

    protected $table = "article_ratings";

    protected $fillable = [
        'rating',
        'ip',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'all_ratings'
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'articlerating';

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function getAllRatingsAttribute()
    {
        return $this->select([
            'article_id',
            DB::raw('SUM(CASE WHEN rating = 1 THEN 1 ELSE 0 END) AS "S1"'),
            DB::raw('SUM(CASE WHEN rating = 2 THEN 1 ELSE 0 END) AS "S2"'),
            DB::raw('SUM(CASE WHEN rating = 3 THEN 1 ELSE 0 END) AS "S3"'),
            DB::raw('SUM(CASE WHEN rating = 4 THEN 1 ELSE 0 END) AS "S4"'),
            DB::raw('SUM(CASE WHEN rating = 5 THEN 1 ELSE 0 END) AS "S5"'),
        ])->groupBy('article_id')->get();
    }
}
