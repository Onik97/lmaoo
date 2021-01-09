<?php require_once("../connection.php"); require_once("../User/userController.php");

class githubController
{
    public function __construct() { $this->config = include('../config.php'); } 

    public function setAccessToken()
    {
        $postRequest = array(
            'client_id' => $this->config['github_clientId'],
            'client_secret' => $this->config['github_secret'],
            'code' => $_GET['code'],
        );
        
        $cURLConnection = curl_init('https://github.com/login/oauth/access_token');
        curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        $accessTokenResponse = curl_exec($cURLConnection);
        curl_close($cURLConnection);

        $jsonAccessTokenResponse = json_decode($accessTokenResponse, true);
        $this->accessToken = $jsonAccessTokenResponse["access_token"];
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

}