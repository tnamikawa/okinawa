<?php



class LinkMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.LinkMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('link_mst');
		$tMap->setPhpName('Link');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('URL', 'Url', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::VARCHAR, true, 64);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('CATEGORY_ID', 'CategoryId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('INSERTED_AT', 'InsertedAt', 'int', CreoleTypes::TIMESTAMP, true, null);

	} 
} 