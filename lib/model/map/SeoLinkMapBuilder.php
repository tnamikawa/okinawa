<?php



class SeoLinkMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.SeoLinkMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('seolink_mst');
		$tMap->setPhpName('SeoLink');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('LINKSTR', 'Linkstr', 'string', CreoleTypes::VARCHAR, true, 255);

	} 
} 