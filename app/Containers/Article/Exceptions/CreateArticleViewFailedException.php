<?php

namespace App\Containers\Article\Exceptions;

use App\Ship\Exceptions\CreateResourceFailedException;
use Symfony\Component\HttpFoundation\Response;

class CreateArticleViewFailedException extends CreateResourceFailedException
{
    public $httpStatusCode = Response::HTTP_CONFLICT;

    public $message = 'Failed to create an article view.';
}
