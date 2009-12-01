<?php
echo $photo->getTitle() . "\n";
echo $photo->getComment() . "\n";
echo $photo->getShotDate() . "\n";

$tmp = false;
foreach ($tags as $tag) {
  if ($tmp) {
    echo ',';
  }
  $tmp = true;
  echo $tag->getId();
}
echo "\n";

$tmp = false;
foreach ($tags as $tag) {
  if ($tmp) {
    echo ',';
  }
  $tmp = true;
  echo $tag->getTitle();
}
echo "\n";

echo $photo->getPhotoUrl() . "\n";

$vprev = '';
$hprev = '';
$vnext = '';
$hnext = '';
foreach ($v_prev as $p) {
  if (strlen($vprev)) {
    $vprev .= '<>';
  }
  $vprev .= '<img src="' . $p->getSlideUrl() . '" alt="' . $p->getTitle() . '">';
}
foreach ($h_prev as $p) {
  if (strlen($hprev)) {
    $hprev .= '<>';
  }
  $hprev .= '<img src="' . $p->getSlideUrl() . '" alt="' . $p->getTitle() . '">';
}
foreach ($v_next as $p) {
  if (strlen($vnext)) {
    $vnext .= '<>';
  }
  $vnext .= '<img src="' . $p->getSlideUrl() . '" alt="' . $p->getTitle() . '">';
}
foreach ($h_next as $p) {
  if (strlen($hnext)) {
    $hnext .= '<>';
  }
  $hnext .= '<img src="' . $p->getSlideUrl() . '" alt="' . $p->getTitle() . '">';
}

echo $vprev . "\n";
echo $vnext . "\n";
echo $hprev . "\n";
echo $hnext . "\n";

foreach($tags as $tag) {
  if ($tmp) {
    $previd .= ',';
    $prevtitle .= ',';
    $prevurl .= ',';
  }
  $tmp = true;
  $tmp2 = false;
  foreach ($photos_prev[$tag->getId()] as $p) {
    if ($tmp2) {
      $previd .= '-';
      $prevtitle .= '-';
      $prevurl .= '-';
    }
    $tmp2 = true;
    $previd .= $p->getId();
    $prevtitle .= rawurlencode($p->getTitle());
    $prevurl .= $p->getSlideUrl();
  }
}


$previd = '';
$prevtitle = '';
$prevurl = '';
$tmp = false;
foreach($tags as $tag) {
  if ($tmp) {
    $previd .= ',';
    $prevtitle .= ',';
    $prevurl .= ',';
  }
  $tmp = true;
  $tmp2 = false;
  foreach ($photos_prev[$tag->getId()] as $p) {
    if ($tmp2) {
      $previd .= '-';
      $prevtitle .= '-';
      $prevurl .= '-';
    }
    $tmp2 = true;
    $previd .= $p->getId();
    $prevtitle .= rawurlencode($p->getTitle());
    $prevurl .= $p->getSlideUrl();
  }
}
echo "$previd\n";
echo "$prevtitle\n";
echo "$prevurl\n";

$nextid = '';
$nexttitle = '';
$nexturl = '';
$tmp = false;
foreach($tags as $tag) {
  if ($tmp) {
    $nextid .= ',';
    $nexttitle .= ',';
    $nexturl .= ',';
  }
  $tmp = true;
  $tmp2 = false;
  foreach ($photos_next[$tag->getId()] as $p) {
    if ($tmp2) {
      $nextid .= '-';
      $nexttitle .= '-';
      $nexturl .= '-';
    }
    $tmp2 = true;
    $nextid .= $p->getId();
    $nexttitle .= rawurlencode($p->getTitle());
    $nexturl .= $p->getSlideUrl();
  }
}
echo "$nextid\n";
echo "$nexttitle\n";
echo "$nexturl\n";


?>