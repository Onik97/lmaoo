<?php
namespace Lmaoo\Utility;

use Lmaoo\Core\Config;
use GuzzleHttp\Client;


class APIClient extends Config
{
    public static function getRequest(string $url, ?array $params, ?array $headers, bool $assoc = true)
    {
        $client = new Client();
        $response = $client->request("GET", $url, ['form_params' => $params, 'headers' => $headers]);
        return json_decode($response->getBody(), $assoc);
    }

    public static function postRequest(string $url, ?array $params, ?object $body, ?array $headers, bool $assoc = true)
    {
        $client = new Client();
        $response = $client->request("POST", $url, ["form_params" => $params, "body" => json_encode($body), "headers" => $headers]);
        return json_decode($response->getBody(), $assoc);
    }
}