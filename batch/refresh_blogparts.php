<?php
 
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'prod', false);
 
// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

// 作成するサイズ
$width_list = array(120, 140, 160, 180, 200, 220, 240);

// 今日のidを取得
$c = new Criteria();
$c->add(BlogPhotoPeer::USE_DATE, strftime('%Y-%m-%d'));
$blogphoto = BlogPhotoPeer::doSelectOne($c);

if (! is_object($blogphoto)) {

  // 今日の画像が決定されていなれば決定
  $c = new Criteria();
  $c->add(BlogPhotoPeer::USE_DATE, null, Criteria::ISNULL);
  $all = BlogPhotoPeer::doSelect($c);
  if (sizeof($all)) {
    $idx = mt_rand(0, sizeof($all) - 1);
    $id = $all[$idx]->getId();
    
    $blogphoto = BlogPhotoPeer::retrieveByPk($id);
    if (is_object($blogphoto)) {
      $blogphoto->setUseDate(strftime('%Y-%m-%d'));
      $blogphoto->save();
    }
  }
  else {
    
    // 候補がなければ樹木、緑から選択
    $c = new Criteria();
    $c->add(PhotoAndTagPeer::TAG_ID, 7);
    $green = PhotoAndTagPeer::doSelect($c);
    
    $id = 0;
    while (! $id) {
      $idx = mt_rand(0, sizeof($green) - 1);
      $photo = PhotoPeer::retrieveByPk($green[$idx]->getPhotoId());
      if (($photo->getWidth() == 809 ||
      $photo->getWidth() == 810) &&
      $photo->getHeight() == 543 &&
      (is_null($photo->getOpenDate()) == FALSE) &&
      strlen($photo->getOpenDate()) &&
      strlen($photo->getComment())) {
        $id = $photo->getId();
      }
    }
    
    $c = new Criteria();
    $c->add(BlogPhotoPeer::PHOTO_ID, $id);
    BlogPhotoPeer::doInsert($c);
    
    $c = new Criteria();
    $c->add(BlogPhotoPeer::PHOTO_ID, $id);
    $blogphoto = BlogPhotoPeer::doSelectOne($c);
    if (is_object($blogphoto)) {
      $blogphoto->setUseDate(strftime('%Y-%m-%d'));
      $blogphoto->save();
    }
  }
}

$c = new Criteria();
$c->add(BlogPhotoPeer::USE_DATE, null, Criteria::ISNOTNULL);
$all = BlogPhotoPeer::doSelect($c);

foreach ($all as $one) {
  foreach ($width_list as $width) {
    $path = '/home/okinawa/web/parts/' . $one->getPhotoId() . '_' . $width . '.jpg';
    $todaypath = '/home/okinawa/web/parts/today_' . $width . '.jpg';
    if (file_exists($path) && is_readable($path)) {
      continue;
    }
    
    // Photoオブジェクト
    $photo = PhotoPeer::retrieveByPk($one->getPhotoId());
    assert(is_object($photo));
    
    $height = $width * $photo->getHeight() / $photo->getWidth();
    
    $imgSrc = imagecreatefromjpeg($filepath = sfConfig::get('app_path_upload') . $photo->getFilename());
    $imgDst = imagecreatetruecolor($width, $height);
    
    if (is_resource($imgSrc) && is_resource($imgDst)) {
      $srcwidth = imagesx($imgSrc);
      $srcheight = imagesy($imgSrc);
      imagecopyresampled($imgDst, $imgSrc, 0, 0, 0, 0, $width, $height, $srcwidth, $srcheight);
      
      imagejpeg($imgDst, $path, 80);
      
      if ($one->getUseDate() == strftime('%Y-%m-%d')) {
        imagejpeg($imgDst, $todaypath, 80);
      }
    }
  }
}

foreach ($width_list as $width) {
    $todaypath = '/home/okinawa/web/parts/today_' . $width . '.jpg';

	// Photoオブジェクト
	$photo = PhotoPeer::retrieveByPk($blogphoto->getPhotoId());
	assert(is_object($photo));
	    
	$height = $width * $photo->getHeight() / $photo->getWidth();
	    
	$imgSrc = imagecreatefromjpeg($filepath = sfConfig::get('app_path_upload') . $photo->getFilename());
	$imgDst = imagecreatetruecolor($width, $height);
	    
	if (is_resource($imgSrc) && is_resource($imgDst)) {
	  $srcwidth = imagesx($imgSrc);
	  $srcheight = imagesy($imgSrc);
	  imagecopyresampled($imgDst, $imgSrc, 0, 0, 0, 0, $width, $height, $srcwidth, $srcheight);
	  imagejpeg($imgDst, $todaypath, 80);
	}
}



?>