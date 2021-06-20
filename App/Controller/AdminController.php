<?php
namespace Lmaoo\Controller;

use Lmaoo\Model\User;
use Lmaoo\Utility\APIResponse;

class AdminController extends BaseController
{
    public static function readUser($active)
    {
        if ($active == null) return APIResponse::BadRequest("Active is required");

        echo json_encode(User::withActive($active));
    }

    public function updateUser()
    {

    }

    // Actually deactivating a user
    public static function deleteUser()
    {

    }
}
