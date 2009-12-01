<?php

/**
 * carte actions.
 *
 * @package    okinawa
 * @subpackage carte
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class carteActions extends sfActions
{
  public function executeCartelist()
  {
    $this->count = CartePeer::doCount(new Criteria());
  }
  
  public function executeCarteupload()
  {
    // JPEG画像であるか
    $img = imagecreatefromjpeg($_FILES['xml']['tmp_name']);
    $this->forward404Unless($img);
    
    // ファイル名の取得
    $clientname = $_FILES['userfile']['name'];
    $filename = '';
    $tmp = null;
    if (preg_match('/([\w\.]+)$/', $clientname, $tmp)) {
      $filename = $tmp[1];
    }
    
    // rawに格納する
    $rawpath = '/home/okinawa/data/carte_raw/' . $filename;
    rename($_FILES['xml']['tmp_name'], $rawpath);
    
    // 表示用を生成
    $sw = imagesx($img);
    $sh = imagesy($img);
    $showw = 800;
    $showh = $showw * $sh / $sw;
    $img2 = imagecreatetruecolor($showw, $showh);
    imagecopyresampled($img2, $img, 0, 0, 0, 0, $showw, $showh, $sw, $sh);
    $showpath = '/home/okinawa/web/carte_postel/' . $filename;
    imagejpeg($img2, $showpath, 85);
    imagedestroy($img2);
    
    // サムネイルを生成
    $thumbw = 200;
    $thumbh = $thumbw * $sh / $sw;
    $img2 = imagecreatetruecolor($thumbw, $thumbh);
    imagecopyresampled($img2, $img, 0, 0, 0, 0, $thumbw, $thumbh, $sw, $sh);
    $thumbpath = '/home/okinawa/web/carte_thumb/' . $filename;
    imagejpeg($img2, $thumbpath, 70);
    imagedestroy($img2);
    
    // レコード作成
    $c = new Criteria();
    
  }
}
