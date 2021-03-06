<?php

/**
 * @apiGroup           Article
 * @apiName            findArticleById
 * @api                {get} /v1/articles/:id Find Article
 * @apiDescription     Find a article by its ID
 *
 * @apiVersion         1.0.0
 * @apiSuccessExample {json} Success-Response:
HTTP/1.1 200 OK
{
    "data": {
        "object": "Article",
        "id": 1,
        "title": "0. What is Lorem Ipsum?",
        "body": "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.",
        "created_at": "2021-03-06T03:16:55.000000Z",
        "updated_at": "2021-03-06T03:16:55.000000Z",
        "readable_created_at": "1 hour ago",
        "readable_updated_at": "1 hour ago"
    },
    "meta": {
        "include": [],
        "custom": []
    }
}
 * @apiErrorExample {json} Error-Response:
 * HTTP/1.1 422 Unprocessable Entity
{
    "message": "The given data was invalid.",
    "errors": {
        "id": [
            "The selected id is invalid."
        ]
    }
}
 */

$router->get('articles/{id}', [
    'as' => 'api_article_find_article',
    'uses' => 'Controller@findArticleById',
]);
