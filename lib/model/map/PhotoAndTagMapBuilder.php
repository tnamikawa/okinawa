<?php



class PhotoAndTagMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PhotoAndTagMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('photo_and_tag_rel');
		$tMap->setPhpName('PhotoAndTag');

		$tMap->setUseIdGenerator(true);

		$tMap->addColumn('PHOTO_ID', 'PhotoId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TAG_ID', 'TagId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('OPEN_FLAG', 'OpenFlag', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

	} 
} 