<?php

class User
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

	function __construct1($githubId)
	{
		
	}

	function __construct2($username, $password)
	{

	}

	public function profileToObject($githubUser)
    {
        $this->profilePicture = $githubUser['avatar_url'];
        $this->name = $githubUser['name'];
        $this->login = $githubUser['login'];
    }
}
?>