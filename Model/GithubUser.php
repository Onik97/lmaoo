<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/../Core/Autoloader.php");

class GithubUser extends Database
{
    public function __construct($apiResponse)
    {
        $this->userId = $apiResponse["id"];
        $this->name = $apiResponse["name"];
        $this->username = $apiResponse["login"];
        $this->avatar = $apiResponse["avatar_url"];
    }
}