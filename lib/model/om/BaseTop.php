<?php


abstract class BaseTop extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $photo_id;


	
	protected $text_color;


	
	protected $link_color;

	
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

	
	public function getTextColor()
	{

		return $this->text_color;
	}

	
	public function getLinkColor()
	{

		return $this->link_color;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = TopPeer::ID;
		}

	} 
	
	public function setPhotoId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->photo_id !== $v) {
			$this->photo_id = $v;
			$this->modifiedColumns[] = TopPeer::PHOTO_ID;
		}

	} 
	
	public function setTextColor($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->text_color !== $v) {
			$this->text_color = $v;
			$this->modifiedColumns[] = TopPeer::TEXT_COLOR;
		}

	} 
	
	public function setLinkColor($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->link_color !== $v) {
			$this->link_color = $v;
			$this->modifiedColumns[] = TopPeer::LINK_COLOR;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->photo_id = $rs->getInt($startcol + 1);

			$this->text_color = $rs->getString($startcol + 2);

			$this->link_color = $rs->getString($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Top object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TopPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TopPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(TopPeer::DATABASE_NAME);
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
					$pk = TopPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TopPeer::doUpdate($this, $con);
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


			if (($retval = TopPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TopPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getTextColor();
				break;
			case 3:
				return $this->getLinkColor();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TopPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPhotoId(),
			$keys[2] => $this->getTextColor(),
			$keys[3] => $this->getLinkColor(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TopPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setTextColor($value);
				break;
			case 3:
				$this->setLinkColor($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TopPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPhotoId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTextColor($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setLinkColor($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TopPeer::DATABASE_NAME);

		if ($this->isColumnModified(TopPeer::ID)) $criteria->add(TopPeer::ID, $this->id);
		if ($this->isColumnModified(TopPeer::PHOTO_ID)) $criteria->add(TopPeer::PHOTO_ID, $this->photo_id);
		if ($this->isColumnModified(TopPeer::TEXT_COLOR)) $criteria->add(TopPeer::TEXT_COLOR, $this->text_color);
		if ($this->isColumnModified(TopPeer::LINK_COLOR)) $criteria->add(TopPeer::LINK_COLOR, $this->link_color);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TopPeer::DATABASE_NAME);

		$criteria->add(TopPeer::ID, $this->id);

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

		$copyObj->setTextColor($this->text_color);

		$copyObj->setLinkColor($this->link_color);


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
			self::$peer = new TopPeer();
		}
		return self::$peer;
	}

} 