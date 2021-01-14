<?php require_once($_SERVER["DOCUMENT_ROOT"] . "lmaoo/includes/autoloader.inc.php"); 

class GithubController extends ApiWrapper
{
    public static $ACCESS_TOKEN_URL = "https://github.com/login/oauth/access_token";
    public static $USER_URL = "https://api.github.com/user";

    public function __construct() { $this->config = include($_SERVER["DOCUMENT_ROOT"] . "lmaoo/config.php"); }

    public function getAccessToken() { return $this->accessToken; }

    public function getAccessTokenFromDatabase($userId) 
    {
        $pdo = Library::logindb();
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		$stmt = $pdo->prepare("SELECT github_accessToken FROM user WHERE userId = ?");
		$stmt->execute([$userId]);
		return $stmt->fetchColumn();
    }

    public function setAccessToken()
    {
        $postFields = array(
            'client_id' => $this->config['github_clientId'],
            'client_secret' => $this->config['github_secret'],
            'code' => $_GET['code'],
        );

        $headers = array('Accept: application/json');

        $accessTokenResponse = self::postRequest(self::$ACCESS_TOKEN_URL, $postFields, $headers);
        $jsonAccessTokenResponse = json_decode($accessTokenResponse, true);
        $this->accessToken = $jsonAccessTokenResponse["access_token"];
    }

    public function saveAccessToken($githubUser)
    {
        $pdo = Library::logindb();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("UPDATE user SET github_accessToken = ? WHERE github_id = ?");
        $stmt->execute([$this->getAccessToken(), $githubUser['id']]);
        return $stmt->fetchColumn();
    }

    public function getGithubUser($accessToken)
    {
        $headers = array(
            "Authorization: token {$accessToken}",
            "User-Agent: Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0"
        );

        $accessTokenResponse = self::postRequest(self::$USER_URL, null, $headers);
        return json_decode($accessTokenResponse, true);
    }

    public function registerGithub()
    {
        $githubUser = $this->getGithubUser($this->accessToken);

        $pdo = Library::logindb();
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $pdo->prepare("UPDATE user SET github_id = ?, github_accessToken = ? WHERE userId = ?");
        $stmt->execute([$githubUser['id'], $this->getAccessToken(), $_SESSION['userLoggedIn']->getId()]);

        $userLoggedIn = unserialize($_SESSION['userLoggedIn']);
        $userLoggedIn->setGithubId($githubUser['id']);
        $this->profileToObject($userLoggedIn);
        
        $_SESSION['userLoggedIn'] = serialize($userLoggedIn);
        Library::redirectWithMessage("Github Registration Successful!", "../Home/index.php");
    }

    public static function loadProfile($userLoggedIn)
    {
        if($userLoggedIn->getGithubId() == null)
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
            <div class='col-2'><img class='github-image' width='50' height='50' src='{$userLoggedIn->profilePicture}}'></div>
            <div class='col-10 github-info'><i class='fab fa-github'></i> Github Linked as {$userLoggedIn->name} ({$userLoggedIn->login})</div>   
            </div>";
        }
    }

}