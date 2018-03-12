<?php declare(strict_types=1);

namespace Bling;

class Client
{
    public function __construct()
    {
        $this->client = curl_init();
    }

    public function request($method = 'GET', ?array $data = []) : string
    {
    }
}
