<?php



class TopMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TopMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('top_photo');
		$tMap->setPhpName('Top');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PHOTO_ID', 'PhotoId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TEXT_COLOR', 'TextColor', 'string', CreoleTypes::VARCHAR, true, 7);

		$tMap->addColumn('LINK_COLOR', 'LinkColor', 'string', CreoleTypes::VARCHAR, true, 7);

	} 
} 