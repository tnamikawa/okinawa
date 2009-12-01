<?php



class NoteMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.NoteMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('note_mst');
		$tMap->setPhpName('Note');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PHOTO_ID', 'PhotoId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true, 64);

		$tMap->addColumn('CONTENT', 'Content', 'string', CreoleTypes::LONGVARCHAR, true, null);

		$tMap->addColumn('FONT_FAMILY', 'FontFamily', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('FONT_SIZE', 'FontSize', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('WRITE_DATE', 'WriteDate', 'int', CreoleTypes::TIMESTAMP, true, null);

	} 
} 