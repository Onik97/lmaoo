<?php
namespace Lmaoo\Model\Github;

use Lmaoo\Utility\APIClient;

class User extends APIClient
{
    public static $USER_URL = "https://api.github.com/user";

    public function __construct($accessToken)
    {
        parent::__construct();
        $response = $this->getRequest(self::$USER_URL, null, array("Authorization" => "token " . $accessToken), false);
        $this->user = $response;
    }
}