<?php

/**
 * @apiGroup           Article
 * @apiName            rateArticle
 *
 * @api                {POST} /v1/rate-articles Rate An Article
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  article_id
 * @apiParam           {String}  score [1,2,3,4,5]
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 202 OK
{
  "message":"An article rated successfully.",
  "article_id":1
}
 * @apiErrorExample {json} Error-Response:
 * HTTP/1.1 422 Unprocessable Entity
{
    "error": "The given data was invalid."
}
 */

/** @var Route $router */
$router->post('rate-articles', [
    'as' => 'api_article_rate_article',
    'uses'  => 'Controller@rateArticle',
]);
