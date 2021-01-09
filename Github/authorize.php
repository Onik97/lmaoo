<?php
$config = require("../config.php");
// To prevent CSRF attacks
$length = 10;
$keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$str = '';
$max = mb_strlen($keyspace, '8bit') - 1;
if ($max < 1) throw new Exception('$keyspace must be at least two characters long'); 
for ($i = 0; $i < $length; ++$i) $str .= $keyspace[random_int(0, $max)];

session_start();
$_SESSION['state'] = $str;
header("Location: https://github.com/login/oauth/authorize?client_id={$config['github_clientId']}&scope=user%20repo%20admin%3Apublic_key%20admin%3Arepo_hook%20admin%3Aorg_hook%20gist%20notifications%20&state={$_SESSION['state']}");
?>