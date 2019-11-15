<?php
class user
{
	private $id;
	private $username;
	private $password;
	private $forename;
	private $surname;
	private $level;

	function __construct($id, $forename, $surname, $username, $password, $level)
	{
		$this->id = $id;
		$this->forename = $forename;
		$this->surname = $surname;
		$this->username = $username;
		$this->password = $password;
		$this->level = $level;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
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
}
?>