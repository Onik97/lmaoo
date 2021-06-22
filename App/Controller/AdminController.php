<?php
namespace Lmaoo\Controller;

use Lmaoo\Model\User;
use Lmaoo\Utility\APIResponse;
use Lmaoo\Utility\Validation;

class AdminController extends BaseController
{
    public static function readUser($active)
    {
        if ($active == null) return APIResponse::BadRequest("Active is required");

        echo json_encode(User::read(
            ["userId", "username", "forename", "surname", "level", "isActive", "picture", "github_id", "github_accessToken"], 
            array("isActive" => $active)));
    }

    public static function updateUser($json)
    {
        $data = json_decode($json, true); $validation = Validation::updateUser($data);
        $userId = $data["userId"]; unset($data["userId"]);
        $validation == null ? User::update($userId, $data): APIResponse::BadRequest($validation);
    }
}
