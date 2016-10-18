<?php

namespace Netsells\iConfig\Http;

class Response
{
    protected $rawResponseBody;
    protected $responseCode;
    protected $responseBody;

    public function __construct($responseCode, $responseBody)
    {
        $this->responseCode = $responseCode;
        $this->rawResponseBody = $responseBody;
        $this->responseBody = json_decode($this->rawResponseBody, false);
    }

    /**
     * @return mixed
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }

    /**
     * @return mixed
     */
    public function getResponseBody()
    {
        return $this->responseBody;
    }

    /**
     * @return mixed
     */
    public function getRawResponseBody()
    {
        return $this->rawResponseBody;
    }
}