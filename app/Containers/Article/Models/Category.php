<?php
declare(strict_types=1);

namespace App\Containers\Article\Models;

use Apiato\Core\Traits\HashIdTrait;
use Apiato\Core\Traits\HasResourceKeyTrait;
use App\Ship\Parents\Models\Model;

class Category extends Model
{
    use HashIdTrait;
    use HasResourceKeyTrait;

    protected $fillable = [
        'title',
    ];

    public function articles(){
        return $this->belongsToMany(Article::class)->withTimestamps();
    }
}
