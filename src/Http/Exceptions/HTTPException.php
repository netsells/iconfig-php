<?php

namespace Netsells\iConfig\Http\Exceptions;

use Netsells\iConfig\Http\Response;

class HTTPException extends \Exception
{
    /**
     * @var Response
     */
    private $response;

    public function __construct($message, Response $response)
    {
        $this->response = $response;

        parent::__construct($message . ' - ' . $response->getRawResponseBody());
    }
}