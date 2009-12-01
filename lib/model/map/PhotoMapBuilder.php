<?php



class PhotoMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PhotoMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('photo_mst');
		$tMap->setPhpName('Photo');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('FILENAME', 'Filename', 'string', CreoleTypes::VARCHAR, true, 64);

		$tMap->addColumn('COMMENT', 'Comment', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('WIDTH', 'Width', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('HEIGHT', 'Height', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('THUMB_WIDTH', 'ThumbWidth', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('THUMB_HEIGHT', 'ThumbHeight', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ICON_WIDTH', 'IconWidth', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ICON_HEIGHT', 'IconHeight', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('WANDER_WIDTH', 'WanderWidth', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('WANDER_HEIGHT', 'WanderHeight', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SLIDE_WIDTH', 'SlideWidth', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SLIDE_HEIGHT', 'SlideHeight', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('LONGITUDE', 'Longitude', 'double', CreoleTypes::DOUBLE, false, null);

		$tMap->addColumn('LATITUDE', 'Latitude', 'double', CreoleTypes::DOUBLE, false, null);

		$tMap->addColumn('SHOT_DATE', 'ShotDate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('OPEN_DATE', 'OpenDate', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('MODIFIED_DATE', 'ModifiedDate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('METAMODIFIED_DATE', 'MetamodifiedDate', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('FILEMTIME', 'Filemtime', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 