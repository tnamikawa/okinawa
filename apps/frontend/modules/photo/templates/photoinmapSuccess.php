<?php

echo "$cont,$x1,$y1,$x2,$y2\n";

foreach ($photos as $photo) {
  $shotdate = substr($photo->getShotDate(), 0, 10);
  
  echo $photo->getLongitude() . ',' . $photo->getLatitude() . ',';
  echo '20,16,';
  echo $photo->getId() . ',' . $shotdate . ',';
  echo okinawaUtil::getPhotoLinkUrl($photo) . ',/images/photoicon.png,';
  echo okinawaUtil::getThumbUrl($photo) . ',' . $photo->getTitle() . "\n";
}
?>