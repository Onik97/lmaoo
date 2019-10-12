<?php
class user
{
	private $id;
	private $username;
	private $password;
	private $forename;
	private $surname;

	function __construct($id, $forename, $surname, $username, $password)
	{
		$this->id = $id;
		$this->forename = $forename;
		$this->surname = $surname;
		$this->username = $username;
		$this->password = $password;
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
// 
	public function getUsername()
	{
		return $this->username;
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
		return $this->forename;
	}

	public function setSurname($surname)
	{
		$this->surname = $surname;
	}

	public function getSurname()
	{
		return $this->surname;
	}
}
?>