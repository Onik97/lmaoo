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

    public function login($githubId)
    {
        $pdo = Library::logindb();
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		$stmt = $pdo->prepare("SELECT * FROM user WHERE github_id = ?");
		$stmt->execute([$githubId]);
        $user = $stmt->fetch();
        $stmt = $pdo->prepare("UPDATE user SET github_accessToken = ? WHERE github_id = ?");
		$stmt->execute([$this->getAccessToken(), $githubId]);

        if($user == null)
        {
            $_SESSION['message'] = 'Github account not linked, you must login and register the Github account first';
            header("Location: ../User/login.php");
        }
        else if($user->isActive == true)
        {
            $githubUser = $this->getGithubUser($this->getAccessToken());
            $userLoggedIn = new user($user->userId, $user->forename, $user->surname, $user->username, $user->password, $user->level, $user->isActive, $user->darkMode, $user->github_id);
            $userLoggedIn->createGithubProfile($githubUser['avatar_url'], $githubUser['name'], $githubUser['login']);
            if ($user->darkMode != $_COOKIE["lmaooDarkMode"]) setcookie("lmaooDarkMode", $user->darkMode, 0, "/");
            $_SESSION['userLoggedIn'] = serialize($userLoggedIn);
            header("Location: ../Home/index.php");
        }
        else
        {
            $_SESSION['message'] = 'User deactivated, contact the administrator';
            header("Location: ../User/login.php");
        }
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
        $userLoggedIn->profilePicture = $githubUser['avatar_url'];
		$userLoggedIn->name = $githubUser['name'];
        $userLoggedIn->login = $githubUser['login'];
        $_SESSION['userLoggedIn'] = serialize($userLoggedIn);
        
        $_SESSION['message'] = 'Github Registration Successful!';
        header("Location: ../src/Home/index.php");
    }
}