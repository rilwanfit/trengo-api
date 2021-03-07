<?php

/**
 * @apiGroup           Article
 * @apiName            findAllArticles
 * @api                {get} /v1/articles Find All Article
 * @apiDescription     Find all articles
 *
 * @apiVersion         1.0.0
 * @apiSuccessExample {json} Success-Response:
HTTP/1.1 200 OK
{
    "data": [
        {
            "object": "Article",
            "id": 1,
            "title": "Making your emotion totally alarmed",
            "body": "\n some long description ",
            "created_at": "2021-03-06T16:17:41.000000Z",
            "updated_at": "2021-03-06T16:17:41.000000Z",
            "readable_created_at": "2 hours ago",
            "readable_updated_at": "2 hours ago"
        }
    ],
    "meta": {
        "include": [],
        "custom": [],
        "pagination": {
            "total": 1,
            "count": 1,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 1,
            "links": {}
        }
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

$router->get('articles', [
    'as' => 'api_article_find_all_articles',
    'uses' => 'Controller@findAllArticles',
]);
