<?php


abstract class BasePhotoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'photo_mst';

	
	const CLASS_DEFAULT = 'lib.model.Photo';

	
	const NUM_COLUMNS = 23;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'photo_mst.ID';

	
	const TITLE = 'photo_mst.TITLE';

	
	const FILENAME = 'photo_mst.FILENAME';

	
	const COMMENT = 'photo_mst.COMMENT';

	
	const WIDTH = 'photo_mst.WIDTH';

	
	const HEIGHT = 'photo_mst.HEIGHT';

	
	const THUMB_WIDTH = 'photo_mst.THUMB_WIDTH';

	
	const THUMB_HEIGHT = 'photo_mst.THUMB_HEIGHT';

	
	const ICON_WIDTH = 'photo_mst.ICON_WIDTH';

	
	const ICON_HEIGHT = 'photo_mst.ICON_HEIGHT';

	
	const WANDER_WIDTH = 'photo_mst.WANDER_WIDTH';

	
	const WANDER_HEIGHT = 'photo_mst.WANDER_HEIGHT';

	
	const SLIDE_WIDTH = 'photo_mst.SLIDE_WIDTH';

	
	const SLIDE_HEIGHT = 'photo_mst.SLIDE_HEIGHT';

	
	const LONGITUDE = 'photo_mst.LONGITUDE';

	
	const LATITUDE = 'photo_mst.LATITUDE';

	
	const SHOT_DATE = 'photo_mst.SHOT_DATE';

	
	const OPEN_DATE = 'photo_mst.OPEN_DATE';

	
	const MODIFIED_DATE = 'photo_mst.MODIFIED_DATE';

	
	const METAMODIFIED_DATE = 'photo_mst.METAMODIFIED_DATE';

	
	const FILEMTIME = 'photo_mst.FILEMTIME';

	
	const CREATED_AT = 'photo_mst.CREATED_AT';

	
	const UPDATED_AT = 'photo_mst.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Title', 'Filename', 'Comment', 'Width', 'Height', 'ThumbWidth', 'ThumbHeight', 'IconWidth', 'IconHeight', 'WanderWidth', 'WanderHeight', 'SlideWidth', 'SlideHeight', 'Longitude', 'Latitude', 'ShotDate', 'OpenDate', 'ModifiedDate', 'MetamodifiedDate', 'Filemtime', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (PhotoPeer::ID, PhotoPeer::TITLE, PhotoPeer::FILENAME, PhotoPeer::COMMENT, PhotoPeer::WIDTH, PhotoPeer::HEIGHT, PhotoPeer::THUMB_WIDTH, PhotoPeer::THUMB_HEIGHT, PhotoPeer::ICON_WIDTH, PhotoPeer::ICON_HEIGHT, PhotoPeer::WANDER_WIDTH, PhotoPeer::WANDER_HEIGHT, PhotoPeer::SLIDE_WIDTH, PhotoPeer::SLIDE_HEIGHT, PhotoPeer::LONGITUDE, PhotoPeer::LATITUDE, PhotoPeer::SHOT_DATE, PhotoPeer::OPEN_DATE, PhotoPeer::MODIFIED_DATE, PhotoPeer::METAMODIFIED_DATE, PhotoPeer::FILEMTIME, PhotoPeer::CREATED_AT, PhotoPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'title', 'filename', 'comment', 'width', 'height', 'thumb_width', 'thumb_height', 'icon_width', 'icon_height', 'wander_width', 'wander_height', 'slide_width', 'slide_height', 'longitude', 'latitude', 'shot_date', 'open_date', 'modified_date', 'metamodified_date', 'filemtime', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Title' => 1, 'Filename' => 2, 'Comment' => 3, 'Width' => 4, 'Height' => 5, 'ThumbWidth' => 6, 'ThumbHeight' => 7, 'IconWidth' => 8, 'IconHeight' => 9, 'WanderWidth' => 10, 'WanderHeight' => 11, 'SlideWidth' => 12, 'SlideHeight' => 13, 'Longitude' => 14, 'Latitude' => 15, 'ShotDate' => 16, 'OpenDate' => 17, 'ModifiedDate' => 18, 'MetamodifiedDate' => 19, 'Filemtime' => 20, 'CreatedAt' => 21, 'UpdatedAt' => 22, ),
		BasePeer::TYPE_COLNAME => array (PhotoPeer::ID => 0, PhotoPeer::TITLE => 1, PhotoPeer::FILENAME => 2, PhotoPeer::COMMENT => 3, PhotoPeer::WIDTH => 4, PhotoPeer::HEIGHT => 5, PhotoPeer::THUMB_WIDTH => 6, PhotoPeer::THUMB_HEIGHT => 7, PhotoPeer::ICON_WIDTH => 8, PhotoPeer::ICON_HEIGHT => 9, PhotoPeer::WANDER_WIDTH => 10, PhotoPeer::WANDER_HEIGHT => 11, PhotoPeer::SLIDE_WIDTH => 12, PhotoPeer::SLIDE_HEIGHT => 13, PhotoPeer::LONGITUDE => 14, PhotoPeer::LATITUDE => 15, PhotoPeer::SHOT_DATE => 16, PhotoPeer::OPEN_DATE => 17, PhotoPeer::MODIFIED_DATE => 18, PhotoPeer::METAMODIFIED_DATE => 19, PhotoPeer::FILEMTIME => 20, PhotoPeer::CREATED_AT => 21, PhotoPeer::UPDATED_AT => 22, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'title' => 1, 'filename' => 2, 'comment' => 3, 'width' => 4, 'height' => 5, 'thumb_width' => 6, 'thumb_height' => 7, 'icon_width' => 8, 'icon_height' => 9, 'wander_width' => 10, 'wander_height' => 11, 'slide_width' => 12, 'slide_height' => 13, 'longitude' => 14, 'latitude' => 15, 'shot_date' => 16, 'open_date' => 17, 'modified_date' => 18, 'metamodified_date' => 19, 'filemtime' => 20, 'created_at' => 21, 'updated_at' => 22, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/PhotoMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.PhotoMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = PhotoPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(PhotoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PhotoPeer::ID);

		$criteria->addSelectColumn(PhotoPeer::TITLE);

		$criteria->addSelectColumn(PhotoPeer::FILENAME);

		$criteria->addSelectColumn(PhotoPeer::COMMENT);

		$criteria->addSelectColumn(PhotoPeer::WIDTH);

		$criteria->addSelectColumn(PhotoPeer::HEIGHT);

		$criteria->addSelectColumn(PhotoPeer::THUMB_WIDTH);

		$criteria->addSelectColumn(PhotoPeer::THUMB_HEIGHT);

		$criteria->addSelectColumn(PhotoPeer::ICON_WIDTH);

		$criteria->addSelectColumn(PhotoPeer::ICON_HEIGHT);

		$criteria->addSelectColumn(PhotoPeer::WANDER_WIDTH);

		$criteria->addSelectColumn(PhotoPeer::WANDER_HEIGHT);

		$criteria->addSelectColumn(PhotoPeer::SLIDE_WIDTH);

		$criteria->addSelectColumn(PhotoPeer::SLIDE_HEIGHT);

		$criteria->addSelectColumn(PhotoPeer::LONGITUDE);

		$criteria->addSelectColumn(PhotoPeer::LATITUDE);

		$criteria->addSelectColumn(PhotoPeer::SHOT_DATE);

		$criteria->addSelectColumn(PhotoPeer::OPEN_DATE);

		$criteria->addSelectColumn(PhotoPeer::MODIFIED_DATE);

		$criteria->addSelectColumn(PhotoPeer::METAMODIFIED_DATE);

		$criteria->addSelectColumn(PhotoPeer::FILEMTIME);

		$criteria->addSelectColumn(PhotoPeer::CREATED_AT);

		$criteria->addSelectColumn(PhotoPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(photo_mst.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT photo_mst.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PhotoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PhotoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PhotoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = PhotoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return PhotoPeer::populateObjects(PhotoPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			PhotoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = PhotoPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return PhotoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(PhotoPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(PhotoPeer::ID);
			$selectCriteria->add(PhotoPeer::ID, $criteria->remove(PhotoPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(PhotoPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(PhotoPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Photo) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PhotoPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(Photo $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PhotoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PhotoPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(PhotoPeer::DATABASE_NAME, PhotoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PhotoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(PhotoPeer::DATABASE_NAME);

		$criteria->add(PhotoPeer::ID, $pk);


		$v = PhotoPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(PhotoPeer::ID, $pks, Criteria::IN);
			$objs = PhotoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasePhotoPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/PhotoMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.PhotoMapBuilder');
}
