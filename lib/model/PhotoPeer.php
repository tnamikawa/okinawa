<?php

/**
 * Subclass for performing query and update operations on the 'photo_mst' table.
 *
 * 
 *
 * @package lib.model
 */ 
class PhotoPeer extends BasePhotoPeer
{
  /**
   * 範囲内の画像を取得
   */
  public static function selectInRegion($x1, $y1, $x2, $y2, $offset, $limit = 20, $isForceComment) {
    
    $c = new Criteria();
    $c->add(PhotoPeer::LONGITUDE, PhotoPeer::LONGITUDE . " between '$x1' and '$x2'", Criteria::CUSTOM);
    $c->add(PhotoPeer::LATITUDE, PhotoPeer::LATITUDE . " between '$y1' and '$y2'", Criteria::CUSTOM);
    $c->add(PhotoPeer::OPEN_DATE, null, Criteria::ISNOTNULL);
    $c->add(PhotoPeer::COMMENT, null, Criteria::ISNOTNULL);
    $c->setOffset($offset);
    $c->setLimit($limit);
    
    return PhotoPeer::doSelect($c);
  }
  
  /**
   * 範囲内の画像を取得
   */
  public static function selectInRegion2($x1, $y1, $x2, $y2, $direction) {
    
    $c = new Criteria();
    $c->add(PhotoPeer::LONGITUDE, PhotoPeer::LONGITUDE . " between '$x1' and '$x2'", Criteria::CUSTOM);
    $c->add(PhotoPeer::LATITUDE, PhotoPeer::LATITUDE . " between '$y1' and '$y2'", Criteria::CUSTOM);
    $c->add(PhotoPeer::OPEN_DATE, null, Criteria::ISNOTNULL);
    $c->add(PhotoPeer::COMMENT, null, Criteria::ISNOTNULL);
    if ($direction == 0) {
      $c->addAscendingOrderByColumn(PhotoPeer::LATITUDE);
    }
    else if ($direction == 3) {
      $c->addAscendingOrderByColumn(PhotoPeer::LONGITUDE);
    }
    else if ($direction == 6) {
      $c->addDescendingOrderByColumn(PhotoPeer::LATITUDE);
    }
    else if ($direction == 9) {
      $c->addDescendingOrderByColumn(PhotoPeer::LONGITUDE);
    }
    $c->setLimit(20);
    
    return PhotoPeer::doSelect($c);
  }
  
  /**
   * 最新の7枚を取得
   */
  public static function selectNewer() {
    
    $stamp = time();
    
    $c = new Criteria();
    //$c->add(PhotoPeer::OPEN_DATE, strftime('%Y-%m-%d', $stamp));
    $c->add(PhotoPeer::OPEN_DATE, null, Criteria::ISNOTNULL);
    $c->setLimit(7);
    $c->addDescendingOrderByColumn(PhotoPeer::SHOT_DATE);
    
    $ret = PhotoPeer::doSelect($c);
    if (! sizeof($ret)) {
      $c = new Criteria();
      $c->add(PhotoPeer::OPEN_DATE, strftime('%Y-%m-%d', $stamp - 60 * 60 * 24));
      $c->setLimit(7);
      $c->addDescendingOrderByColumn(PhotoPeer::SHOT_DATE);
      
      $ret = PhotoPeer::doSelect($c);
    }
    
    return $ret;
  }
}

