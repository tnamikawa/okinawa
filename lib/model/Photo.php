<?php

/**
 * Subclass for representing a row from the 'photo_mst' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Photo extends BasePhoto
{
  function isMapOK() {
    $ret = FALSE;
    
    $longtitude = $this->getLongitude();
    $latitude = $this->getLatitude();
    
    if (is_null($longtitude) === FALSE &&
    is_null($latitude) === FALSE) {
      $ret = TRUE;
    }
    
    return $ret;
  }

  /**
   * 標準サイズの画像URLを取得する
   */
  public function getPhotoUrl()
  {
    return sfConfig::get('app_photo_url') . $this->getFilename();
  }

  /**
   * 320の画像URLを取得する
   */
  public function getSlideUrl()
  {
    return sfConfig::get('app_slide_url') . $this->getFilename();
  }
}
