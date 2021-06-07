<?php
namespace Lmaoo\Core;

abstract class Config 
{
    public function __construct()
    {
        $config = @include "../config.php";
        if ($config == null) die("Error: 101");

        $this->db_host = $config["db_host"];
        $this->db_table = $config["db_table"];
        $this->db_username = $config["db_username"];
        $this->db_password = $config["db_password"];
        $this->github_clientId = $config["github_clientId"];
        $this->github_secret = $config["github_secret"];
        $this->github_request_uri = $config["github_request_uri"];
    }
}
