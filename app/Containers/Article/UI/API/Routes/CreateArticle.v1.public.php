<?php

/**
 * @apiGroup           Article
 * @apiName            createArticle
 *
 * @api                {POST} /v1/articles Endpoint title here..
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  title min 10 chars
 * @apiParam           {String}  body min 10 chars
 * @apiParam           {String[]}  categories
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 202 OK
{
  "message":"An article created successfully.",
  "article_id":1
}
 * @apiErrorExample {json} Error-Response:
 * HTTP/1.1 422 Unprocessable Entity
{
    "error": "The given data was invalid."
}
 */

/** @var Route $router */
$router->post('articles', [
    'as' => 'api_article_create_article',
    'uses'  => 'Controller@createArticle',
]);
