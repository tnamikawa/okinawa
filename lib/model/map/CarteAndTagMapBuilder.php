<?php



class CarteAndTagMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.CarteAndTagMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('carte_and_tag_rel');
		$tMap->setPhpName('CarteAndTag');

		$tMap->setUseIdGenerator(true);

		$tMap->addColumn('CARTE_ID', 'CarteId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TAG_ID', 'TagId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

	} 
} 