<?php
namespace Lmaoo\Controller;

use Lmaoo\Core\Constant;
use Lmaoo\Model\User;
use Lmaoo\Utility\APIResponse;
use Lmaoo\Utility\Validation;

class AdminController extends BaseController
{
    public static function readUserwithActive($active)
    {
        if ($active == null) return APIResponse::BadRequest("Active is required");
        $columns = Constant::$USER_COLUMNS; unset($columns[2]); // Removes password on Column
        echo json_encode(User::read($columns, array("isActive" => $active)));
    }

    public static function readUserWithId($userId)
    {
        if ($userId == null) return APIResponse::BadRequest("UserId is required");
        $columns = Constant::$USER_COLUMNS; unset($columns[2]); // Removes password on Column
        echo json_encode(User::read($columns, array("userId" => $userId)));
    }

    public static function updateUser($json)
    {
        $data = json_decode($json, true); $validation = Validation::updateUser($data);
        if (@$data["userId"] != null) $userId = $data["userId"]; unset($data["userId"]);
        $validation == null ? User::update($userId, $data): APIResponse::BadRequest($validation);
    }
}
