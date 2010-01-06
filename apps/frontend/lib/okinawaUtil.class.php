<?php

class okinawaUtil
{
  /**
   * 文字列を受け取ってタグIDを返す。なければタグを追加する。
   * @param $tagstr タグ文字列
   * @return タグID
   */
  public static function addTag($tagstr)
  {
    $c = new Criteria();
    $c->add(TagPeer::TITLE, $tagstr);
    $result = TagPeer::doSelectOne($c);
    
    if (is_object($result))
    {
      return $result->getId();
    }
    
    // 追加
    $c = new Criteria();
    $c->add(TagPeer::TITLE, $tagstr);
    TagPeer::doInsert($c);
    
    // ID取得
    $c = new Criteria();
    $c->add(TagPeer::TITLE, $tagstr);
    $result = TagPeer::doSelectOne($c);
    if (is_object($result))
    {
      return $result->getId();
    }
    
    return null;
  }
  
  /**
   * photoとtagの関連を削除、参照されないtagならばtagマスタからも削除
   */
  public static function deletePhotoAndTag($photoid, $tagid)
  {
    // tagidを含むオブジェクトを取得
    $c = new Criteria();
    $c->add(PhotoAndTagPeer::TAG_ID, $tagid);
    $c->add(PhotoAndTagPeer::OPEN_FLAG, 1);
    $result = PhotoAndTagPeer::doSelect($c);
    
    foreach ($result as $obj)
    {
      if ($obj->getPhotoId() == $photoid)
      {
        $obj->delete();
      }
    }
    
    if (sizeof($result) === 1)
    {
      $c = new Criteria();
      $c->add(TagPeer::ID, $tagid);
      TagPeer::doDelete($c);
    }
  }
  
  /**
   * 拡張子をpngにする
   */
  public static function extPng($filename)
  {
    $tmp = explode('.', $filename);
    $tmp[sizeof($tmp) - 1] = 'png';
    
    return join('.', $tmp);
  }
  
  /**
   * アイコンの画像URLを取得する
   */
  public static function getIconUrl($photo)
  {
    $ret = '';
    
    if (is_object($photo))
    {
      $ret = sfConfig::get('app_icon_url') . okinawaUtil::extPng($photo->getFilename());
    }
    
    return $ret;
  }
  
  /**
   * 別の写真へのリンク
   */
  public static function getPhotoLinkUrl($photo)
  {
    $ret = '';

    if (is_object($photo))
    {
      $ret = url_for('/photo/show?id=' . $photo->getId(), true);
    }
    
    return $ret;
  }
  
  /**
   * 関連するPhotoの配列を取得する
   * 
   * @param $photo Photoオブジェクト
   * @return Photoオブジェクトの配列
   */
  public static function getRelatedPhotoList($photo, $keywordid)
  {
    $ret = array();

    if (is_object($photo))
    {
      $c = new Criteria();
      $c->add(PhotoAndTagPeer::PHOTO_ID, $photo->getId(), Criteria::EQUAL);
      $c->add(PhotoAndTagPeer::OPEN_FLAG, 1);
      $result = PhotoAndTagPeer::doSelect($c);
      
      $taglist = array();
      foreach ($result as $photoandtag)
      {
        array_push($taglist, $photoandtag->getTagId());
      }
      
      // キーワード
      foreach ($taglist as $id) {
        if ($id === $keywordid) {
          $taglist = array($id);
          break;
        }
      }
      
      $c = new Criteria();
      $c->add(PhotoAndTagPeer::TAG_ID, $taglist, Criteria::IN);
      $c->add(PhotoAndTagPeer::PHOTO_ID, $photo->getId(), Criteria::NOT_EQUAL);
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
      $ret = PhotoPeer::doSelect($c);
    }
    
    if (sizeof($ret) > 5) {
      $tmp = $ret;
      $ret = array();
      for ($i = 0; $i < 1500; $i++) {
        $i1 = mt_rand(0, sizeof($tmp) - 1);
        $i2 = mt_rand(0, sizeof($tmp) - 1);
        $tmp2 = $tmp[$i1];
        $tmp[$i1] = $tmp[$i2];
        $tmp[$i2] = $tmp2;
      }
      for ($i = 0; $i < 5; $i++) {
        array_push($ret, $tmp[$i]);
      }
    }
    
    return $ret;
  }

  /**
   * Photoに関連するTagの配列を取得する
   * 
   * @param $photo Photoオブジェクト
   * @return Tagオブジェクトの配列
   */
  public static function getTagList($photo)
  {
    $ret = array();

    if (is_object($photo))
    {
      $c = new Criteria();
      $c->add(PhotoAndTagPeer::PHOTO_ID, $photo->getId(), Criteria::EQUAL);
      $result = PhotoAndTagPeer::doSelect($c);
      
      $taglist = array();
      foreach ($result as $photoandtag)
      {
        array_push($taglist, $photoandtag->getTagId());
      }
      
      if (sizeof($taglist)) {
        $c = new Criteria();
        $c->add(TagPeer::ID, $taglist, Criteria::IN);
        $c->addDescendingOrderByColumn(TagPeer::ORDER_PRIORITY);
        $c->addAscendingOrderByColumn(TagPeer::ID);
        $ret = TagPeer::doSelect($c);
      }
    }
    
    return $ret;
  }
  
  /**
   * Photoオブジェクトからサムネイルimgタグを返す
   * 
   * @param $photo Photoオブジェクト
   * @return HTML文字列
   */
  public static function getThumbnailTag($photo)
  {
    $ret = '';
    
    if (is_object($photo)) {
      $ret = '<img';
      $ret .= ' src="' . $photo->getPhotoUrl() . '"';
      $ret .= ' width="' . $photo->getThumbWidth() . '"';
      $ret .= ' height="' . $photo->getThumbHeight() . '"';
      $ret .= ' alt="' . preg_replace('/[\r\n]/', '', $photo->getTitle()) . '"';
      $ret .= ' />';
    }
    
    return $ret;
  }
  
  /**
   * Photoオブジェクトからサムネイルimgタグを返す
   * 
   * @param $photo Photoオブジェクト
   * @return HTML文字列
   */
  public static function getThumbnailTagSlim($photo)
  {
    $ret = '';
    
    if (is_object($photo)) {
      $ret = '<a href="' . okinawaUtil::getPhotoLinkUrl($photo) . '">';
      $ret .= '<img src="' . okinawaUtil::getThumbUrl($photo) . '"';
      $ret .= ' width="' . $photo->getThumbWidth() . '"';
      $ret .= ' height="' . $photo->getThumbHeight() . '"';
      $ret .= ' alt="' . preg_replace('/[\r\n]/', '', $photo->getTitle()) . '"';
      $ret .= ' /></a>';
    }
    
    return $ret;
  }
  
  /**
   * サムネイル画像URLを取得する
   */
  public static function getThumbUrl($photo)
  {
    $ret = '';
    
    if (is_object($photo))
    {
      $ret = sfConfig::get('app_thumb_url') . $photo->getFilename();
    }
    
    return $ret;
  }
  
  public static function listAlbum($xmltext, &$tagHash)
  {
    $ret = array();
    
    // <key>List of Keywords</key>と
    // <key>Major Version</key>の間を抜き出す
    $pos1 = mb_strpos($xmltext, '<key>List of Keywords</key>', 0, 'UTF8') + strlen('<key>List of Keywords</key>');
    $pos2 = mb_strpos($xmltext, '<key>Major Version</key>', 0, 'UTF8');
    $tagChunk = '<?xml version="1.0" encoding="UTF-8"?>'  . "\n";
    $tagChunk .= '<plist version="1.0">' . "\n";
    $tagChunk .= mb_substr($xmltext, $pos1, $pos2 - $pos1, 'UTF8');
    $tagChunk .= '</plist>';
    
    if (! (is_numeric($pos1) && $pos1 &&
    is_numeric($pos2) && $pos2)) {
      return 'AlbumData.xmlとして解釈できませんでした。';
    }
    
    // <key>Application Version</key> と
    // <key>Master Image List</key> の間を削除
    $pos1 = mb_strpos($xmltext, '<key>Application Version</key>', 0, 'UTF8');
    $pos2 = mb_strpos($xmltext, '<key>Master Image List</key>', 0, 'UTF8') + strlen('<key>Master Image List</key>');
    $chunk1 = mb_substr($xmltext, 0, $pos1, 'UTF8');
    $chunk2 = mb_substr($xmltext, $pos2, mb_strlen($xmltext, 'UTF8'), 'UTF8');
    $xmltext = $chunk1 . $chunk2;
    
    $chunk = null;
    $chunk2 = null;
    
    if (! (is_numeric($pos1) && $pos1 &&
    is_numeric($pos2) && $pos2 &&
    mb_strlen($xmltext, 'UTF8'))) {
      return 'AlbumData.xmlとして解釈できませんでした。';
    }
    
    // タグのXMLオブジェクト
    $tagxml = new SimpleXMLElement($tagChunk);
    
    $tagChunk = null;
    
    // タグキーと文字列
    $tagKeyList = $tagxml->dict[0]->key;
    $tagWordList = $tagxml->dict[0]->string;
    $tagHash = array();
    for ($i = 0; $i < sizeof($tagKeyList); $i++) {
      if (((string)$tagWordList[$i]) == '_Favorite_') {
        continue;
      }
      $tagHash[(string)$tagKeyList[$i]] = (string)$tagWordList[$i];
    }
    
    // SimpleXMLでパーズ
    $xml = new SimpleXMLElement($xmltext);
    
    $xmltext = null;
    
    // 画像オブジェクトの配列
    $ret = $xml->dict[0]->dict[0]->dict;
    
    return $ret;
  }
  
  public static function procAlbum($img, &$tagHash)
  {
    $mediatype = (string)$img->string[0];
    $caption = preg_replace('/[\r\n]/', '', $img->string[1]);
    $comment = preg_replace('/[\r\n]/', '', $img->string[2]);
    $imagepath = (string)$img->string[3];
    $originalpath = (string)$img->string[4];
    $thumbpath = (string)$img->string[5];
    $aspectratio = (real)$img->real[0];
    $dateastimerinterval = (real)$img->real[1];
    $moddateastimerinterval = (real)$img->real[2];
    $metamodtateastimerinterval = (real)$img->real[3];
    $keywords = $img->array[0];
    
    $keywordlist = array();
    if (is_array($keywords) || is_object($keywords)) {
      foreach ($keywords as $keyid)
      {
        $keyid = (string)$keyid;
        if (isset($tagHash[$keyid]))
        {
          array_push($keywordlist, $tagHash[$keyid]);
        }
      }
    }
    
    // 画像でなければスキップ
    if (strtolower($mediatype) !== 'image')
    {
      return 'skip (画像ではない)';
    }
    
    // ファイルがアップロードされていなければスキップ
    $tmp = null;
    $filename = '';
    if (preg_match('/\/([\w\.]+\.(jpg|JPG))/u', $imagepath, $tmp))
    {
      $filename = $tmp[1];
    }
    if (! strlen($filename))
    {
      return 'skip (ファイル名が解決できない)';
    }
    $filepath = sfConfig::get('app_path_upload') . $filename;
    if (! file_exists($filepath))
    {
      $filename = substr($filename, 0, strlen($filename) - 3) . 'jpg';
      $filepath = substr($filepath, 0, strlen($filepath) - 3) . 'jpg';
      if (! file_exists($filepath))
      {
        return 'skip (ファイルがアップロードされていない) ' . $filename;
      }
    }
    
    // 日付の作成
    $shot_date = strftime('%Y-%m-%d %H:%M:%S', mktime(9, 0, (int)$dateastimerinterval, 1, 1, 2001));
    $modified_date = strftime('%Y-%m-%d %H:%M:%S', mktime(9, 0, (int)$moddateastimerinterval, 1, 1, 2001));
    $metamodified_date = strftime('%Y-%m-%d %H:%M:%S', mktime(9, 0, (int)$metamodtateastimerinterval, 1, 1, 2001));
    $file_mtime = strftime('%Y-%m-%d %H:%M:%S', filemtime($filepath));
    
    // オブジェクトの読み込み
    $c = new Criteria();
    $c->add(PhotoPeer::FILENAME, $filename);
    $obj = PhotoPeer::doSelectOne($c);
    
    $mainPath = sfConfig::get('app_path_photo') . $filename;
    $thumbPath = sfConfig::get('app_path_thumb') . $filename;
    $iconPath = sfConfig::get('app_path_icon') . okinawaUtil::extPng($filename);
    
    // 変更がなければスキップ
    if (is_object($obj) &&
    (
    $obj->getModifiedDate() == $modified_date &&
    $obj->getMetamodifiedDate() == $metamodified_date &&
    $obj->getFilemtime() == $file_mtime
    ))
    {
      if (file_exists($mainPath) &&
      file_exists($thumbPath) &&
      file_exists($iconPath)) {
        
        // タグ変更
        //okinawaUtil::setTagList($obj->getId(), $keywordlist);
        return 'skip (変更なし)';
      }
    }
    
    // タイトルチェック
    $c = new Criteria();
    $c->add(PhotoPeer::TITLE, $caption);
    $objlist = PhotoPeer::doSelect($c);
    if (sizeof($objlist) >= 2) {
      return '<span style="color:#ff0000;">error (タイトル「' . $caption . '」はすでに使われています)</span>';
    }
    else if (sizeof($objlist) == 1) {
      if (is_object($obj)) {
        $obj2 = $objlist[0];
        if ($obj2->getId() != $obj->getId()) {
          return '<span style="color:#ff0000;">error (タイトル「' . $caption . '」はすでに使われています)</span>';
        }
      }
      else {
        return '<span style="color:#ff0000;">error (タイトル「' . $caption . '」はすでに使われています)</span>';
      }
    }
    
    // ファイルの読み込み
    $imgSrc = imagecreatefromjpeg($filepath);
    if (! is_resource($imgSrc)) {
      return '<span style="color:#ff0000;">error (' . $filename . 'をJPEG画像として読み込めませんでした。ファイルが壊れている可能性があります)</span>';
    }
    $srcWidth = imagesx($imgSrc);
    $srcHeight = imagesy($imgSrc);
    
    /// 影パーツの読み込み
    $imgFrameBL = imagecreatefrompng(sfConfig::get('app_path_shadow') . 'frame_bl.png');
    $imgFrameB = imagecreatefrompng(sfConfig::get('app_path_shadow') . 'frame_b.png');
    $imgFrameBR = imagecreatefrompng(sfConfig::get('app_path_shadow') . 'frame_br.png');
    $imgFrameTR = imagecreatefrompng(sfConfig::get('app_path_shadow') . 'frame_tr.png');
    $imgFrameR = imagecreatefrompng(sfConfig::get('app_path_shadow') . 'frame_r.png');
    
    // メイン表示用画像の生成
    /// 解像度
    if ($aspectratio == 1.5)
    {
      $mainWidth = sfConfig::get('app_photo_width');
      $mainHeight = sfConfig::get('app_photo_height');
    }
    else if ($aspectratio > 1.5)
    {
      $mainWidth = sfConfig::get('app_photo_width');
      $mainHeight = (int)$srcHeight * sfConfig::get('app_photo_width') / $srcWidth; 
    }
    else {
      $mainWidth = (int)$srcWidth * sfConfig::get('app_photo_height') / $srcHeight;
      $mainHeight = sfConfig::get('app_photo_height');
    }
    
    /// 生成
    $imgMain = imagecreatetruecolor($mainWidth + 10, $mainHeight + 10);
    imagecopyresampled($imgMain, $imgSrc, 0, 0, 0, 0, $mainWidth, $mainHeight, $srcWidth, $srcHeight);
    
    /// 影パーツの書き込み
    imagecopyresampled($imgMain, $imgFrameBL, 0, $mainHeight, 0, 0, 40, 10, 40, 10);
    imagecopyresampled($imgMain, $imgFrameB, 40, $mainHeight, 0, 0, $mainWidth - 40, 10, 10, 10);
    imagecopyresampled($imgMain, $imgFrameBR, $mainWidth, $mainHeight, 0, 0, 10, 10, 10, 10);
    imagecopyresampled($imgMain, $imgFrameTR, $mainWidth, 0, 0, 0, 10, 40, 10, 40);
    imagecopyresampled($imgMain, $imgFrameR, $mainWidth, 40, 0, 0, 10, $mainHeight - 40, 10, 10);
    
    /// 保存
    if (! imagejpeg($imgMain, $mainPath, sfConfig::get('app_quality_photo')))
    {
      return '<span style="color:#ff0000;">error (' . $filename . 'の画像保存に失敗)</span>';
    }
    
    imagedestroy($imgMain);
    
    // さまよって遊ぶ用画像の生成
    /// 解像度
    if ($aspectratio == 1.5)
    {
      $wanderWidth = sfConfig::get('app_wander_width');
      $wanderHeight = sfConfig::get('app_wander_height');
    }
    else if ($aspectratio > 1.5)
    {
      $wanderWidth = sfConfig::get('app_wander_width');
      $wanderHeight = (int)$srcHeight * sfConfig::get('app_wander_width') / $srcWidth; 
    }
    else {
      $wanderWidth = (int)$srcWidth * sfConfig::get('app_wander_height') / $srcHeight;
      $wanderHeight = sfConfig::get('app_wander_height');
    }
    
    /*
    /// 生成
    $imgWander = imagecreatetruecolor($wanderWidth + 10, $wanderHeight + 10);
    imagecopyresampled($imgWander, $imgSrc, 0, 0, 0, 0, $wanderWidth, $wanderHeight, $srcWidth, $srcHeight);
    
    /// 影パーツの書き込み
    imagecopyresampled($imgWander, $imgFrameBL, 0, $wanderHeight, 0, 0, 40, 10, 40, 10);
    imagecopyresampled($imgWander, $imgFrameB, 40, $wanderHeight, 0, 0, $wanderWidth - 40, 10, 10, 10);
    imagecopyresampled($imgWander, $imgFrameBR, $wanderWidth, $wanderHeight, 0, 0, 10, 10, 10, 10);
    imagecopyresampled($imgWander, $imgFrameTR, $wanderWidth, 0, 0, 0, 10, 40, 10, 40);
    imagecopyresampled($imgWander, $imgFrameR, $wanderWidth, 40, 0, 0, 10, $wanderHeight - 40, 10, 10);

    /// 保存
    $wanderPath = sfConfig::get('app_path_wander') . $filename;
    if (! imagejpeg($imgWander, $wanderPath, sfConfig::get('app_quality_wander')))
    {
      $ret .= $filename . 'のさまよって遊ぶ画像の保存に失敗しました。<br />';
      continue;
    }
    */
    
    // サムネイル用画像の生成
    /// 解像度
    if ($aspectratio == 1.5)
    {
      $thumbWidth = sfConfig::get('app_thumb_width');
      $thumbHeight = sfConfig::get('app_thumb_height');
    }
    else if ($aspectratio > 1.5)
    {
      $thumbWidth = sfConfig::get('app_thumb_width');
      $thumbHeight = (int)$srcHeight * sfConfig::get('app_thumb_width') / $srcWidth; 
    }
    else {
      $thumbWidth = (int)$srcWidth * sfConfig::get('app_thumb_height') / $srcHeight;
      $thumbHeight = sfConfig::get('app_thumb_height');
    }
    
    /// 生成
    $imgThumb = imagecreatetruecolor($thumbWidth, $thumbHeight);
    imagecopyresampled($imgThumb, $imgSrc, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $srcWidth, $srcHeight);

    /// 保存
    if (! imagejpeg($imgThumb, $thumbPath, sfConfig::get('app_quality_thumb')))
    {
      return '<span style="color:#ff0000;">error (' . $filename . 'のサムネイル保存に失敗)</span>';
    }
    
    // アイコン用画像の生成
    /// 解像度
    if ($aspectratio == 1.5)
    {
      $iconWidth = sfConfig::get('app_icon_width');
      $iconHeight = sfConfig::get('app_icon_height');
    }
    else if ($aspectratio > 1.5)
    {
      $iconWidth = sfConfig::get('app_icon_width');
      $iconHeight = (int)$srcHeight * sfConfig::get('app_icon_width') / $srcWidth; 
    }
    else {
      $iconWidth = (int)$srcWidth * sfConfig::get('app_icon_height') / $srcHeight;
      $iconHeight = sfConfig::get('app_icon_height');
    }
    
    /// 生成
    $imgIcon = imagecreatetruecolor($iconWidth, $iconHeight);
    imagecopyresampled($imgIcon, $imgThumb, 0, 0, 0, 0, $iconWidth, $iconHeight, $thumbWidth, $thumbHeight);

    /// 保存
    if (! imagepng($imgIcon, $iconPath))
    {
      return '<span style="color:#ff0000;">error (' . $filename . 'のアイコン保存に失敗)</span>';
    }
    
    //imagedestroy($imgWander);
    imagedestroy($imgThumb);
    imagedestroy($imgIcon);
    imagedestroy($imgSrc);
    
    // DB更新
    if (is_null($obj))
    {
      // insert
      $c = new Criteria();
      $c->add(PhotoPeer::TITLE, $caption);
      $c->add(PhotoPeer::FILENAME, $filename);
      if (mb_strlen($comment, 'UTF8'))
      {
        $c->add(PhotoPeer::COMMENT, $comment);
      }
      $c->add(PhotoPeer::WIDTH, $mainWidth + 10);
      $c->add(PhotoPeer::HEIGHT, $mainHeight + 10);
      $c->add(PhotoPeer::THUMB_WIDTH, $thumbWidth);
      $c->add(PhotoPeer::THUMB_HEIGHT, $thumbHeight);
      $c->add(PhotoPeer::ICON_WIDTH, $iconWidth);
      $c->add(PhotoPeer::ICON_HEIGHT, $iconHeight);
      $c->add(PhotoPeer::WANDER_WIDTH, $wanderWidth + 10);
      $c->add(PhotoPeer::WANDER_HEIGHT, $wanderHeight + 10);
      $c->add(PhotoPeer::SHOT_DATE, $shot_date);
      $c->add(PhotoPeer::MODIFIED_DATE, $modified_date);
      $c->add(PhotoPeer::METAMODIFIED_DATE, $metamodified_date);
      $c->add(PhotoPeer::FILEMTIME, $file_mtime);
      PhotoPeer::doInsert($c);
      
      // オブジェクト取得
      $c = new Criteria();
      $c->add(PhotoPeer::FILENAME, $filename);
      $obj = PhotoPeer::doSelectOne($c);
    }
    else
    {
      // update
      $obj->setTitle($caption);
      if (mb_strlen($comment, 'UTF8'))
      {
        $obj->setComment($comment);
      }
      $obj->setWidth($mainWidth + 10);
      $obj->setHeight($mainHeight + 10);
      $obj->setThumbWidth($thumbWidth);
      $obj->setThumbHeight($thumbHeight);
      $obj->setIconWidth($iconWidth);
      $obj->setIconHeight($iconHeight);
      $obj->setWanderWidth($wanderWidth + 10);
      $obj->setWanderHeight($wanderHeight + 10);
      $obj->setModifiedDate($modified_date);
      $obj->setMetamodifiedDate($metamodified_date);
      $obj->setFilemtime($file_mtime);
      $obj->save();
    }
    
    // タグ追加
    okinawaUtil::setTagList($obj->getId(), $keywordlist);
    
    imagedestroy($imgFrameB);
    imagedestroy($imgFrameBL);
    imagedestroy($imgFrameBR);
    imagedestroy($imgFrameR);
    imagedestroy($imgFrameTR);
    
    return 'ok';
  }
  
  public static function refreshImages($photos) {
    
    foreach ($photos as $photo) {
      
      $filename = $photo->getFilename();
      
      $filepath = sfConfig::get('app_path_upload') . $filename;

      $mainPath = sfConfig::get('app_path_photo') . $filename;
      $slidePath = sfConfig::get('app_path_slide') . $filename;
      $thumbPath = sfConfig::get('app_path_thumb') . $filename;
      $iconPath = sfConfig::get('app_path_icon') . okinawaUtil::extPng($filename);      
      $aspectratio = $photo->getWidth() / $photo->getHeight();
      
      // ファイルの読み込み
      $imgSrc = imagecreatefromjpeg($filepath);
      if (! is_resource($imgSrc)) {
        return '<span style="color:#ff0000;">error (' . $filename . 'をJPEG画像として読み込めませんでした。ファイルが壊れている可能性があります)</span>';
      }
      $srcWidth = imagesx($imgSrc);
      $srcHeight = imagesy($imgSrc);
      
      /// 影パーツの読み込み
      $imgFrameBL = imagecreatefrompng(sfConfig::get('app_path_shadow') . 'frame_bl.png');
      $imgFrameB = imagecreatefrompng(sfConfig::get('app_path_shadow') . 'frame_b.png');
      $imgFrameBR = imagecreatefrompng(sfConfig::get('app_path_shadow') . 'frame_br.png');
      $imgFrameTR = imagecreatefrompng(sfConfig::get('app_path_shadow') . 'frame_tr.png');
      $imgFrameR = imagecreatefrompng(sfConfig::get('app_path_shadow') . 'frame_r.png');
      
      /*
      // メイン表示用画像の生成
      /// 解像度
      if ($aspectratio == 1.5)
      {
        $mainWidth = sfConfig::get('app_photo_width');
        $mainHeight = sfConfig::get('app_photo_height');
      }
      else if ($aspectratio > 1.5)
      {
        $mainWidth = sfConfig::get('app_photo_width');
        $mainHeight = (int)$srcHeight * sfConfig::get('app_photo_width') / $srcWidth; 
      }
      else {
        $mainWidth = (int)$srcWidth * sfConfig::get('app_photo_height') / $srcHeight;
        $mainHeight = sfConfig::get('app_photo_height');
      }
      
      /// 生成
      $imgMain = imagecreatetruecolor($mainWidth + 10, $mainHeight + 10);
      imagecopyresampled($imgMain, $imgSrc, 0, 0, 0, 0, $mainWidth, $mainHeight, $srcWidth, $srcHeight);
      
      /// 影パーツの書き込み
      imagecopyresampled($imgMain, $imgFrameBL, 0, $mainHeight, 0, 0, 40, 10, 40, 10);
      imagecopyresampled($imgMain, $imgFrameB, 40, $mainHeight, 0, 0, $mainWidth - 40, 10, 10, 10);
      imagecopyresampled($imgMain, $imgFrameBR, $mainWidth, $mainHeight, 0, 0, 10, 10, 10, 10);
      imagecopyresampled($imgMain, $imgFrameTR, $mainWidth, 0, 0, 0, 10, 40, 10, 40);
      imagecopyresampled($imgMain, $imgFrameR, $mainWidth, 40, 0, 0, 10, $mainHeight - 40, 10, 10);
      
      /// 保存
      if (! imagejpeg($imgMain, $mainPath, sfConfig::get('app_quality_photo')))
      {
        return '<span style="color:#ff0000;">error (' . $filename . 'の画像保存に失敗)</span>';
      }
      
      imagedestroy($imgMain);
      */
      
      // スライド画像の生成
      /// 解像度
      if ($aspectratio == 1.5)
      {
        $slideWidth = sfConfig::get('app_slide_width');
        $slideHeight = sfConfig::get('app_slide_height');
      }
      else if ($aspectratio > 1.5)
      {
        $slideWidth = sfConfig::get('app_slide_width');
        $slideHeight = (int)$srcHeight * sfConfig::get('app_slide_width') / $srcWidth; 
      }
      else {
        $slideWidth = (int)$srcWidth * sfConfig::get('app_slide_height') / $srcHeight;
        $slideHeight = sfConfig::get('app_slide_height');
      }
      
      /// 生成
      $imgSlide = imagecreatetruecolor($slideWidth, $slideHeight);
      imagecopyresampled($imgSlide, $imgSrc, 0, 0, 0, 0, $slideWidth, $slideHeight, $srcWidth, $srcHeight);
      
      /// 保存
      if (! imagejpeg($imgSlide, $slidePath, sfConfig::get('app_quality_slide')))
      {
        $ret .= $filename . 'のさまよって遊ぶ画像の保存に失敗しました。<br />';
        continue;
      }
      /*
      // サムネイル用画像の生成
      /// 解像度
      if ($aspectratio == 1.5)
      {
        $thumbWidth = sfConfig::get('app_thumb_width');
        $thumbHeight = sfConfig::get('app_thumb_height');
      }
      else if ($aspectratio > 1.5)
      {
        $thumbWidth = sfConfig::get('app_thumb_width');
        $thumbHeight = (int)$srcHeight * sfConfig::get('app_thumb_width') / $srcWidth; 
      }
      else {
        $thumbWidth = (int)$srcWidth * sfConfig::get('app_thumb_height') / $srcHeight;
        $thumbHeight = sfConfig::get('app_thumb_height');
      }
      
      /// 生成
      $imgThumb = imagecreatetruecolor($thumbWidth, $thumbHeight);
      imagecopyresampled($imgThumb, $imgSrc, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $srcWidth, $srcHeight);
  
      /// 保存
      if (! imagejpeg($imgThumb, $thumbPath, sfConfig::get('app_quality_thumb')))
      {
        return '<span style="color:#ff0000;">error (' . $filename . 'のサムネイル保存に失敗)</span>';
      }
      
      // アイコン用画像の生成
      /// 解像度
      if ($aspectratio == 1.5)
      {
        $iconWidth = sfConfig::get('app_icon_width');
        $iconHeight = sfConfig::get('app_icon_height');
      }
      else if ($aspectratio > 1.5)
      {
        $iconWidth = sfConfig::get('app_icon_width');
        $iconHeight = (int)$srcHeight * sfConfig::get('app_icon_width') / $srcWidth; 
      }
      else {
        $iconWidth = (int)$srcWidth * sfConfig::get('app_icon_height') / $srcHeight;
        $iconHeight = sfConfig::get('app_icon_height');
      }
      
      /// 生成
      $imgIcon = imagecreatetruecolor($iconWidth, $iconHeight);
      imagecopyresampled($imgIcon, $imgThumb, 0, 0, 0, 0, $iconWidth, $iconHeight, $thumbWidth, $thumbHeight);
  
      /// 保存
      if (! imagepng($imgIcon, $iconPath))
      {
        return '<span style="color:#ff0000;">error (' . $filename . 'のアイコン保存に失敗)</span>';
      }
      */
      $photo->setSlideWidth($slideWidth);
      $photo->setSlideHeight($slideHeight);
      $photo->save();
      
      imagedestroy($imgSlide);
      //imagedestroy($imgThumb);
      //imagedestroy($imgIcon);
      imagedestroy($imgSrc);
    }
  }
  
  public static function setTagList($photoid, &$taglist)
  {
   
    // 既存のタグID
    $c = new Criteria();
    $c->add(PhotoAndTagPeer::PHOTO_ID, $photoid, Criteria::EQUAL);
    $result = PhotoAndTagPeer::doSelect($c);
    
    $oldidlist = array();
    foreach ($result as $photoandtag)
    {
      array_push($oldidlist, $photoandtag->getTagId());
    }
    
    $result = null;
    
    // ID問い合わせ
    $newidlist = array();
    foreach ($taglist as $tagstr)
    {
      array_push($newidlist, okinawaUtil::addTag($tagstr));
    }
    
    // 減った分を削除
    $deletelist = array_diff($oldidlist, $newidlist);
    foreach ($deletelist as $deleteid)
    {
      okinawaUtil::deletePhotoAndTag($photoid, $deleteid);
    }
    
    // 増えた分を追加
    $addlist = array_diff($newidlist, $oldidlist);
    $newidlist = null;
    $oldidlist = null;
    foreach ($addlist as $addid)
    {
      $c = new Criteria();
      $c->add(PhotoAndTagPeer::PHOTO_ID, $photoid);
      $c->add(PhotoAndTagPeer::TAG_ID, $addid);
      PhotoAndTagPeer::doInsert($c);
    }
    $addlist = null;
  }
}
