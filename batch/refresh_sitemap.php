<?php
 
define('SF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('SF_APP',         'frontend');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG',       true);
 
require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');
 
// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

$keywords = TagPeer::doSelect(new Criteria());
$c = new Criteria();
$c->add(PhotoPeer::OPEN_DATE, null, Criteria::ISNOTNULL);
$photos = PhotoPeer::doSelect($c);

$buff = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
$buff .= '  <urlset xmlns="http://www.google.com/schemas/sitemap/0.84">' . "\n";

$url = 'http://photo-okinawa.com/';
$buff .= add_url($url);
$url = 'http://photo-okinawa.com/blogparts';
$buff .= add_url($url);
$url = 'http://photo-okinawa.com/wallpaper';
$buff .= add_url($url);
$url = 'http://photo-okinawa.com/introduction';
$buff .= add_url($url);

foreach ($keywords as $k) {
  $url = 'http://photo-okinawa.com/keyword/' . urlencode($k->getTitle());
  $buff .= add_url($url);
}
foreach ($photos as $p) {
  $url = 'http://photo-okinawa.com/show/' . $p->getId();
  $buff .= add_url($url);
}
$buff .= '  </urlset>';

function add_url($url) {
  $ret = '';
  
  $ret .= '    <url>' . "\n";
  $ret .= '      <loc>' . $url . '</loc>' . "\n";
  $ret .= '    </url>' . "\n";  
  
  return $ret;
}

file_put_contents("/home/okinawa/web/sitemap.xml", $buff);

?>