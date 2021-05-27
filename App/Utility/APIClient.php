<?php
namespace App\Utility;

class APIClient 
{
    public static function getRequest(string $url, array $headers = null)
    {
        $cURLConnection = curl_init();
        curl_setopt($cURLConnection, CURLOPT_URL, $url);
        curl_setopt($cURLConnection, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
        if ($headers != null) curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($cURLConnection);
        curl_close($cURLConnection);
        return $response;
    }

    public static function postRequest(string $url, array $postFields = null, array $headers = null)
    {
        $cURLConnection = curl_init($url);
        if($postFields != null) curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postFields);
        if($headers != null) curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, $headers);
        
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($cURLConnection);
        curl_close($cURLConnection);
        return $response;
    }
}