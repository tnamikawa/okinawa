<?php
/*
 * Created on 2007/01/08
 *
 * Using PHPeclipse
 * Takeshi NAMIKAWA
 */

/**
 * 全てのキーワード
 */
function all_keywords()
{
  $buff = '<p class="keywordall">';
  
  $c = new Criteria();
  $c->addDescendingOrderByColumn(TagPeer::ORDER_PRIORITY);
  $taglist = TagPeer::doSelect($c);
  for ($i = 0; $i < sizeof($taglist); $i++)
  {
    if ($i)
    {
      $buff .= '&nbsp;&nbsp;&nbsp;';
      // $buff .= '<br />';
    }
    $buff .= '<a href="' . url_for('photo/keyword?title=' . $taglist[$i]->getTitle()) . '">';
    $buff .= $taglist[$i]->getTitle() . '(' . $taglist[$i]->getEnglishTitle() . ')';
    $buff .= '</a>';
  }
  
  $buff .= '</p>';
  
  echo $buff;
}

/**
 * Photoオブジェクトから写真imgタグを出力
 */
function img_photo($photo)
{
  if (is_object($photo)) {
    $buff = '<img src="' . $photo->getPhotoUrl() . '"';
    $buff .= ' width="' . $photo->getWidth() . '"';
    $buff .= ' height="' . $photo->getHeight() . '"';
    $buff .= ' alt="' . $photo->getTitle() . '"';
    $buff .= ' />';
    //$buff .=  ' class="corner ishadow20">';
    echo $buff;
  }
}

/**
 * キーワードから探す
 */
function keywords_keyword($index, $count)
{
  $length = 4;
  $offset = $length * $index;
  $pages = ((int)(($count / $length))) + (($count % $length) ? 1 : 0);
  
  $line_length = 7;
  
  // キーワード
  $c = new Criteria();
  $c->addDescendingOrderByColumn(TagPeer::ORDER_PRIORITY);
  $c->addAscendingOrderByColumn(TagPeer::ID);
  $c->setOffset($offset);
  $c->setLimit($length);
  $tags = TagPeer::doSelect($c);
  
  $used_id = array();
  foreach ($tags as $tag) {
    
    // 写真
    $c = new Criteria();
    $c->add(PhotoAndTagPeer::TAG_ID, $tag->getId());
    $c->add(PhotoAndTagPeer::OPEN_FLAG, 1);
    $count = PhotoAndTagPeer::doCount($c);
    $result = PhotoAndTagPeer::doSelect($c);
    $photoidlist = array();
    foreach ($result as $photoandtag)
    {
      array_push($photoidlist, $photoandtag->getPhotoId());
    }
    $c = new Criteria();
    $c->add(PhotoPeer::ID, $photoidlist, Criteria::IN);
    $c->add(PhotoPeer::OPEN_DATE, null, Criteria::ISNOTNULL);
    $c->addDescendingOrderByColumn(PhotoPeer::SHOT_DATE);
    $c->setLimit($line_length + 5);
    $photos = PhotoPeer::doSelect($c);
    
    echo '<h3 class="sub">' . link_to($tag->getTitle(), 'photo/keyword?title=' . $tag->getTitle()) . '(' . $tag->getEnglishTitle() . ')';
    echo '<span style="font-size:14px; color:#606060;">（' . $count . '枚）</h3>';
    $line_index = 0;
    foreach ($photos as $photo) {
      $photoid = $photo->getId();
      if (is_numeric(array_search($photoid, $used_id))) {
        continue;
      }
      array_push($used_id, $photoid);
      
      echo '<a href="' . okinawaUtil::getPhotoLinkUrl($photo) . '">';
      echo okinawaUtil::getThumbnailTagSlim($photo);
      echo '</a> &nbsp;&nbsp;';
      
      $line_index++;
      if ($line_index >= $line_length) {
        break;
      }
    }
  }
  
  // 下部のページャー
  keyword_pager2($index, $pages);
}

/**
 * キーワードに対応する写真の領域を出力
 */
function keyword_photo($id, $index, $count)
{
  $length = 28;
  $offset = $length * $index;
  $pages = ((int)(($count / $length))) + (($count % $length) ? 1 : 0);
  
  // 写真
  $c = new Criteria();
  $c->add(PhotoAndTagPeer::TAG_ID, $id);
  $c->add(PhotoAndTagPeer::OPEN_FLAG, 1);
  $result = PhotoAndTagPeer::doSelect($c);
  $photoidlist = array();
  foreach ($result as $photoandtag)
  {
    array_push($photoidlist, $photoandtag->getPhotoId());
  }
  $c = new Criteria();
  $c->add(PhotoPeer::ID, $photoidlist, Criteria::IN);
  $c->add(PhotoPeer::OPEN_DATE, null, Criteria::ISNOTNULL);
  $c->addDescendingOrderByColumn(PhotoPeer::SHOT_DATE);
  $c->setOffset($offset);
  $c->setLimit($length);
  $photos = PhotoPeer::doSelect($c);
  
  photo_table($photos);
  
  // 下部のページャー
  keyword_pager($id, $index, $pages);
}

/**
 * キーワードページのページャー
 */
function keyword_pager($id, $index, $pages) {
  
  echo '<div class="keywordpager">';
  if ($pages > 1) {
    echo '<span style="color:#000000">NEW</span>&nbsp;&nbsp;';
    
    for ($i = 0; $i < $pages; $i++) {
      if ($i) {
        echo '&nbsp;&nbsp;';
      }
      $number = $i + 1;
      if ($i === $index) {
        echo "<strong>$number</strong>";
      }
      else {
        echo '<a href="#" onClick="requestPhotos(' . $id . ', ' . $i . ')">' . $number . '</a>';
      }
    }
    
    echo '&nbsp;&nbsp;<span style="color:#000000">OLD</span>';
  }
  echo '</div>';
}

/**
 * キーワードページのページャー
 */
function keyword_pager2($index, $pages) {
  
  echo '<div class="keywordpager">';
  if ($pages > 1) {
    for ($i = 0; $i < $pages; $i++) {
      if ($i) {
        echo '&nbsp;&nbsp;';
      }
      $number = $i + 1;
      if ($i == $index) {
        echo "<strong>$number</strong>";
      }
      else {
        echo '<a href="#" onClick="requestKeywords(' . $i . ')">' . $number . '</a>';
      }
    }
  }
  echo '</div>';
}

/**
 * Photoオブジェクトから元写真imgタグを出力
 */
function raw_photo($photo)
{
  if (is_object($photo) && $photo instanceof Photo) {
    $buff = '<img src="/raw/' . $photo->getFilename() . '"';
    $buff .= ' alt="' . $photo->getTitle() . '"';
    $buff .= ' />';
    echo $buff;
  }
}

function related_keywords($photo)
{
  if (is_object($photo)) {
    $buff = '<p class="keyword">';
    
    $taglist = okinawaUtil::getTagList($photo);
    for ($i = 0; $i < sizeof($taglist); $i++)
    {
      if ($i)
      {
        $buff .= '&nbsp;&nbsp;&nbsp;';
        // $buff .= '<br />';
      }
      $buff .= '<a href="' . url_for('photo/keyword?title=' . $taglist[$i]->getTitle()) . '">';
      $buff .= $taglist[$i]->getTitle() . '(' . $taglist[$i]->getEnglishTitle() . ')';
      $buff .= '</a>';
    }
    
    $buff .= '</p>';
    
    echo $buff;
  }
}

function open_date_short($photo)
{
  if (is_object($photo)) {
    $tmp = null;
    if (FALSE && preg_match('/^(\d{4})\-(\d{2})\-(\d{2})/', $photo->getOpenDate(), $tmp)) {
      $year = (int)$tmp[1];
      $month = (int)$tmp[2];
      $mday = (int)$tmp[3];
      
      echo $year . '年' . $month . '月' . $mday . '日';
    }
  }
}

function related_thumbnail($photo, $keywordid)
{
  if (is_object($photo)) {
    $buff = '';
    
    $photolist = okinawaUtil::getRelatedPhotoList($photo, $keywordid);
    for ($i = 0; $i < sizeof($photolist); $i++)
    {
      if ($i)
      {
        //$buff .= '&nbsp;';
        $buff .= '<br />';
      }
      $buff .= okinawaUtil::getThumbnailTagSlim($photolist[$i]);
    }
    
    echo $buff;
  }
}

function photo_table($photolist)
{
  if (is_array($photolist))
  {
    $colmax = 7;
    $colindex = 0;
    
    $buff = '<table class="keywordlist">';
    foreach ($photolist as $photo) {
      if (is_object($photo)) {
        if ($colindex == 0) {
          $buff .= '<tr>';
        }
        $buff .= '<td align="center" valign="middle">';
        $buff .= okinawaUtil::getThumbnailTagSlim($photo);
        $buff .= '</td>';
        if ($colindex == $colmax - 1) {
          $buff .= '</tr>';
        }
        
        $colindex++;
        $colindex %= $colmax;
      }
    }
    
    if ($colindex) {
      for (; $colindex < $colmax; $colindex++) {
        $buff .= '<td></td>';
      }
      $buff .= '</tr>';
    }
    $buff .= '</table>';
    
    echo $buff;
  }
}

function print_taglist($photo)
{
  if (is_object($photo)) {
    $taglist = okinawaUtil::getTagList($photo);
    $buff = '';
    for ($i = 0; $i < sizeof($taglist); $i++)
    {
      $tag = $taglist[$i];
      if ($i)
      {
        $buff .= '&nbsp;';
      }
      $buff .= $tag->getTitle();
    }
    
    echo $buff;
  }
}

function shot_date($photo)
{
  if (is_object($photo)) {
    $buff = substr($photo->getShotDate(), 0, strlen('YYYY-MM-DD HH:MM'));
    echo $buff;
  }
}

function shot_date_english($photo)
{
  if (is_object($photo)) {
    $tmp = null;
    if (preg_match('/^(\d{4})\-(\d{2})\-(\d{2})/', $photo->getShotDate(), $tmp)) {
      $year = (int)$tmp[1];
      $month = (int)$tmp[2];
      $mday = (int)$tmp[3];
      
      echo sprintf('%04d-%02d-%02d', $year, $month, $mday);
    }
  }
}

function shot_date_short($photo)
{
  if (is_object($photo)) {
    $tmp = null;
    if (preg_match('/^(\d{4})\-(\d{2})\-(\d{2})/', $photo->getShotDate(), $tmp)) {
      $year = (int)$tmp[1];
      $month = (int)$tmp[2];
      $mday = (int)$tmp[3];
      
      echo $year . '年' . $month . '月' . $mday . '日';
    }
  }
}

function suburb_photos($list) {
  $ret = '';
  
  foreach ($list as $photo) {
    $ret .= '<a href="' . okinawaUtil::getPhotoLinkUrl($photo) . '">';
    $ret .= $photo->getTitle() . '</a><br />';
  }
  
  return $ret;
}

function wallpaper_tag($photo, $width, $height) {
  $ret = '';
  
  $ret .= '<img src="' . wallpaper_url($photo, $width, $height) . '"';
  $ret .= ' alt="' . $photo->getTitle() . '">';
  
  return $ret;
}

function wallpaper_url($photo, $width, $height) {
  $ret = '';
  
  $ret .= '/wallphoto/' . $photo->getId() . "_$width" . "x$height.jpg";
  
  return $ret;
}

function wander_url($photo) {
  $ret = '';
  
  $ret .= '/wander400/' . $photo->getFilename();
  
  return $ret;
}

?>