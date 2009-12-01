<?php


abstract class BasePhotoAndTag extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $photo_id;


	
	protected $tag_id;


	
	protected $open_flag;


	
	protected $id;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getPhotoId()
	{

		return $this->photo_id;
	}

	
	public function getTagId()
	{

		return $this->tag_id;
	}

	
	public function getOpenFlag()
	{

		return $this->open_flag;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setPhotoId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->photo_id !== $v) {
			$this->photo_id = $v;
			$this->modifiedColumns[] = PhotoAndTagPeer::PHOTO_ID;
		}

	} 
	
	public function setTagId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tag_id !== $v) {
			$this->tag_id = $v;
			$this->modifiedColumns[] = PhotoAndTagPeer::TAG_ID;
		}

	} 
	
	public function setOpenFlag($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->open_flag !== $v) {
			$this->open_flag = $v;
			$this->modifiedColumns[] = PhotoAndTagPeer::OPEN_FLAG;
		}

	} 
	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = PhotoAndTagPeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->photo_id = $rs->getInt($startcol + 0);

			$this->tag_id = $rs->getInt($startcol + 1);

			$this->open_flag = $rs->getInt($startcol + 2);

			$this->id = $rs->getInt($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PhotoAndTag object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PhotoAndTagPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PhotoAndTagPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PhotoAndTagPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PhotoAndTagPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PhotoAndTagPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = PhotoAndTagPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PhotoAndTagPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getPhotoId();
				break;
			case 1:
				return $this->getTagId();
				break;
			case 2:
				return $this->getOpenFlag();
				break;
			case 3:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PhotoAndTagPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getPhotoId(),
			$keys[1] => $this->getTagId(),
			$keys[2] => $this->getOpenFlag(),
			$keys[3] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PhotoAndTagPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setPhotoId($value);
				break;
			case 1:
				$this->setTagId($value);
				break;
			case 2:
				$this->setOpenFlag($value);
				break;
			case 3:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PhotoAndTagPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setPhotoId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTagId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setOpenFlag($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setId($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PhotoAndTagPeer::DATABASE_NAME);

		if ($this->isColumnModified(PhotoAndTagPeer::PHOTO_ID)) $criteria->add(PhotoAndTagPeer::PHOTO_ID, $this->photo_id);
		if ($this->isColumnModified(PhotoAndTagPeer::TAG_ID)) $criteria->add(PhotoAndTagPeer::TAG_ID, $this->tag_id);
		if ($this->isColumnModified(PhotoAndTagPeer::OPEN_FLAG)) $criteria->add(PhotoAndTagPeer::OPEN_FLAG, $this->open_flag);
		if ($this->isColumnModified(PhotoAndTagPeer::ID)) $criteria->add(PhotoAndTagPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PhotoAndTagPeer::DATABASE_NAME);

		$criteria->add(PhotoAndTagPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setPhotoId($this->photo_id);

		$copyObj->setTagId($this->tag_id);

		$copyObj->setOpenFlag($this->open_flag);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new PhotoAndTagPeer();
		}
		return self::$peer;
	}

} 