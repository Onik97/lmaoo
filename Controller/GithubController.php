<?php require_once($_SERVER["DOCUMENT_ROOT"] . "lmaoo/includes/autoloader.inc.php"); 

class GithubControllerss extends ApiWrapper
{
    public function __construct() { $this->config = include(__DIR__ . "../config.php"); } 

    public function login()
    {
        die(ApiWrapper::getRequest("https://api.github.com/users/oniknoor97"));
    }
}

// class githubControllers
// {
//     public function __construct() { $this->config = include(__DIR__ . '/../config.php'); } 

//     public function setAccessToken()
//     {
//         $postRequest = array(
//             'client_id' => $this->config['github_clientId'],
//             'client_secret' => $this->config['github_secret'],
//             'code' => $_GET['code'],
//         );
        
//         $cURLConnection = curl_init('https://github.com/login/oauth/access_token');
//         curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
//         curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
//         curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, array('Accept' => 'application/json'));
//         $accessTokenResponse = curl_exec($cURLConnection);
//         curl_close($cURLConnection);

//         $jsonAccessTokenResponse = json_decode($accessTokenResponse, true);
//         $this->accessToken = $jsonAccessTokenResponse["access_token"];
//     }

//     public function getAccessToken() { return $this->accessToken; }

//     public function getAccessTokenFromDatabase($userId) 
//     {
//         $pdo = logindb();
// 		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
// 		$stmt = $pdo->prepare("SELECT github_accessToken FROM user WHERE userId = ?");
// 		$stmt->execute([$userId]);
// 		return $stmt->fetchColumn();
//     }

//     public function getGithubUser($accessToken)
//     {
//         $cURLConnection = curl_init();
//         curl_setopt($cURLConnection, CURLOPT_URL, 'https://api.github.com/user');
//         curl_setopt($cURLConnection, CURLOPT_FOLLOWLOCATION, true);
//         curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
//         curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, array(
//             "Authorization: token {$accessToken}",
//             "User-Agent: Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0"
//         ));
//         $accessTokenResponse = curl_exec($cURLConnection);
//         curl_close($cURLConnection);

//         return json_decode($accessTokenResponse, true);
//     }

//     public function loadProfile($userLoggedIn)
//     {
//         if($userLoggedIn->getGithubId() == null)
//         {
//             echo 
//             "<div class='form-group'>
//             <a href='../Github/authorize.php?function=register' class='github'><i class='fab fa-github'></i> Register on Github</a>
//             </div>";
//         }
//         else
//         {
//             echo 
//             "<div class='row github-registered'>
//             <div class='col-2'><img class='github-image' width='50' height='50' src='{$userLoggedIn->profilePicture}}'></div>
//             <div class='col-10 github-info'><i class='fab fa-github'></i> Github Linked as {$userLoggedIn->name} ({$userLoggedIn->login})</div>   
//             </div>";
//         }
//     }

//     public function login($githubId)
//     {
//         $pdo = logindb();
// 		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
// 		$stmt = $pdo->prepare("SELECT * FROM user WHERE github_id = ?");
// 		$stmt->execute([$githubId]);
//         $user = $stmt->fetch();
//         $stmt = $pdo->prepare("UPDATE user SET github_accessToken = ? WHERE github_id = ?");
// 		$stmt->execute([$this->getAccessToken(), $githubId]);

//         if($user == null)
//         {
//             $_SESSION['message'] = 'Github account not linked, you must login and register the Github account first';
//             header("Location: ../User/login.php");
//         }
//         else if($user->isActive == true)
//         {
//             $githubUser = $this->getGithubUser($this->getAccessToken());
//             $userLoggedIn = new user($user->userId, $user->forename, $user->surname, $user->username, $user->password, $user->level, $user->isActive, $user->darkMode, $user->github_id);
//             $userLoggedIn->createGithubProfile($githubUser['avatar_url'], $githubUser['name'], $githubUser['login']);
//             if ($user->darkMode != $_COOKIE["lmaooDarkMode"]) setcookie("lmaooDarkMode", $user->darkMode, 0, "/");
//             $_SESSION['userLoggedIn'] = $userLoggedIn;
//             header("Location: ../Home/index.php");
//         }
//         else
//         {
//             $_SESSION['message'] = 'User deactivated, contact the administrator';
//             header("Location: ../User/login.php");
//         }
//     }

//     public function registerGithub()
//     {
//         $githubUser = $this->getGithubUser($this->accessToken);

//         $pdo = logindb();
// 		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
//         $stmt = $pdo->prepare("UPDATE user SET github_id = ?, github_accessToken = ? WHERE userId = ?");
//         $stmt->execute([$githubUser['id'], $this->getAccessToken(), $_SESSION['userLoggedIn']->getId()]);
        
//         $_SESSION['userLoggedIn']->setGithubId($githubUser['id']);
//         $_SESSION['userLoggedIn']->profilePicture = $githubUser['avatar_url'];
// 		$_SESSION['userLoggedIn']->name = $githubUser['name'];
//         $_SESSION['userLoggedIn']->login = $githubUser['login'];
        
//         $_SESSION['message'] = 'Github Registration Successful!';
//         header("Location: ../Home/index.php");
//     }
// }