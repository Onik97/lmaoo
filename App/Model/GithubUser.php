<?php
namespace App\Model;

use App\Core\Database;

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