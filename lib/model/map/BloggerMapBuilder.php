<?php



class BloggerMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.BloggerMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('blogpartsuser_mst');
		$tMap->setPhpName('Blogger');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('URL', 'Url', 'string', CreoleTypes::VARCHAR, true, 64);

		$tMap->addColumn('LAST_ACCESS', 'LastAccess', 'int', CreoleTypes::DATE, true, null);

	} 
} 