<?php declare(strict_types=1);

namespace Bling;

class Client
{
    const METHOD_GET = 'GET';

    const METHOD_POST = 'POST';

    const METHOD_DELETE = 'DELETE';

    private $baseUrl = '';

    private $handle;

    public function __construct($baseUrl)
    {
        $this->handle = curl_init();
        $this->baseUrl = $baseUrl;
    }

    public function request(string $path, string $method = self::METHOD_GET, ?array $data = []) : string
    {
        switch ($method) {
            case self::METHOD_GET:
                $path .= http_build_query($data);
                break;
            case self::METHOD_POST:
                curl_setopt($this->handle, CURLOPT_POST, count($data));
                curl_setopt($this->handle, CURLOPT_POSTFIELDS, $data);
                break;
            case self::METHOD_DELETE:
                curl_setopt($this->handle, CURLOPT_CUSTOMREQUEST, self::METHOD_DELETE);
                curl_setopt($this->handle, CURLOPT_POSTFIELDS, $data);
                break;
        }

        curl_setopt($this->handle, CURLOPT_URL, sprintf('%s/%s', $this->baseUrl, $path));
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($this->handle);

        curl_close($this->handle);

        return $response;
    }
}
