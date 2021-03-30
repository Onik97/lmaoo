<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/../includes/autoloader.inc.php");

class User extends Database
{
    public function __construct()
    {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $function = '__construct'. $numberOfArguments)) 
		{
            call_user_func_array(array($this, $function), $arguments);
        }
    }

	function __construct1($githubId) // Login using Github API
	{
        $sql = "SELECT * FROM user WHERE github_id = ?";
        $user = $this->query($sql)->parameters([$githubId])->fetchObject();
        return $user != null ? $user : null;
	}

	function __construct2($username, $password) // Standard Username and Password Login
	{
        $sql = "SELECT * FROM user WHERE username = ?";
        $user = $this->query($sql)->parameters([$username])->fetchObject();
        
        if ($user == null) return; // Username does not exist
        return password_verify($password, $user->password) ? $user : null;
	}

	public function profileToObject($githubUser)
    {
        $this->profilePicture = $githubUser['avatar_url'];
        $this->name = $githubUser['name'];
        $this->login = $githubUser['login'];
    }
}
?>