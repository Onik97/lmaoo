<?php
namespace Lmaoo\Model\Github;

use Lmaoo\Utility\APIClient;

class OAuth extends APIClient
{
    public static $ACCESS_TOKEN_URL = "https://github.com/login/oauth/access_token";

    // Github uses code to verify user
    public function getAccessToken($code)
    {
        $params = array(
            "client_id" => $this->github_clientId,
            "client_secret" => $this->github_secret,
            "code" => $code
        );
        $response = $this->getRequest(self::$ACCESS_TOKEN_URL, $params, array("Accept" => "application/json"));
        return $response["access_token"];
    }
}