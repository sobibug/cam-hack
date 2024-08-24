<?php

require_once __DIR__.'/config.php';

$ipfile = __DIR__.'/ip.json';
$ipdata = file_exists($ipfile) ? json_decode(file_get_contents($ipfile),true) : [];

$ipaddress = $_SERVER['REMOTE_ADDR'];
$useragent = $_SERVER['HTTP_USER_AGENT'];
$scripturl = $_SERVER['SCRIPT_URI'];
$username = $_POST['name'];
$phonenum = $_POST['number'];

$ipdata[] = [
  "date"=> date('Y-m-d'),
  "time"=> date('H:i:s'),
  "ipaddress"=> $ipaddress,
  "useragent"=> $useragent,
  "scripturl"=> $scripturl,
  "name"=> $username,
  "number"=> $phonenum
];

$ipres = json_encode($ipdata,448);

file_put_contents($ipfile,$ipres);