<?php

namespace App\Containers\Article\Models;

use Apiato\Core\Traits\HashIdTrait;
use Apiato\Core\Traits\HasResourceKeyTrait;
use App\Ship\Parents\Models\Model;

class ArticleView extends Model
{
    use HashIdTrait;
    use HasResourceKeyTrait;

    protected $fillable = [
        'ip_address',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'articleviews';

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
