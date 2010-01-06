<?php
use_helper('okinawa');

$arr = array($n, $e, $s, $w);

foreach ($arr as $p) {
  if (! is_null($p)) {
    echo $p->getId() . '<,>';
    echo $p->getLongitude() . '<,>';
    echo $p->getLatitude() . '<,>';
    echo okinawaUtil::getPhotoLinkUrl($p) . "<,>";
    echo okinawaUtil::getPhotoUrl($p) . "<,>";
    echo okinawaUtil::getThumbUrl($p) . "<,>";
    echo $p->getWidth() . '<,>';
    echo $p->getHeight() . '<,>';
    echo $p->getTitle() . '<,>';
    echo $p->getComment() . '<,>';
    related_keywords($p);
    echo "<,>";
    shot_date($p);
  }
  echo "\n";
}
?>