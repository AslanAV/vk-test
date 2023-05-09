<?php

namespace App\Application\Requests;


Class Request
{
    protected array $body;
    public function __construct()
    {
        $bodyRequest = file_get_contents('php://input');
        $this->body = json_decode($bodyRequest, true, 512, JSON_THROW_ON_ERROR);
    }

    public function getBody(): array
    {
        return $this->body;
    }
}
