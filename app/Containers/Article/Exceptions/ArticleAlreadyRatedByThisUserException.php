<?php

namespace App\Containers\Article\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class ArticleAlreadyRatedByThisUserException extends Exception
{
    public $httpStatusCode = Response::HTTP_CONFLICT;

    public $message = 'This article is already rated by this user.';
}
