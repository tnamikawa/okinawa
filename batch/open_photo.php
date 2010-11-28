<?php
 
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'prod', false);
 
// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

// 既に実行済みではないことを確認
$c = new Criteria();
$c->add(PhotoPeer::OPEN_DATE, strftime('%Y-%m-%d'));
$result = PhotoPeer::doCount($c);
if ($result) {
  exit;
}

// 昨日の数を取得
$c = new Criteria();
$c->add(PhotoPeer::OPEN_DATE, strftime('%Y-%m-%d', time() - 60 * 60 * 24));
$ycount = PhotoPeer::doCount($c);

// 未公表数を取得
$c = new Criteria();
$c->add(PhotoPeer::OPEN_DATE, null, Criteria::ISNULL);
$nullcount = PhotoPeer::doCount($c);

// 数を乱数で決定
$candidate = array(3, 4, 6);
if ($nullcount > 50) {
  array_push($candidate, 6);
  array_push($candidate, 7);
  array_push($candidate, 9);
}
if ($nullcount > 200) {
  array_push($candidate, mt_rand(10, 20));
  array_push($candidate, mt_rand(10, 20));
  array_push($candidate, mt_rand(10, 20));
}
if ($nullcount > 500) {
  array_push($candidate, mt_rand(20, 30));
  array_push($candidate, mt_rand(20, 30));
  array_push($candidate, mt_rand(20, 30));
  array_push($candidate, mt_rand(20, 30));
}
if ($nullcount > 1000) {
  array_push($candidate, mt_rand(30, 40));
  array_push($candidate, mt_rand(30, 40));
  array_push($candidate, mt_rand(30, 40));
  array_push($candidate, mt_rand(30, 40));
  array_push($candidate, mt_rand(30, 40));
}
$count = $ycount;
while ($count == $ycount) {
  $idx = mt_rand(0, sizeof($candidate) - 1);
  $count = $candidate[$idx];
}

$c = new Criteria();
$c->add(PhotoPeer::OPEN_DATE, null, Criteria::ISNULL);
$c->setLimit($count);
$c->addAscendingOrderByColumn(PhotoPeer::SHOT_DATE);
$photos = PhotoPeer::doSelect($c);

foreach ($photos as $photo) {
  $photo->setOpenDate(strftime('%Y-%m-%d'));
  $photo->save();
  
  $c = new Criteria();
  $c->add(PhotoAndTagPeer::PHOTO_ID, $photo->getId());
  $rels = PhotoAndTagPeer::doSelect($c);
  foreach ($rels as $rel) {
    $rel->setOpenFlag(1);
    $rel->save();
  }
}


?>