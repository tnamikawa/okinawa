<?php
 
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'prod', false);
 
// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

$photos = PhotoPeer::doSelect(new Criteria());

okinawaUtil::refreshImages($photos);

?>