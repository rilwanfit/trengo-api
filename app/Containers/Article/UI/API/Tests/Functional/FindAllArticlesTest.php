<?php

namespace App\Containers\Article\UI\API\Tests\Functional;

use App\Containers\Article\Tests\ApiTestCase;

class FindAllArticlesTest extends ApiTestCase
{
    protected $endpoint = 'get@v1/articles';

    protected $access = [
        'roles'       => '',
        'permissions' => '',
    ];

    /** @test */
    public function it_get_all_articles()
    {
        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertInstanceOf(\stdClass::class, $responseContent);
    }

    /** @test */
    public function it_get_all_articles_searched_by_title()
    {
        $response = $this->endpoint($this->endpoint. '?search=title:Title 1')->makeCall();

        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertInstanceOf(\stdClass::class, $responseContent);
        $this->assertStringContainsString('Title 1', $responseContent->data[0]->title);
    }

    /** @test */
    public function it_get_all_articles_searched_by_body()
    {
        $response = $this->endpoint($this->endpoint. '?search=body:Body 1')->makeCall();

        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertInstanceOf(\stdClass::class, $responseContent);
        $this->assertStringContainsString('Body 1', $responseContent->data[0]->body);
    }

    /** @test */
    public function it_filter_articles_by_one_or_more_categories()
    {
        $response = $this->endpoint($this->endpoint. '?search=categories.id:2&include=categories')->makeCall();

        $response->assertStatus(200);

        $responseContent = $this->getResponseContentArray();
        $this->assertNotEmpty($responseContent['data'][0]['categories']['data']);

        $categories = [];
        foreach ($responseContent['data'][0]['categories']['data'] as $category) {
            $categories[] = $category['id'];
        }

        $this->assertTrue(in_array(2, $categories));

        // More category
        $response = $this->endpoint($this->endpoint. '?search=categories.id:2,3&include=categories')->makeCall();

        $response->assertStatus(200);

        $responseContent = $this->getResponseContentArray();
        $this->assertNotEmpty($responseContent['data'][0]['categories']['data']);

        $categories = [];
        foreach ($responseContent['data'][0]['categories']['data'] as $category) {
            $categories[] = $category['id'];
        }

        $this->assertTrue(in_array(2, $categories) || in_array(3, $categories));
    }

    /** @test  */
    public function it_should_be_possible_to_limit_api_results()
    {
        $response = $this->endpoint($this->endpoint. '?limit=4')->makeCall();

        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertInstanceOf(\stdClass::class, $responseContent);
        $this->assertCount(4, $responseContent->data);
    }

    public function it_filter_articles_by_created_date_range()
    {
        $from = date('2021-03-06');
        $to = date('2021-03-07');

        $response = $this->endpoint($this->endpoint. '?search=created_at:'.$from.','.$to)->makeCall();

        $response->assertStatus(200);

        // @todo
    }
}
