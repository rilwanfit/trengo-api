<?php
declare(strict_types=1);

namespace App\Containers\Article\Tests\Unit;

use App\Containers\Article\Actions\FindArticleByIdAction;
use App\Containers\Article\Models\Article;
use App\Containers\Article\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\App;

class FindArticleTest extends TestCase
{
    /** @test */
    public function it_find_article_by_id()
    {
        $data = [
            'id' => '1',
            'ip' => '127.0.0.1',
        ];

        $transporter = new DataTransporter($data);
        $action = App::make(FindArticleByIdAction::class);
        /** @var Article $article */
        $article = $action->run($transporter);

        $this->assertInstanceOf(Article::class, $article);
    }
}
