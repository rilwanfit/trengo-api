<?php

namespace App\Containers\Article\Models;

use Apiato\Core\Traits\HashIdTrait;
use Apiato\Core\Traits\HasResourceKeyTrait;
use App\Ship\Parents\Models\Model;

class Article extends Model
{
    use HashIdTrait;
    use HasResourceKeyTrait;

    protected $fillable = [
        'title',
        'body',
    ];

    public function categories(){
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function views()
    {
        return $this->hasMany(ArticleView::class);
    }
}
