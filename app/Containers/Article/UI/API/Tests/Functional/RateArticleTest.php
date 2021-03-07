<?php

namespace App\Containers\Article\UI\API\Tests\Functional;

use App\Containers\Article\Models\ArticleRating;
use App\Containers\Article\Tests\ApiTestCase;

/**
 * @group article
 * @group api
 */
class RateArticleTest extends ApiTestCase
{
    protected $endpoint = 'post@v1/rate-articles';

    protected $access = [
        'permissions' => '',
        'roles'       => '',
    ];

    /**
     * @test
     */
    public function it_rate_an_article()
    {
        $data = [
            'article_id' => '9',
            'score' => '5',
            'ip' => '127.0.0.1',
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(202);
    }

    /**
     * @test
     */
    public function it_should_validate_user_input()
    {
        $data = [];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(422);

        $data = [
            'article_id' => '1',
            'score' => '9999',
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(422);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($responseContent->message, 'The given data was invalid.');
    }
}
