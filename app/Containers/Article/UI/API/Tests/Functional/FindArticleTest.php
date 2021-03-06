<?php

namespace App\Containers\Article\UI\API\Tests\Functional;

use App\Containers\Article\Tests\ApiTestCase;

class FindArticleTest extends ApiTestCase
{
    protected $endpoint = 'get@v1/articles/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => '',
    ];

    /** @test */
    public function it_finds_an_article_by_id()
    {
        // send the HTTP request
        $response = $this->injectId('1')->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();
        $this->assertSame('Article', $responseContent->data->object);
    }

    /**
     * @test
     */
    public function it_should_validate_article_id_before_displaying_details()
    {
        // send the HTTP request
        $response = $this->injectId('abc')->makeCall();

        // assert response status is correct
        $response->assertStatus(422);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($responseContent->message, 'The given data was invalid.');
    }

    /** @test */
    public function it_should_show_error_message_when_requested_article_not_found()
    {
        // send the HTTP request
        $response = $this->injectId(999999999999)->makeCall();

        // assert response status is correct
        $response->assertStatus(422);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($responseContent->message, 'The given data was invalid.');
    }
}
