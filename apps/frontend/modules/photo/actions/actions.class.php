<?php

/**
 * photo actions.
 *
 * @package    okinawa
 * @subpackage photo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class photoActions extends sfActions
{
  public function executeAjaxgetphoto(sfWebRequest $request)
  {
    $photoid = $request->getParameter('photoid');
    $prev = $request->getParameter('prevcnt');
    $next = $request->getParameter('nextcnt');
    $vtagid = $request->getParameter('vtagid');
    $htagid = $request->getParameter('htagid');

    $this->photo = PhotoPeer::retrieveByPk($photoid);
    $tags = okinawaUtil::getTagList($this->photo);
    
    $photos_prev = array();
    $photos_next = array();
    
    foreach ($tags as $tag) {
      $c = new Criteria();
      $c->add(PhotoAndTagPeer::TAG_ID, $tag->getId());
      $photoandtaglist = PhotoAndTagPeer::doSelect($c);
      
      $photos_prev[$tag->getId()] = array();
      $photos_next[$tag->getId()] = array();
      
      
      $photoandtagidlist = array();
      foreach ($photoandtaglist as $record) {
        if ($record->getId() != $photoid) {
          array_push($photoandtagidlist, $record->getPhotoId());
        }
      }
      
      $c = new Criteria();
      $c->add(PhotoPeer::OPEN_DATE, null, Criteria::ISNOTNULL);
      $c->add(PhotoPeer::ID, $photoandtagidlist, Criteria::IN);
      $c->addAscendingOrderByColumn(PhotoPeer::SHOT_DATE);
      $photolist = PhotoPeer::doSelect($c);
      
      $photoidlist = array();
      foreach ($photolist as $photo) {
        array_push($photoidlist, $photo->getId());
      }
      
      $idx = array_search($photoid, $photoidlist);
      
      for ($i = $idx - $prev; $i < $idx; $i++) {
        if ($i >= 0) {
          array_push($photos_prev[$tag->getId()], $photolist[$i]);
        }
      }
      
      for ($i = $idx + 1; $i < $idx + $next + 1; $i++) {
        if ($i < sizeof($photolist)) {
          array_push($photos_next[$tag->getId()], $photolist[$i]);
        }
      }
    }
    
    $this->tags = $tags;
    $this->v_prev = $photos_prev[$tags[0]->getId()];
    $this->v_next = $photos_next[$tags[0]->getId()];
    $this->h_prev = $photos_prev[$tags[1]->getId()];
    $this->h_next = $photos_next[$tags[1]->getId()];
    $this->photos_prev = $photos_prev;
    $this->photos_next = $photos_next;
    
    return sfView::SUCCESS;
  }
/*
  public function executeAjaxthumblist(sfWebRequest $request)
  {
    $photoid = $request->getParameter('photoid');
    $tagid = $request->getParameter('tagid');
    $prev = $request->getParameter('prevcnt');
    $next = $request->getParameter('nextcnt');
    $vorh = $request->getParameter('vorh');
    
    $c = new Criteria();
    $c->add(PhotoAndTagPeer::TAG_ID, $tagid);
    $list = PhotoAndTagPeer::doSelect($c);
    
    $idlist = array();
    foreach ($list as $record) {
      array_push($idlist, $record->getPhotoId());
    }
    
    $c = new Criteria();
    $c->add(PhotoPeer::OPEN_DATE, null, Criteria::ISNOTNULL);
    $c->add(PhotoPeer::ID, $idlist, Criteria::IN);
    $c->addAscendingOrderByColumn(PhotoPeer::SHOT_DATE);
    $photolist = PhotoPeer::doSelect($c);
    
    $photoidlist = array();
    foreach ($photolist as $photo) {
      array_push($photoidlist, $photo->getId());
    }
    
    $idx = array_search($photoid, $photoidlist);
    
    $prevarr = array();
    for ($i = $idx - $prev; $i < $idx; $i++) {
      if ($i >= 0) {
        array_push($prevarr, $photoidlist[$i]);
      }
    }
    
    $nextarr = array();
    for ($i = $idx + 1; $i < $idx + $next + 1; $i++) {
      if ($i < sizeof($photoidlist)) {
        array_push($nextarr, $photoidlist[$i]);
      }
    }
    
    $this->prevarr = $prevarr;
    $this->nextarr = $nextarr;
    $this->vorh = $vorh;
    
    return sfView::SUCCESS;
  }
*/
  
  public function executeBlogparts(sfWebRequest $request)
  {
    $c = new Criteria();
    $c->add(PhotoPeer::OPEN_DATE, null, Criteria::ISNOTNULL);
    $this->count = PhotoPeer::doCount($c);
    
    $c = new Criteria();
    $c->add(BlogPhotoPeer::USE_DATE, null, Criteria::ISNOTNULL);
    $c->addDescendingOrderByColumn(BlogPhotoPeer::USE_DATE);
    $c->setOffset(0);
    $c->setLimit(7);
    $list = BlogPhotoPeer::doSelect($c);
    
    $idlist = array();
    foreach ($list as $blogphoto) {
      array_push($idlist, $blogphoto->getPhotoId());
    }
    $c = new Criteria();
    $c->add(PhotoPeer::ID, $idlist, Criteria::IN);
    $tmp = PhotoPeer::doSelect($c);
    
    $this->photos = array();
    foreach ($list as $blogphoto) {
      foreach ($tmp as $obj) {
        if ($blogphoto->getPhotoId() == $obj->getId()) {
          array_push($this->photos, $obj);
          break;
        }
      }
    }
    $this->list = $list;
    
    return sfView::SUCCESS;
  }
  
  public function executeBlogphotolink(sfWebRequest $request)
  {
    if (strlen($request->getParameter('date'))) {
      $datestr = substr($request->getParameter('date'), 0, 4) . '-' . substr($request->getParameter('date'), 4, 2) . '-' . substr($request->getParameter('date'), 6, 2);
    }
    else {
      $datestr = strftime('%Y-%m-%d');
    }
    $c = new Criteria();
    $c->add(BlogPhotoPeer::USE_DATE, $datestr);
    $blogphoto = BlogPhotoPeer::doSelectOne($c);
    
    if (is_object($blogphoto)) {
      $id = $blogphoto->getPhotoId();
    }
    //$this->setTemplate('introduction');
    $this->redirect('photo/show?id=' . $id);
  }
  
  public function executeEnglishtop(sfWebRequest $request)
  {
    $c = new Criteria();
    $c->add(PhotoPeer::OPEN_DATE, null, Criteria::ISNOTNULL);
    $this->count = PhotoPeer::doCount($c);
    
    $this->recent = PhotoPeer::selectNewer();
    
    $this->hour = $request->getParameter('hour', ((int)strftime('%H')));
    
    $this->bg = TopPeer::retrieveByPk($this->hour);
    $this->forward404Unless($this->bg);
    
    $this->bgphoto = PhotoPeer::retrieveByPk($this->bg->getPhotoId());
    $this->forward404Unless($this->bgphoto);
    
    //$c = new Criteria();
    //$c->add(PhotoPeer::OPEN_DATE, $this->recent[0]->getOpenDate());
    $this->todaycount = 0;//PhotoPeer::doCount($c);
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    $c = new Criteria();
    $c->add(PhotoPeer::OPEN_DATE, null, Criteria::ISNOTNULL);
    $this->count = PhotoPeer::doCount($c);
    
    $this->recent = PhotoPeer::selectNewer();
    
    $this->hour = $request->getParameter('hour', ((int)strftime('%H')));
    
    $this->bg = TopPeer::retrieveByPk($this->hour);

    $this->forward404Unless($this->bg);
    
    $this->bgphoto = PhotoPeer::retrieveByPk($this->bg->getPhotoId());
    $this->forward404Unless($this->bgphoto);

    $this->intro = file_get_contents(sfConfig::get('app_path_toptext'));
    $this->intro = str_replace('{count}', $this->count, $this->intro);
    
    //$c = new Criteria();
    //$c->add(PhotoPeer::OPEN_DATE, $this->recent[0]->getOpenDate());
    //$this->todaycount = 0;//PhotoPeer::doCount($c);
    $this->recentCount = sizeof($this->recent);
    
    $this->setTemplate('top');
  }
  
  public function executeIntroduction(sfWebRequest $request)
  {
  	$this->intro = file_get_contents(sfConfig::get('app_path_profile'));
  
    return sfView::SUCCESS;
  }
  
  public function executeLink(sfWebRequest $request)
  {
    $this->photo = PhotoPeer::retrieveByPk(1647);
    
    $this->forward404Unless($this->photo);
    
    $c = new Criteria();
    $c->addDescendingOrderByColumn(LinkCategoryPeer::ORDER_PRIORITY);
    $this->category = LinkCategoryPeer::doSelect($c);
    
    $c = new Criteria();
    $c->addDescendingOrderByColumn(LinkPeer::INSERTED_AT);
    $this->linklist = LinkPeer::doSelect($c);
    
    $c = new Criteria();
    $seocount = SeoLinkPeer::doCount($c);
    $this->maxseo = (int)($seocount / 20);
    
    return sfView::SUCCESS;
  }
  
  public function executeKeyword(sfWebRequest $request)
  {
    // タイトル文字列からタグIDを取得
    $c = new Criteria();
    $c->add(TagPeer::TITLE, $request->getParameter('title'));
    $tag = TagPeer::doSelectOne($c);
    $this->tag = $tag;
    
    if (is_object($tag)) {
      
      // 枚数を取得
      $c = new Criteria();
      $c->add(PhotoAndTagPeer::TAG_ID, $tag->getId());
      $c->add(PhotoAndTagPeer::OPEN_FLAG, 1);
      $this->count = PhotoAndTagPeer::doCount($c);
      
      // Cookieセット
      //$this->getResponse()->setCookie('keyword', $tag->getId());
      
      // index
      $this->index = (int)($request->getParameter('index'));
    }
    else {
      
      // TODO:エラー処理
      exit;
    }
  }

  public function executeKeywordindex(sfWebRequest $request)
  {
    $c = new Criteria();
    //$c->addAscendingOrderByColumn(TagPeer::ID);
    $this->count = TagPeer::doCount($c);
  }
  
  public function executeKeywordpage(sfWebRequest $request)
  {
    $this->count = TagPeer::doCount(new Criteria());
    $this->index = $request->getParameter('index');
    
    return sfView::SUCCESS;
  }

  public function executeKeywordphotos(sfWebRequest $request)
  {
    
    $c = new Criteria();
    $c->add(TagPeer::ID, $request->getParameter('id'));
    $tag = TagPeer::doSelectOne($c);
    $this->tag = $tag;
    
    if (is_object($tag)) {
      
      // 枚数を取得
      $c = new Criteria();
      $c->add(PhotoAndTagPeer::TAG_ID, $tag->getId());
      $c->add(PhotoAndTagPeer::OPEN_FLAG, 1);
      $this->count = PhotoAndTagPeer::doCount($c);
      
      // index
      $this->index = (int)($request->getParameter('index'));
    }
    else {
      
      // TODO:エラー処理
      exit;
    }
    
    return sfView::SUCCESS;
  }
  
  
  public function executeMap(sfWebRequest $request)
  {
    $LOC = array(
      'naha' => array(
        'longitude' => '127.68574476242065',
        'latitude' => '26.211626383976142',
        'zoom' => 16,
        'name' => '那覇市',
        'comment' => '沖縄の県庁所在地です。'
      ),
      'shuri' => array(
        'longitude' => '127.71941184997559',
        'latitude' => '26.216978081484164',
        'zoom' => 15,
        'name' => '首里城',
        'comment' => '十五世紀から十九世紀の間、琉球王国の首都だったところ。'
      ),
      'miyako' => array(
        'longitude' => '125.2772068977356',
        'latitude' => '24.80710986343093',
        'zoom' => 15,
        'name' => '宮古島',
        'comment' => '沖縄本島の南西にある島。ハブがいないそうです。'
      ),
      'ishigaki' => array(
        'longitude' => '124.1425895690918',
        'latitude' => '24.347565816805794',
        'zoom' => 15,
        'name' => '石垣島',
        'comment' => '西のほうにある人口の多い島です。'
      ),
      'iriomote' => array(
        'longitude' => '123.88175010681152',
        'latitude' => '24.271300784193546',
        'zoom' => 15,
        'name' => '西表島',
        'comment' => 'ヤマネコで有名な自然豊かな島です。'
      ),
      'himeyuri' => array(
        'longitude' => '127.69033670425415',
        'latitude' => '26.09664031029914',
        'zoom' => 15,
        'name' => 'ひめゆりの塔',
        'comment' => 'ひめゆり学徒隊の慰霊碑です。'
      ),
      'airportnaha' => array(
        'longitude' => '127.65207767486572',
        'latitude' => '26.203425103819924',
        'zoom' => 15,
        'name' => '那覇空港',
        'comment' => '沖縄の玄関口です。'
      ),
    );
    
    // longitude latitude zoomがあれば設定
    $lng = str_replace('_', '.', $request->getParameter('longitude'));
    $lat = str_replace('_', '.', $request->getParameter('latitude'));
    $zoom = $request->getParameter('zoom');
    $location = $request->getParameter('location');
    $photoid = $request->getParameter('photoid');
    if ($lng && $lat && $lng && $photoid) {
      $photo = PhotoPeer::retrieveByPk($photoid);
      $this->lng = $lng;
      $this->lat = $lat;
      $this->zoom = $zoom;
      $this->name = '沖縄写真旅行の地図';
      $this->comment = $photo->getTitle() . '付近から。';
    }
    else if (isset($location) && isset($LOC[$location])) {
      $this->lng = $LOC[$location]['longitude'];
      $this->lat = $LOC[$location]['latitude'];
      $this->zoom = $LOC[$location]['zoom'];
      $this->name = $LOC[$location]['name'] . 'の地図';
      $this->comment = $LOC[$location]['comment'];
    }
    else {
      
      // とりあえず那覇
      $this->lng = $LOC['naha']['longitude'];
      $this->lat = $LOC['naha']['latitude'];
      $this->zoom = $LOC['naha']['zoom'];
      $this->name = '沖縄写真旅行の地図';
      $this->comment = 'マップから探せます。';
    }
    
    // 周辺画像
    $x1 = $this->lng - 0.003;
    $x2 = $this->lng + 0.003;
    $y1 = $this->lat - 0.003;
    $y2 = $this->lat + 0.003;
    
    $list = PhotoPeer::selectInRegion($x1, $y1, $x2, $y2, 0, 20, FALSE);
    $this->list = array();
    for ($i = 0; $i < sizeof($list) && $i < 7; $i++) {
      array_push($this->list, $list[$i]);
    }
    
    /*
    $this->suburb = '';
    foreach ($list as $photo) {
      $this->suburb .= '<a href="' . okinawaUtil::getPhotoLinkUrl($photo) . '">';
      $this->suburb .= $photo->getTitle() . '</a><br />';
    }
    */
    
    return sfView::SUCCESS;
  }
  
  public function executeNote(sfWebRequest $request)
  {
    $tmp = null;
    
    $c = new Criteria();
    $c->addDescendingOrderByColumn(NotePeer::WRITE_DATE);
    $c->setLimit(10);
    $notes = NotePeer::doSelect($c);
    $this->notes = array_reverse($notes);
    
    return sfView::SUCCESS;
  }
  
  public function executeNotewrite(sfWebRequest $request)
  {
    $FONT_FAMILY = array(
    '"みかちゃん", "MS P明朝", "Osaka", "VL ゴシック"',
    '"あくあフォント", "平成明朝体", "HG正楷書体-PRO", "さざなみゴシック"',
    '"雑字", "ヒラギノ丸ゴ Pro W3", "HGP行書体", "さざなみ明朝"',
    '"ヒラギノ明朝", "HGS創英角", "VL Pゴシック"',
    );
    $FONT_SIZE = array(
    '13px', '14px', '15px', '16px', '17px', '18px',
    );
    $NAME_ANONYMOUS = array(
    '通りすがり', '名無しさん', '匿名希望', '秘密'
    );
    
    $photoid = $request->getParameter('photoid');
    $name = $request->getParameter('name');
    $comment = $request->getParameter('comment');
    
    if (! strlen($name)) {
      $name = $NAME_ANONYMOUS[mt_rand(0, sizeof($NAME_ANONYMOUS) - 1)];
    }
    if (! strlen($comment)) {
      $this->redirect('photo/note');
    }
    
    $c = new Criteria();
    $c->addDescendingOrderByColumn(NotePeer::WRITE_DATE);
    $lastone = NotePeer::doSelectOne($c);
    
    $fontsize = null;
    $fontfamily = null;
    while (is_null($fontfamily)) {
      $candidate = mt_rand(0, sizeof($FONT_FAMILY) - 1);
      if (is_object($lastone) == FALSE ||
      $lastone->getFontFamily() != $candidate) {
        $fontfamily = $candidate;
      }
    }
    while (is_null($fontsize)) {
      $candidate = mt_rand(0, sizeof($FONT_SIZE) - 1);
      if (is_object($lastone) == FALSE ||
      $lastone->getFontSize() != $candidate) {
        $fontsize = $candidate;
      }
    }
    
    $c = new Criteria();
    $c->add(NotePeer::NAME, $name);
    $c->add(NotePeer::CONTENT, $comment);
    $c->add(NotePeer::FONT_SIZE, $fontsize);
    $c->add(NotePeer::FONT_FAMILY, $fontfamily);
    $c->add(NotePeer::WRITE_DATE, strftime('%Y-%m-%d %H:%M:%S'));
    NotePeer::doInsert($c);
    
    mail('photo.okinawa@gmail.com', 'NOTE', 'A new message has written.');
    
    $this->redirect('photo/note');
  }
  
  public function executePhotoinmap(sfWebRequest $request) {
    $x1 = $request->getParameter('x1');
    $y1 = $request->getParameter('y1');
    $x2 = $request->getParameter('x2');
    $y2 = $request->getParameter('y2');
    $index = $request->getParameter('index');
    
    $limit = 100;
    
    $this->photos = PhotoPeer::selectInRegion($x1, $y1, $x2, $y2, $index * $limit, $limit, FALSE);
    $this->x1 = $x1;
    $this->y1 = $y1;
    $this->x2 = $x2;
    $this->y2 = $y2;
    $this->cont = sizeof($this->photos) == $limit ? 1 : 0;
    
    return sfView::SUCCESS;
  }

  public function executeSeolink(sfWebRequest $request)
  {
    $page = $request->getParameter('page');
    
    $c = new Criteria();
    $c->add(SeoLinkPeer::ID, SeoLinkPeer::ID . " between " . ($page * 20) . ' and ' . ($page * 20 + 19), Criteria::CUSTOM);
    $this->list = SeoLinkPeer::doSelect($c);
    
    $this->photo = PhotoPeer::retrieveByPk(2520);
    
    return sfView::SUCCESS;
  }

  public function executeShow(sfWebRequest $request)
  {
    $c = new Criteria();
    $c->add(PhotoPeer::ID, $request->getParameter('id'));
    $c->add(PhotoPeer::OPEN_DATE, null, Criteria::ISNOTNULL);
    $this->photo = PhotoPeer::doSelectOne($c);
    $this->forward404Unless($this->photo);
    
    $this->tags = okinawaUtil::getTagList($this->photo);
    
    $this->vid = sizeof($this->tags) ? $this->tags[0]->getId() : 0;
    $this->hid = sizeof($this->tags) >= 2 ? $this->tags[1]->getId() : 0;

    $this->keywordid = 0;
    
    $this->todaywindow = false;
    $c = new Criteria();
    $c->add(BlogPhotoPeer::USE_DATE, strftime('%Y-%m-%d'));
    $blogphoto = BlogPhotoPeer::doSelectOne($c);
    if (is_object($blogphoto) && $blogphoto->getPhotoId() == $this->photo->getId()) {
      $this->todaywindow = true;
    }
    
    $this->setTemplate('show');
  }

  /*
  public function executeShow(sfWebRequest $request)
  {
    $c = new Criteria();
    $c->add(PhotoPeer::ID, $request->getParameter('id'));
    $c->add(PhotoPeer::OPEN_DATE, null, Criteria::ISNOTNULL);
    $this->photo = PhotoPeer::doSelectOne($c);
    //$this->photo = PhotoPeer::retrieveByPk($request->getParameter('id'));
    
    $this->forward404Unless($this->photo);
    
    $this->keywordid = 0;

    $this->todaywindow = false;
    $c = new Criteria();
    $c->add(BlogPhotoPeer::USE_DATE, strftime('%Y-%m-%d'));
    $blogphoto = BlogPhotoPeer::doSelectOne($c);
    if (is_object($blogphoto) && $blogphoto->getPhotoId() == $this->photo->getId()) {
      $this->todaywindow = true;
    }
    
    $this->lng = $this->photo->getLongitude();
    $this->lat = $this->photo->getLatitude();
    $this->iconurl = okinawaUtil::getIconUrl($this->photo);
    $this->iconWidth = $this->photo->getIconWidth();
    $this->iconHeight = $this->photo->getIconHeight();
    
    $this->setTemplate('wander');
  }
  */
  
  public function executeWallpapersample(sfWebRequest $request) {
    $id = $request->getParameter('id');
    $wh = $request->getParameter('size');
    
    $width = 0;
    $height = 0;
    list ($width, $height) = explode('x', $wh);
    $width = (int)$width;
    $height = (int)$height;
    
    if ($width < 320 || $width > 1400 ||
    $height < 240 || $height > 1050) {
      exit;
    }
    
    $photo = PhotoPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($photo);
    
    // 画像の保存パス
    $path = '/home/okinawa/data/wallpapersample/' . $photo->getId() . '_' . $width . 'x' . $height;
    
    // キャッシュが存在すれば出力
    if (file_exists($path)) {
      $mtime = filemtime($path);
      $downloadname = 'photo-okinawa.com_' . $photo->getId() . '_' . $width . '.jpg'; 
      header('Last-Modified: ' . strftime('%a, %d %b %Y %H:%M:%S', $mtime));
      header('Expires: ' . strftime('%a, %d %b %Y 23:59:50', time()));
      header('Content-Type: image/jpeg; name="' . $downloadname . '";');
      header('Content-Length: ' . filesize($path));
      header('Content-Disposition: attachment; filename="' . $downloadname . '";');
      header('Pragma:');
      if ($_SERVER['REQUEST_METHOD'] == 'HEAD') {
        exit;
      }
      readfile($path);
      exit;
    }
    else {
      
      /// 影パーツの読み込み
      $imgFrameBL = imagecreatefrompng(sfConfig::get('app_path_shadow') . 'frame_bl.png');
      $imgFrameB = imagecreatefrompng(sfConfig::get('app_path_shadow') . 'frame_b.png');
      $imgFrameBR = imagecreatefrompng(sfConfig::get('app_path_shadow') . 'frame_br.png');
      $imgFrameTR = imagecreatefrompng(sfConfig::get('app_path_shadow') . 'frame_tr.png');
      $imgFrameR = imagecreatefrompng(sfConfig::get('app_path_shadow') . 'frame_r.png');
      
      // キャッシュが存在しなければ作成
      $imgSrc = imagecreatefromjpeg($filepath = sfConfig::get('app_path_upload') . $photo->getFilename());
      $imgDst = imagecreatetruecolor($width, $height);
      
      /// 影パーツの書き込み
      imagecopyresampled($imgDst, $imgFrameBL, 0, $height - 10, 0, 0, 40, 10, 40, 10);
      imagecopyresampled($imgDst, $imgFrameB, 40, $height - 10, 0, 0, $width - 50, 10, 10, 10);
      imagecopyresampled($imgDst, $imgFrameBR, $width - 10, $height - 10, 0, 0, 10, 10, 10, 10);
      imagecopyresampled($imgDst, $imgFrameTR, $width - 10, 0, 0, 0, 10, 40, 10, 40);
      imagecopyresampled($imgDst, $imgFrameR, $width - 10, 40, 0, 0, 10, $height - 50, 10, 10);
      
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
        
        imagecopyresampled($imgDst, $imgSrc, 0, 0, $sx, $sy, $width - 10, $height - 10, $fw, $fh);
        
        imagejpeg($imgDst, $path, 88);

        $mtime = filemtime($path);
        header('Last-Modified: ' . strftime('%a, %d %b %Y %H:%M:%S', $mtime));
        header('Expires: ' . strftime('%a, %d %b %Y 23:59:50', time() + 60 * 60 * 24 * 14));
        header('Content-Type: image/jpeg');
        header('Content-Length: ' . filesize($path));
        header('Pragma:');
        imagejpeg($imgDst);
        exit;
      }
    }
  }
  
  public function executeWallpaper(sfWebRequest $request) {
    $id = $request->getParameter('id');
    $wh = $request->getParameter('size');
    
    $width = 0;
    $height = 0;
    list ($width, $height) = explode('x', $wh);
    $width = (int)$width;
    $height = (int)$height;
    
    if ($width < 320 || $width > 1400 ||
    $height < 240 || $height > 1050) {
      exit;
    }
    
    $photo = PhotoPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($photo);
    
    // 画像の保存パス
    $path = '/home/okinawa/data/wallpaper/' . $photo->getId() . '_' . $width . 'x' . $height;
    
    // キャッシュが存在すれば出力
    if (file_exists($path)) {
      $mtime = filemtime($path);
      $downloadname = 'photo-okinawa.com_' . $photo->getId() . '_' . $width . '.jpg'; 
      header('Last-Modified: ' . strftime('%a, %d %b %Y %H:%M:%S', $mtime));
      header('Expires: ' . strftime('%a, %d %b %Y 23:59:50', time()));
      header('Content-Type: image/jpeg; name="' . $downloadname . '";');
      header('Content-Length: ' . filesize($path));
      header('Content-Disposition: attachment; filename="' . $downloadname . '";');
      header('Pragma:');
      if ($_SERVER['REQUEST_METHOD'] == 'HEAD') {
        exit;
      }
      readfile($path);
      exit;
    }
    else {
      
      // キャッシュが存在しなければ作成
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

        $mtime = filemtime($path);
        $downloadname = 'photo-okinawa.com_' . $blogphoto->getPhotoId() . '_' . $width . '.jpg'; 
        header('Last-Modified: ' . strftime('%a, %d %b %Y %H:%M:%S', $mtime));
        header('Expires: ' . strftime('%a, %d %b %Y 23:59:50', time() + 60 * 60 * 24 * 14));
        header('Content-Type: image/jpeg; name="' . $downloadname . '";');
        header('Content-Length: ' . filesize($path));
        header('Content-Disposition: attachment; filename="' . $downloadname . '";');
        header('Pragma:');
        imagejpeg($imgDst);
        exit;
      }
    }
  }
  
  public function executeWallpaperlist(sfWebRequest $request)
  {
    $c = new Criteria();
    $c->add(PhotoPeer::OPEN_DATE, null, Criteria::ISNOTNULL);
    $this->count = PhotoPeer::doCount($c);
    
    $this->walls = WallPeer::doSelect(new Criteria());
    
    $idlist = array();
    foreach ($this->walls as $wall) {
      array_push($idlist, $wall->getPhotoId());
    }
    $c = new Criteria();
    $c->add(PhotoPeer::ID, $idlist, Criteria::IN);
    $c->add(PhotoPeer::OPEN_DATE, null, Criteria::ISNOTNULL);
    $c->addDescendingOrderByColumn(PhotoPeer::ID);
    $this->photos = PhotoPeer::doSelect($c);
    
    return sfView::SUCCESS;
  }
  
  public function executeWander(sfWebRequest $request)
  {
    $top = TopPeer::retrieveByPk(((int)strftime("%H")));
    //$photo = PhotoPeer::retrieveByPk($top->getPhotoId());
    $photo = PhotoPeer::retrieveByPk(50);
    
    $this->photoid = $photo->getId();
    $this->lat = $photo->getLatitude();
    $this->lng = $photo->getLongitude();
    $this->photo = $photo;
    
    $c = new Criteria();
    $c->add(PhotoPeer::OPEN_DATE, null, Criteria::ISNOTNULL);
    $this->count = PhotoPeer::doCount($c);
  }
  
  public function executeWanderupdate(sfWebRequest $request)
  {
    $photo = PhotoPeer::retrieveByPk($request->getParameter('photoid'));
    
    $lng = $photo->getLongitude();
    $lat = $photo->getLatitude();
    
    $n_photos = PhotoPeer::selectInRegion2($lng - 0.02, $lat, $lng + 0.02, $lat + 0.1, 0);
    $e_photos = PhotoPeer::selectInRegion2($lng, $lat - 0.02, $lng + 0.1, $lat + 0.02, 3);
    $s_photos = PhotoPeer::selectInRegion2($lng - 0.02, $lat - 0.1, $lng + 0.02, $lat, 6);
    $w_photos = PhotoPeer::selectInRegion2($lng - 0.1, $lat - 0.02, $lng, $lat + 0.02, 9);
    
    $n = null;
    $s = null;
    $w = null;
    $e = null;
    
    foreach ($n_photos as $p) {
      $xdiff = abs($photo->getLongitude() - $p->getLongitude());
      $ydiff = abs($photo->getLatitude() - $p->getLatitude());
      if ($xdiff < $ydiff) {
        if (is_null($n) ||
        $n->getLatitude() > $p->getLatitude()) {
          $n = $p;
        }
      }
    } 
    foreach ($s_photos as $p) {
      $xdiff = abs($photo->getLongitude() - $p->getLongitude());
      $ydiff = abs($photo->getLatitude() - $p->getLatitude());
      if ($xdiff < $ydiff) {
        if (is_null($s) ||
        $s->getLatitude() < $p->getLatitude()) {
          $s = $p;
        }
      }
    } 
    foreach ($e_photos as $p) {
      $xdiff = abs($photo->getLongitude() - $p->getLongitude());
      $ydiff = abs($photo->getLatitude() - $p->getLatitude());
      if ($xdiff > $ydiff) {
        if (is_null($e) ||
        $e->getLongitude() > $p->getLongitude()) {
          $e = $p;
        }
      }
    } 
    foreach ($w_photos as $p) {
      $xdiff = abs($photo->getLongitude() - $p->getLongitude());
      $ydiff = abs($photo->getLatitude() - $p->getLatitude());
      if ($xdiff > $ydiff) {
        if (is_null($w) ||
        $w->getLongitude() < $p->getLongitude()) {
          $w = $p;
        }
      }
    } 
    
    $this->n = $n;
    $this->w =  $w;
    $this->e = $e;
    $this->s = $s;
    
    return sfView::SUCCESS;
  }
}
