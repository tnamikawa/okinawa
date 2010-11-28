<?php
 
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'prod', false);
 
// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

$data = new sfPropelData();
$data->loadData(sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR.'fixtures');

?>