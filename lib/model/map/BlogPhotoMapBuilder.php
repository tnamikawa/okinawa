<?php



class BlogPhotoMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.BlogPhotoMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('blog_photo_mst');
		$tMap->setPhpName('BlogPhoto');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PHOTO_ID', 'PhotoId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('USE_DATE', 'UseDate', 'int', CreoleTypes::DATE, false, null);

	} 
} 