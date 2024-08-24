<?php

$images = glob('./image/*');
foreach($images as $image){
  unlink($image);
}
rmdir('./image/');

$ip_txt = './ip.json';
unlink($ip_txt);

$log_log = './log.log';
unlink($log_log);

echo 'It was reset!';