<?php

error_repoting(E_ALL);
date_default_timezone_set('Asia/Tokyo');

// DB接続を確保する
$con = mysql_connect('localhost', 'okinawa', 'okinawa');
mysql_select_db('okinawa');
mysql_query("SET NAMES UTF8");

// 画像を決定して読み込み
$sql = 'SELECT photo_id FROM photo_and_tag_rel WHERE tag_id=7 ORDER BY RAND() LIMIT 1';
$result = mysql_query($sql);
$tmp = mysql_fetch_assoc($result);
$photo_id = $tmp['photo_id'];

$sql = "SELECT * FROM photo_mst WHERE id=$photo_id";
$result = mysql_query($sql);
$photo = mysql_fetch_assoc($result);

// blog_photo_mstにも保存
$record = array('photo_id' => $photo_id, 'use_date' => strftime('%Y-%m-%d'));
$sql = "INSERT INTO blog_photo_mst(photo_id, use_date) values ($photo_id, '" .  strftime('%Y-%m-%d') . "')";
$result = mysql_query($sql);
assert($result);

// 幅ループ
$widthes = array(120, 140, 160, 180, 200, 220, 240);
foreach ($widthes as $width) {
  
  // 出力パス
  $path = '/home/okinawa/web/parts/' . $photo_id . '_' . $width . '.jpg';
  $todaypath = '/home/okinawa/web/parts/today_' . $width . '.jpg';

  /// 画像作成
  $height = Math.ceil($width * $photo['height'] / $photo['width']);

  /// 加工して保存
  $imgSrc = imagecreatefromjpeg($filepath = '/home/photo/' . $photo['filename']);
  $imgDst = imagecreatetruecolor($width, $height);

  $srcwidth = imagesx($imgSrc);
  $srcheight = imagesy($imgSrc);
  imagecopyresampled($imgDst, $imgSrc, 0, 0, 0, 0, $width, $height, $srcwidth, $srcheight);
  imagejpeg($imgDst, $path, 80);
  imagejpeg($imgDst, $todaypath, 80);
}

