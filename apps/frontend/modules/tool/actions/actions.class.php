<?php

/**
 * tool actions.
 *
 * @package    okinawa
 * @subpackage tool
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class toolActions extends sfActions
{
  public function executeAddlink(sfWebRequest $request)
  {
    $linkstr = $this->getRequestParameter('linkstr');
    
    $c = new Criteria();
    $c->add(SeoLinkPeer::LINKSTR, $linkstr);
    $seo = SeoLinkPeer::doSelectOne($c);
    
    if (! is_object($seo)) {
      $c = new Criteria();
      $c->add(SeoLinkPeer::LINKSTR, $linkstr);
      SeoLinkPeer::doInsert($c);
    }
    
    $c = new Criteria();
    $c->add(SeoLinkPeer::LINKSTR, $linkstr);
    $seo = SeoLinkPeer::doSelectOne($c);
    
    $this->out = '';
    if (is_object($seo)) {
      $this->out = 'http://photo-okinawa.com/links/' . (int)($seo->getId() / 20);
    }
    
    return sfView::SUCCESS;
  }
  
  public function executeBlogphotodelete(sfWebRequest $request)
  {
    $photoid = $this->getRequestParameter('id');
    
    $c = new Criteria();
    $c->add(BlogPhotoPeer::PHOTO_ID, $photoid);
    BlogPhotoPeer::doDelete($c);
    
    return $this->redirect('tool/blogphotolist');
  }
  
  public function executeBlogphotoinput(sfWebRequest $request)
  {
    $photoid = $this->getRequestParameter('photoid');
    $photo = PhotoPeer::retrieveByPk($photoid);
    $mainPath = sfConfig::get('app_path_photo') . $photo->getFilename();
    $img = imagecreatefromjpeg($mainPath);
    if (imagesx($img) == 809 &&
    imagesy($img) == 543) {
      
      $c = new Criteria();
      $c->add(BlogPhotoPeer::PHOTO_ID, $photoid);
      BlogPhotoPeer::doInsert($c);
      
      return $this->redirect('tool/blogphotolist');
    }
    else {
      $this->message = '縦横比が正しくありません。';
      $this->blogphotos = BlogPhotoPeer::doSelect(new Criteria());
      $this->photos = array();
      foreach ($this->blogphotos as $bp) {
        array_push($this->photos, PhotoPeer::retrieveByPk($bp->getPhotoId()));
      }
      $this->setTemplate('blogphotolist');
    }
  }
  
  public function executeBlogphotolist(sfWebRequest $request)
  {
    $this->message = '';
    $this->blogphotos = BlogPhotoPeer::doSelect(new Criteria());
    $this->photos = array();
    foreach ($this->blogphotos as $bp) {
      array_push($this->photos, PhotoPeer::retrieveByPk($bp->getPhotoId()));
    }
  }
  
  public function executeDelete(sfWebRequest $request)
  {
    $photo = PhotoPeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($photo);
    
    // ファイルの削除
    $filename = $photo->getFilename();
    $filepath = sfConfig::get('app_path_upload') . $filename;
    unlink($filepath);
    $mainPath = sfConfig::get('app_path_photo') . $filename;
    unlink($mainPath);
    $thumbPath = sfConfig::get('app_path_thumb') . $filename;
    unlink($thumbPath);

    $photo->delete();
    
    $c = new Criteria();
    $c->add(PhotoAndTagPeer::PHOTO_ID, $this->getRequestParameter('id'));
    PhotoAndTagPeer::doDelete($c);

    return $this->redirect('tool/list');
  }
  
  public function executeInput(sfWebRequest $request)
  {
    $this->count = PhotoPeer::doCount(new Criteria());
    $c = new Criteria();
    $c->add(PhotoPeer::OPEN_DATE, null, Criteria::ISNOTNULL);
    $this->opencount = PhotoPeer::doCount($c);
    
    return sfView::SUCCESS;
  }
  
  public function executeKeywordedit(sfWebRequest $request)
  {
    $this->keyword = TagPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->keyword);
  }
  
  public function executeKeywordlist(sfWebRequest $request)
  {
    $c = new Criteria();
    $c->addDescendingOrderByColumn(TagPeer::ORDER_PRIORITY);
    $c->addAscendingOrderByColumn(TagPeer::ID);
    $this->keywords = TagPeer::doSelect($c);
  }
  
  public function executeKeywordupdate(sfWebRequest $request)
  {
    $keyword = TagPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($keyword);
    $keyword->setOrderPriority(((int)$this->getRequestParameter('orderpriority')));
    $keyword->setDescription(trim($this->getRequestParameter('description')));
    $keyword->setEnglishtitle(trim($this->getRequestParameter('englishtitle')));
    $keyword->save();

    $this->redirect('tool/keywordlist');
  }

  public function executeLackcomment(sfWebRequest $request)
  {
    $list = PhotoPeer::doSelect(new Criteria());
    $this->photos = array();
    foreach ($list as $record) {
      $comment = trim($record->getComment());
      if (! strlen($comment)) {
        array_push($this->photos, $record);
      }
    }
    
    $this->setTemplate('list');
  }
  
  public function executeLackmap(sfWebRequest $request)
  {
    $c = new Criteria();
    $list = PhotoPeer::doSelect($c);
    $this->photos = array();
    foreach ($list as $obj) {
      if (! $obj->isMapOK()) {
        array_push($this->photos, $obj);
      }
    }
    
    $this->setTemplate('list');
  }
  
  public function executeLacktag(sfWebRequest $request)
  {
    // PhotoAndTagから全てのPhotoIDを抜く
    $photoandtaglist = PhotoAndTagPeer::doSelect(new Criteria());
    $taggedlist = array();
    foreach ($photoandtaglist as $obj)
    {
      array_push($taggedlist, $obj->getPhotoId());
    }
    $taggedlist = array_unique($taggedlist);
    
    // NOT IN で Photoから選択
    $c = new Criteria();
    $c->add(PhotoPeer::ID, $taggedlist, Criteria::NOT_IN);
    $this->photos = PhotoPeer::doSelect($c);
    $this->setTemplate('list');
  }
  
  public function executeLinkadd(sfWebRequest $request)
  {
    $url = $this->getRequestParameter('url');
    $title = $this->getRequestParameter('linktitle');
    //$description = $this->getRequestParameter('linkdescription');
    $category_id = $this->getRequestParameter('linkcategory');
    
    $c = new Criteria();
    $c->add(LinkPeer::URL, $url);
    $c->add(LinkPeer::TITLE, $title);
    //$c->add(LinkPeer::DESCRIPTION, $description);
    $c->add(LinkPeer::CATEGORY_ID, $category_id);
    $c->add(LinkPeer::INSERTED_AT, strftime('%Y-%m-%d'));
    LinkPeer::doInsert($c);
    
    $this->redirect('tool/linklist');
  }
  
  public function executeLinkcategoryadd(sfWebRequest $request)
  {
    $title = $this->getRequestParameter('categorytitle');
    $priority = $this->getRequestParameter('categorypriority');
    
    $c = new Criteria();
    $c->add(LinkCategoryPeer::TITLE, $title);
    $c->add(LinkCategoryPeer::ORDER_PRIORITY, $priority);
    LinkCategoryPeer::doInsert($c);
    
    $this->redirect('tool/linklist');
  }
  
  public function executeLinkcategorydelete(sfWebRequest $request)
  {
    $c = new Criteria();
    $c->add(LinkCategoryPeer::ID, $this->getRequestParameter('id'));
    LinkCategoryPeer::doDelete($c);
    
    $this->redirect('tool/linklist');
  }
  
  public function executeLinkcategoryedit(sfWebRequest $request)
  {
    $this->linkcategory = LinkCategoryPeer::retrieveByPk($this->getRequestParameter('id'));
    
    return sfView::SUCCESS;
  }
  
  public function executeLinkcategoryupdate(sfWebRequest $request)
  {
    $title = $this->getRequestParameter('title');
    $priority = $this->getRequestParameter('priority');
    
    $linkcategory = LinkCategoryPeer::retrieveByPk($this->getRequestParameter('id'));
    $linkcategory->setOrderPriority($priority);
    $linkcategory->setTitle($title);
    $linkcategory->save();
    
    $this->redirect('tool/linklist');
  }
  
  public function executeLinkdelete(sfWebRequest $request)
  {
    $c = new Criteria();
    $c->add(LinkPeer::ID, $this->getRequestParameter('id'));
    LinkPeer::doDelete($c);
    
    $this->redirect('tool/linklist');
  }
  
  public function executeLinkedit(sfWebRequest $request)
  {
    $this->obj = LinkPeer::retrieveByPk($this->getRequestParameter('id'));
    
    $c = new Criteria();
    $c->addDescendingOrderByColumn(LinkCategoryPeer::ORDER_PRIORITY);
    $this->category = LinkCategoryPeer::doSelect($c);
    
    return sfView::SUCCESS;
  }
  
  public function executeLinklist(sfWebRequest $request)
  {
    $c = new Criteria();
    $c->addDescendingOrderByColumn(LinkCategoryPeer::ORDER_PRIORITY);
    $this->category = LinkCategoryPeer::doSelect($c);
    
    $c = new Criteria();
    $c->addDescendingOrderByColumn(LinkPeer::INSERTED_AT);
    $this->linklist = LinkPeer::doSelect($c);
    
    return sfView::SUCCESS;
  }

  public function executeLinkupdate(sfWebRequest $request)
  {
    $url = $this->getRequestParameter('url');
    $title = $this->getRequestParameter('title');
    //$description = $this->getRequestParameter('description');
    $category_id = $this->getRequestParameter('category');
    
    $obj = LinkPeer::retrieveByPk($this->getRequestParameter('id'));
    $obj->setUrl($url);
    $obj->setTitle($title);
    //$obj->setDescription($description);
    $obj->setCategoryId($category_id);
    $obj->save();
    
    $this->redirect('tool/linklist');
  }
  
  public function executeList(sfWebRequest $request)
  {
    $this->photos = PhotoPeer::doSelect(new Criteria());
  }

  public function executeMapedit(sfWebRequest $request)
  {
    return sfView::SUCCESS;
  }
  
  public function executeMapthumbnail(sfWebRequest $request) {
    $this->photo = PhotoPeer::retrieveByPk($this->getRequestParameter('id'));
    
    return sfView::SUCCESS;
  }
  
  public function executePlace(sfWebRequest $request)
  {
    $longitude = $this->getRequestParameter('longitude');
    $latitude = $this->getRequestParameter('latitude');

    $photo = PhotoPeer::retrieveByPk((int)$this->getRequestParameter('id'));
    
    if (is_object($photo)) {
      $photo->setLongitude($longitude);
      $photo->setLatitude($latitude);
      if ($photo->save()) {
        $this->result = $photo->getTitle() . 'を更新しました。';
      }
      else {
        $this->result = $photo->getTitle() . 'で保存失敗。';
      }
    }
    else {
      $this->result = '存在しないIDです。';
    }
    
    return sfView::SUCCESS;
  }
  
  public function executeTopphotoedit(sfWebRequest $request)
  {
    $this->top = TopPeer::retrieveByPk($this->getRequestParameter('id'));
    
    return sfView::SUCCESS;
  }
  
  public function executeTopphotolist(sfWebRequest $request)
  {
    $tmp = TopPeer::doSelect(new Criteria());
    $this->topphoto = array();
    $this->list = array();
    foreach ($tmp as $obj) {
      $this->topphoto[$obj->getId()] = $obj;
      $this->list[$obj->getId()] = PhotoPeer::retrieveByPk($obj->getPhotoId());
    }
    
    return sfView::SUCCESS;
  }

  public function executeTopphotoupdate(sfWebRequest $request)
  {
    $top = TopPeer::retrieveByPk($this->getRequestParameter('id'));
    $photo_id = $this->getRequestParameter('photo_id');
    $text_color = $this->getRequestParameter('text_color');
    $link_color = $this->getRequestParameter('link_color');
    
    $top->setPhotoId($photo_id);
    $top->setTextColor($text_color);
    $top->setLinkColor($link_color);
    $top->save();
    
    $photo = PhotoPeer::retrieveByPk($photo_id);
    
    // 画像処理
    $filepath = sfConfig::get('app_path_upload') . $photo->getFilename();
    $imgSrc = imagecreatefromjpeg($filepath);
    if (! is_resource($imgSrc)) {
      exit;
    }
    $srcWidth = imagesx($imgSrc);
    $srcHeight = imagesy($imgSrc);
    
    /// 生成
    $imgTop = imagecreatetruecolor(910, 610);
    imagecopyresampled($imgTop, $imgSrc, 0, 0, 0, 0, 900, 600, $srcWidth, $srcHeight);
    
    /// 影パーツの読み込み
    $imgFrameBL = imagecreatefrompng(sfConfig::get('app_path_shadow') . 'frame_bl.png');
    $imgFrameB = imagecreatefrompng(sfConfig::get('app_path_shadow') . 'frame_b.png');
    $imgFrameBR = imagecreatefrompng(sfConfig::get('app_path_shadow') . 'frame_br.png');
    $imgFrameTR = imagecreatefrompng(sfConfig::get('app_path_shadow') . 'frame_tr.png');
    $imgFrameR = imagecreatefrompng(sfConfig::get('app_path_shadow') . 'frame_r.png');
    
    /// 影パーツの書き込み
    imagecopyresampled($imgTop, $imgFrameBL, 0, 600, 0, 0, 40, 10, 40, 10);
    imagecopyresampled($imgTop, $imgFrameB, 40, 600, 0, 0, 900 - 40, 10, 10, 10);
    imagecopyresampled($imgTop, $imgFrameBR, 900, 600, 0, 0, 10, 10, 10, 10);
    imagecopyresampled($imgTop, $imgFrameTR, 900, 0, 0, 0, 10, 40, 10, 40);
    imagecopyresampled($imgTop, $imgFrameR, 900, 40, 0, 0, 10, 600 - 40, 10, 10);
    
    /// 保存
    $mainPath = sfConfig::get('app_path_topbg') . $top->getId() . '.jpg';
    if (! imagejpeg($imgTop, $mainPath, sfConfig::get('app_quality_photo')))
    {
      exit;
    }
    
    imagedestroy($imgTop);
    
    $this->redirect('tool/topphotolist');
  }
  
  public function executeWalldelete(sfWebRequest $request)
  {
    $photoid = $this->getRequestParameter('id');
    
    $c = new Criteria();
    $c->add(WallPeer::PHOTO_ID, $photoid);
    WallPeer::doDelete($c);
    
    return $this->redirect('tool/walllist');
  }
  
  public function executeWallinput(sfWebRequest $request)
  {
    $photoid = $this->getRequestParameter('photoid');
    
    $c = new Criteria();
    $c->add(WallPeer::PHOTO_ID, $photoid);
    WallPeer::doInsert($c);
    
    $photo = PhotoPeer::retrieveByPk($photoid);
    $this->forward404Unless($photo);
    
    // 作成するサイズ
    $reso_list = array('320x240', '1024x768', '1280x800', '1280x1024', '1400x1050');
    
    foreach ($reso_list as $reso) {
      
      list($width, $height) = split('x', $reso);
      
      // 画像の保存パス
      $path = '/home/okinawa/web/wallphoto/' . $photoid . '_' . $width . 'x' . $height . '.jpg';
    
      $imgSrc = imagecreatefromjpeg($filepath = sfConfig::get('app_path_upload') . $photo->getFilename());
      $imgDst = imagecreatetruecolor($width, $height);
      
      if (is_resource($imgSrc) && is_resource($imgDst)) {
        $sw = imagesx($imgSrc);
        $sh = imagesy($imgSrc);
        
        $aspSrc = $sw * 1000 / $sh;
        $aspDst = $width * 1000 / $height;
        
        if ($aspSrc > $aspDst) {
          
          // 元のほうが横長
          $fw = $sh * $width / $height;
          $fh = $sh; 
        }
        else {
          
          // 元のほうが縦長
          $fh = $sw * $height / $width;
          $fw = $sw;
        }
        
        $sx = ($sw - $fw) / 2;
        $sy = ($sh - $fh) / 2;
        
        imagecopyresampled($imgDst, $imgSrc, 0, 0, $sx, $sy, $width, $height, $fw, $fh);
        
        imagejpeg($imgDst, $path, 88);
      }
    }
    
    return $this->redirect('tool/walllist');
  }
  
  public function executeWalllist(sfWebRequest $request)
  {
    $this->walls = WallPeer::doSelect(new Criteria());
    
    $idlist = array();
    foreach ($this->walls as $wall) {
      array_push($idlist, $wall->getPhotoId());
    }
    $c = new Criteria();
    $c->add(PhotoPeer::ID, $idlist, Criteria::IN);
    $c->add(PhotoPeer::OPEN_DATE, null, Criteria::ISNOTNULL);
    $c->addAscendingOrderByColumn(PhotoPeer::SHOT_DATE);
    $this->photos = PhotoPeer::doSelect($c);
  }
  
  public function executeWithinmap(sfWebRequest $request) {
    $x1 = $this->getRequestParameter('x1');
    $y1 = $this->getRequestParameter('y1');
    $x2 = $this->getRequestParameter('x2');
    $y2 = $this->getRequestParameter('y2');
    
    $this->photos = PhotoPeer::selectInRegion($x1, $y1, $x2, $y2, 0, 150, FALSE);
    
    return sfView::SUCCESS;
  }
  
  public function executeXmlread(sfWebRequest $request)
  {
    
    $content = file_get_contents($_FILES['xml']['tmp_name']);
    $tagHash = null;
    $this->list = okinawaUtil::listAlbum($content, $tagHash);
    
    $this->tagHash = $tagHash;
    
    return sfView::SUCCESS;
  }
}
