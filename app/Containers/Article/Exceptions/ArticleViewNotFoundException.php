<?php

namespace App\Containers\Article\Exceptions;

use App\Ship\Exceptions\NotFoundException;
use Symfony\Component\HttpFoundation\Response;

class ArticleViewNotFoundException extends NotFoundException
{
    public $httpStatusCode = Response::HTTP_CONFLICT;

    public $message = 'The requested Resource was not found.';
}
