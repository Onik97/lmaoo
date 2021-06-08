<?php
namespace Lmaoo\Controller;

use Lmaoo\Model\Github\OAuth;
use Lmaoo\Model\Github;
use Lmaoo\Model\User;
use Lmaoo\Utility\APIResponse;
use Lmaoo\Utility\Library;

class GithubController extends BaseController
{  
    public static $AUTHORIZE_URL = "https://github.com/login/oauth/authorize";
    
    public function authorise($function)
    {
        $_SESSION['state'] = Library::generateString(10); // To prevent CSRF attacks
        $query = array(
            "client_id" => $this->github_clientId,
            "scope" => "user repo admin:public_key admin:repo_hook admin:org_hook gist notifications",
            "state" => $_SESSION['state'],
            "redirect_uri" => $this->github_request_uri . "?function=$function"
        );
        $header = self::$AUTHORIZE_URL . "?" . http_build_query($query);
        header("Location:" . $header);
    }

    public function callback()
    {
        if(!isset($_GET['code']) || !isset($_GET['state'])) APIResponse::Unauthorized("Attack detected, aborting...");
        if ($_GET['state'] != $_SESSION['state']) APIResponse::Forbidden("URL change detected, aborting...");
        unset($_SESSION['state']);
        
        $auth = new OAuth();

        switch ($_GET['function']) 
        {
            case "login":
                $accessToken = $auth->getAccessToken($_GET['code']);
                $github = new Github\User($accessToken); $_SESSION["githubUser"] = $github;
                $_SESSION["userLoggedIn"] = User::withGithubId($github->user->id);
                header("Location: /");
                break;

            case "register":
                $accessToken = $auth->getAccessToken($_GET['code']);
                $github = new Github\User($accessToken); $_SESSION["githubUser"] = $github;
                User::update($this->userLoggedIn->userId, array("github_id" => $github->user->id, "github_accessToken" => $accessToken));
                header("Location: /");
                break;

            default:
                APIResponse::Forbidden("Attack detected, aborting...");
        }
    }

    public static function loadProfile($githubProfile)
    {
        if($githubProfile == null)
        {
            echo 
            "<div class='form-group'>
            <a href='../Github/authorize.php?function=register' class='github'><i class='fab fa-github'></i> Register on Github</a>
            </div>";
        }
        else
        {
            echo 
            "<div class='row github-registered'>
            <div class='col-2'><img class='github-image' width='50' height='50' src='{$githubProfile->avatar}}'></div>
            <div class='col-10 github-info'><i class='fab fa-github'></i> Github Linked as {$githubProfile->name} ({$githubProfile->username})</div>   
            </div>";
        }
    }
}