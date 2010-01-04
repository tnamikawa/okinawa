<?php

$host = gethostbyaddr($_SERVER['REMOTE_ADDR']);

if (preg_match('/google/i', $_SERVER['HTTP_USER_AGENT']) &&
(preg_match('/google/', $host) || $host == $_SERVER['REMOTE_ADDR'])) {
  $buff = file_get_contents('robo_crawler.txt');
}
else if (preg_match('/yahoo/i', $_SERVER['HTTP_USER_AGENT']) &&
(preg_match('/yahoo/', $host) || $host == $_SERVER['REMOTE_ADDR'])) {
  $buff = file_get_contents('robo_crawler.txt');
}
else if (preg_match('/inktomi/i', $_SERVER['HTTP_USER_AGENT']) &&
(preg_match('/inktomi/', $host) || $host == $_SERVER['REMOTE_ADDR'])) {
  $buff = file_get_contents('robo_crawler.txt');
}
else if (preg_match('/livebot/i', $_SERVER['HTTP_USER_AGENT']) &&
(preg_match('/msn/', $host) || $host == $_SERVER['REMOTE_ADDR'])) {
  $buff = file_get_contents('robo_crawler.txt');
}
else if (preg_match('/ask\.com/i', $_SERVER['HTTP_USER_AGENT']) &&
(preg_match('/ask\.com/', $host) || $host == $_SERVER['REMOTE_ADDR'])) {
  $buff = file_get_contents('robo_crawler.txt');
}
else if (preg_match('/baidu/i', $_SERVER['HTTP_USER_AGENT']) &&
(preg_match('/asianetcom/', $host) || $host == $_SERVER['REMOTE_ADDR'])) {
  $buff = file_get_contents('robo_crawler.txt');
}
else if (preg_match('/yeti/i', $_SERVER['HTTP_USER_AGENT']) &&
(preg_match('/naver.com/', $host) || $host == $_SERVER['REMOTE_ADDR'])) {
  $buff = file_get_contents('robo_crawler.txt');
}
else {
  $buff = file_get_contents('robo_human.txt');
}

//mail('takeshi.namikawa@gmail.com', $host . ':-:' . $_SERVER['HTTP_USER_AGENT'], $buff);

header('Content-Type: text/plain');
header('Content-Length: ' . strlen($buff));
header('Last-Modified: Fri, 22 Jun 2007 23:59:48 GMT');

print $buff;

?>