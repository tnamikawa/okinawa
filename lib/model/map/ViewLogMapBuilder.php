<?php



class ViewLogMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ViewLogMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('view_log');
		$tMap->setPhpName('ViewLog');

		$tMap->setUseIdGenerator(true);

		$tMap->addColumn('PHOTO_ID', 'PhotoId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('IPADDRESS', 'Ipaddress', 'string', CreoleTypes::VARCHAR, true, 15);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

	} 
} 