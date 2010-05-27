<?php

foreach ($photos as $photo) {
  echo $photo->getLongitude() . ',' . $photo->getLatitude() . ',' . $photo->getId() . ':' . $photo->getTitle() . "\n";
}
?>