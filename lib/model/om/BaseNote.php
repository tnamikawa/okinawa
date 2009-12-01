<?php


abstract class BaseNote extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $photo_id;


	
	protected $name;


	
	protected $content;


	
	protected $font_family;


	
	protected $font_size;


	
	protected $write_date;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getPhotoId()
	{

		return $this->photo_id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getContent()
	{

		return $this->content;
	}

	
	public function getFontFamily()
	{

		return $this->font_family;
	}

	
	public function getFontSize()
	{

		return $this->font_size;
	}

	
	public function getWriteDate($format = 'Y-m-d H:i:s')
	{

		if ($this->write_date === null || $this->write_date === '') {
			return null;
		} elseif (!is_int($this->write_date)) {
						$ts = strtotime($this->write_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [write_date] as date/time value: " . var_export($this->write_date, true));
			}
		} else {
			$ts = $this->write_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = NotePeer::ID;
		}

	} 
	
	public function setPhotoId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->photo_id !== $v) {
			$this->photo_id = $v;
			$this->modifiedColumns[] = NotePeer::PHOTO_ID;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = NotePeer::NAME;
		}

	} 
	
	public function setContent($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->content !== $v) {
			$this->content = $v;
			$this->modifiedColumns[] = NotePeer::CONTENT;
		}

	} 
	
	public function setFontFamily($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->font_family !== $v) {
			$this->font_family = $v;
			$this->modifiedColumns[] = NotePeer::FONT_FAMILY;
		}

	} 
	
	public function setFontSize($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->font_size !== $v) {
			$this->font_size = $v;
			$this->modifiedColumns[] = NotePeer::FONT_SIZE;
		}

	} 
	
	public function setWriteDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [write_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->write_date !== $ts) {
			$this->write_date = $ts;
			$this->modifiedColumns[] = NotePeer::WRITE_DATE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->photo_id = $rs->getInt($startcol + 1);

			$this->name = $rs->getString($startcol + 2);

			$this->content = $rs->getString($startcol + 3);

			$this->font_family = $rs->getInt($startcol + 4);

			$this->font_size = $rs->getInt($startcol + 5);

			$this->write_date = $rs->getTimestamp($startcol + 6, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Note object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(NotePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			NotePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(NotePeer::DATABASE_NAME);
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
					$pk = NotePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += NotePeer::doUpdate($this, $con);
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


			if (($retval = NotePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = NotePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getPhotoId();
				break;
			case 2:
				return $this->getName();
				break;
			case 3:
				return $this->getContent();
				break;
			case 4:
				return $this->getFontFamily();
				break;
			case 5:
				return $this->getFontSize();
				break;
			case 6:
				return $this->getWriteDate();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = NotePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPhotoId(),
			$keys[2] => $this->getName(),
			$keys[3] => $this->getContent(),
			$keys[4] => $this->getFontFamily(),
			$keys[5] => $this->getFontSize(),
			$keys[6] => $this->getWriteDate(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = NotePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setPhotoId($value);
				break;
			case 2:
				$this->setName($value);
				break;
			case 3:
				$this->setContent($value);
				break;
			case 4:
				$this->setFontFamily($value);
				break;
			case 5:
				$this->setFontSize($value);
				break;
			case 6:
				$this->setWriteDate($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = NotePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPhotoId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setContent($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFontFamily($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setFontSize($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setWriteDate($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(NotePeer::DATABASE_NAME);

		if ($this->isColumnModified(NotePeer::ID)) $criteria->add(NotePeer::ID, $this->id);
		if ($this->isColumnModified(NotePeer::PHOTO_ID)) $criteria->add(NotePeer::PHOTO_ID, $this->photo_id);
		if ($this->isColumnModified(NotePeer::NAME)) $criteria->add(NotePeer::NAME, $this->name);
		if ($this->isColumnModified(NotePeer::CONTENT)) $criteria->add(NotePeer::CONTENT, $this->content);
		if ($this->isColumnModified(NotePeer::FONT_FAMILY)) $criteria->add(NotePeer::FONT_FAMILY, $this->font_family);
		if ($this->isColumnModified(NotePeer::FONT_SIZE)) $criteria->add(NotePeer::FONT_SIZE, $this->font_size);
		if ($this->isColumnModified(NotePeer::WRITE_DATE)) $criteria->add(NotePeer::WRITE_DATE, $this->write_date);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(NotePeer::DATABASE_NAME);

		$criteria->add(NotePeer::ID, $this->id);

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

		$copyObj->setName($this->name);

		$copyObj->setContent($this->content);

		$copyObj->setFontFamily($this->font_family);

		$copyObj->setFontSize($this->font_size);

		$copyObj->setWriteDate($this->write_date);


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
			self::$peer = new NotePeer();
		}
		return self::$peer;
	}

} 