<?php

	function __construct($id, $forename, $surname, $username, $password, $level, $isActive, $darkMode, $githubId)
	{
		$this->id = $id;
		$this->forename = $forename;
		$this->surname = $surname;
		$this->username = $username;
		$this->password = $password;
		$this->level = $level;
		$this->isActive = $isActive;
		$this->darkMode = $darkMode;
		$this->githubId = $githubId;
	}

	public function profileToObject($githubUser)
    {
        $this->profilePicture = $githubUser['avatar_url'];
        $this->name = $githubUser['name'];
        $this->login = $githubUser['login'];
    }
}
?>