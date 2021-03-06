<?php
declare(strict_types=1);

namespace App\Containers\Article\Tests\Unit;

use App\Containers\Article\Actions\CreateArticleAction;
use App\Containers\Article\Models\Article;
use App\Containers\Article\Tests\TestCase;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\App;

class CreateArticleTest extends TestCase
{
    /** @test */
    public function it_create_article()
    {
        $data = [
            'title' => 'What is Lorem Ipsum?',
            'body' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
            'categories' => [
                '1',
                '2',
            ]
        ];

        $transporter = new DataTransporter($data);
        $action = App::make(CreateArticleAction::class);
        /** @var Article $article */
        $article = $action->run($transporter);

        $this->assertInstanceOf(Article::class, $article);

        $this->assertEquals($article->title, $data['title']);
        $this->assertSame(2, $article->categories()->count());
    }
}
