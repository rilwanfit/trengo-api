<?php

namespace App\Containers\Article\UI\API\Tests\Functional;

use App\Containers\Article\Tests\ApiTestCase;

/**
 * @group article
 * @group api
 */
class CreateArticleTest extends ApiTestCase
{
    protected $endpoint = 'post@v1/articles';

    protected $access = [
        'permissions' => '',
        'roles'       => '',
    ];

    /**
     * @test
     */
    public function it_creates_an_article()
    {
        $data = [
            'title' => 'What is Lorem Ipsum?',
            'body' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
            'categories' => [
                '1',
                '2',
            ]
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(202);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($responseContent->message, 'An article created successfully.');
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
            'title' => 'What is Lorem Ipsum?',
            'body' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
            'categories' => []
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
