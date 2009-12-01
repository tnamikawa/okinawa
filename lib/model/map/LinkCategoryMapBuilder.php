<?php



class LinkCategoryMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.LinkCategoryMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('linkcategory_mst');
		$tMap->setPhpName('LinkCategory');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::VARCHAR, true, 64);

		$tMap->addColumn('ORDER_PRIORITY', 'OrderPriority', 'int', CreoleTypes::INTEGER, true, null);

	} 
} 