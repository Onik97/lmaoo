<?php
class user
{
	private $id;
	private $username;
	private $password;
	private $forename;
	private $surname;
	private $level;
	private $isActive;
	private $githubId;

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

	function createGithubProfile($profilePicture, $name, $login)
	{
		$this->profilePicture = $profilePicture;
		$this->name = $name;
		$this->login = $login;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return htmlspecialchars($this->id, ENT_QUOTES, 'UTF-8');
	}

	public function setUsername($username)
	{
		$this->username = $username;
	}

	public function getUsername()
	{
		return htmlspecialchars($this->username, ENT_QUOTES, 'UTF-8');
	}

	public function setPassword($password)
	{
		$this->password = $password;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function setForename($forename)
	{
		$this->forename = $forename;
	}

	public function getForename()
	{
		return htmlspecialchars($this->forename, ENT_QUOTES, 'UTF-8');
	}

	public function setSurname($surname)
	{
		$this->surname = $surname;
	}

	public function getSurname()
	{
		return htmlspecialchars($this->surname, ENT_QUOTES, 'UTF-8');
	}

	public function setLevel($level)
	{
		$this->level = $level;
	}

	public function getLevel()
	{
		return $this->level;
	}

	public function setIsActive($isActive)
	{
		$this->isActive = $isActive;
	}

	public function getIsActive()
	{
		return $this->isActive;
	}

	public function setDarkMode($darkMode)
	{
		$this->darkMode = $darkMode;
	}

	public function getDarkMode()
	{
		return $this->darkMode;
	}

	public function setGithubId($githubId)
	{
		$this->githubId = $githubId;
	}

	public function getGithubId()
	{
		return $this->githubId;
	}

}
?>