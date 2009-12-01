<?php



class CarteMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.CarteMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('carte_mst');
		$tMap->setPhpName('Carte');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('ENGLISHTITLE', 'Englishtitle', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('FILENAME', 'Filename', 'string', CreoleTypes::VARCHAR, true, 64);

		$tMap->addColumn('COMMENT', 'Comment', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('WIDTH', 'Width', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('HEIGHT', 'Height', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('THUMB_WIDTH', 'ThumbWidth', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('THUMB_HEIGHT', 'ThumbHeight', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('INS_DATE', 'InsDate', 'int', CreoleTypes::DATE, false, null);

	} 
} 