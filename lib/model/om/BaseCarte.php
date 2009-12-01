<?php


abstract class BaseCarte extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $title;


	
	protected $englishtitle;


	
	protected $filename;


	
	protected $comment;


	
	protected $width;


	
	protected $height;


	
	protected $thumb_width;


	
	protected $thumb_height;


	
	protected $ins_date;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getTitle()
	{

		return $this->title;
	}

	
	public function getEnglishtitle()
	{

		return $this->englishtitle;
	}

	
	public function getFilename()
	{

		return $this->filename;
	}

	
	public function getComment()
	{

		return $this->comment;
	}

	
	public function getWidth()
	{

		return $this->width;
	}

	
	public function getHeight()
	{

		return $this->height;
	}

	
	public function getThumbWidth()
	{

		return $this->thumb_width;
	}

	
	public function getThumbHeight()
	{

		return $this->thumb_height;
	}

	
	public function getInsDate($format = 'Y-m-d')
	{

		if ($this->ins_date === null || $this->ins_date === '') {
			return null;
		} elseif (!is_int($this->ins_date)) {
						$ts = strtotime($this->ins_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [ins_date] as date/time value: " . var_export($this->ins_date, true));
			}
		} else {
			$ts = $this->ins_date;
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
			$this->modifiedColumns[] = CartePeer::ID;
		}

	} 
	
	public function setTitle($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = CartePeer::TITLE;
		}

	} 
	
	public function setEnglishtitle($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->englishtitle !== $v) {
			$this->englishtitle = $v;
			$this->modifiedColumns[] = CartePeer::ENGLISHTITLE;
		}

	} 
	
	public function setFilename($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->filename !== $v) {
			$this->filename = $v;
			$this->modifiedColumns[] = CartePeer::FILENAME;
		}

	} 
	
	public function setComment($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->comment !== $v) {
			$this->comment = $v;
			$this->modifiedColumns[] = CartePeer::COMMENT;
		}

	} 
	
	public function setWidth($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->width !== $v) {
			$this->width = $v;
			$this->modifiedColumns[] = CartePeer::WIDTH;
		}

	} 
	
	public function setHeight($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->height !== $v) {
			$this->height = $v;
			$this->modifiedColumns[] = CartePeer::HEIGHT;
		}

	} 
	
	public function setThumbWidth($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->thumb_width !== $v) {
			$this->thumb_width = $v;
			$this->modifiedColumns[] = CartePeer::THUMB_WIDTH;
		}

	} 
	
	public function setThumbHeight($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->thumb_height !== $v) {
			$this->thumb_height = $v;
			$this->modifiedColumns[] = CartePeer::THUMB_HEIGHT;
		}

	} 
	
	public function setInsDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [ins_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ins_date !== $ts) {
			$this->ins_date = $ts;
			$this->modifiedColumns[] = CartePeer::INS_DATE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->title = $rs->getString($startcol + 1);

			$this->englishtitle = $rs->getString($startcol + 2);

			$this->filename = $rs->getString($startcol + 3);

			$this->comment = $rs->getString($startcol + 4);

			$this->width = $rs->getInt($startcol + 5);

			$this->height = $rs->getInt($startcol + 6);

			$this->thumb_width = $rs->getInt($startcol + 7);

			$this->thumb_height = $rs->getInt($startcol + 8);

			$this->ins_date = $rs->getDate($startcol + 9, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Carte object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CartePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			CartePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(CartePeer::DATABASE_NAME);
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
					$pk = CartePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += CartePeer::doUpdate($this, $con);
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


			if (($retval = CartePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CartePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getTitle();
				break;
			case 2:
				return $this->getEnglishtitle();
				break;
			case 3:
				return $this->getFilename();
				break;
			case 4:
				return $this->getComment();
				break;
			case 5:
				return $this->getWidth();
				break;
			case 6:
				return $this->getHeight();
				break;
			case 7:
				return $this->getThumbWidth();
				break;
			case 8:
				return $this->getThumbHeight();
				break;
			case 9:
				return $this->getInsDate();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CartePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTitle(),
			$keys[2] => $this->getEnglishtitle(),
			$keys[3] => $this->getFilename(),
			$keys[4] => $this->getComment(),
			$keys[5] => $this->getWidth(),
			$keys[6] => $this->getHeight(),
			$keys[7] => $this->getThumbWidth(),
			$keys[8] => $this->getThumbHeight(),
			$keys[9] => $this->getInsDate(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CartePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTitle($value);
				break;
			case 2:
				$this->setEnglishtitle($value);
				break;
			case 3:
				$this->setFilename($value);
				break;
			case 4:
				$this->setComment($value);
				break;
			case 5:
				$this->setWidth($value);
				break;
			case 6:
				$this->setHeight($value);
				break;
			case 7:
				$this->setThumbWidth($value);
				break;
			case 8:
				$this->setThumbHeight($value);
				break;
			case 9:
				$this->setInsDate($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CartePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setEnglishtitle($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setFilename($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setComment($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setWidth($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setHeight($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setThumbWidth($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setThumbHeight($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setInsDate($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CartePeer::DATABASE_NAME);

		if ($this->isColumnModified(CartePeer::ID)) $criteria->add(CartePeer::ID, $this->id);
		if ($this->isColumnModified(CartePeer::TITLE)) $criteria->add(CartePeer::TITLE, $this->title);
		if ($this->isColumnModified(CartePeer::ENGLISHTITLE)) $criteria->add(CartePeer::ENGLISHTITLE, $this->englishtitle);
		if ($this->isColumnModified(CartePeer::FILENAME)) $criteria->add(CartePeer::FILENAME, $this->filename);
		if ($this->isColumnModified(CartePeer::COMMENT)) $criteria->add(CartePeer::COMMENT, $this->comment);
		if ($this->isColumnModified(CartePeer::WIDTH)) $criteria->add(CartePeer::WIDTH, $this->width);
		if ($this->isColumnModified(CartePeer::HEIGHT)) $criteria->add(CartePeer::HEIGHT, $this->height);
		if ($this->isColumnModified(CartePeer::THUMB_WIDTH)) $criteria->add(CartePeer::THUMB_WIDTH, $this->thumb_width);
		if ($this->isColumnModified(CartePeer::THUMB_HEIGHT)) $criteria->add(CartePeer::THUMB_HEIGHT, $this->thumb_height);
		if ($this->isColumnModified(CartePeer::INS_DATE)) $criteria->add(CartePeer::INS_DATE, $this->ins_date);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CartePeer::DATABASE_NAME);

		$criteria->add(CartePeer::ID, $this->id);

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

		$copyObj->setTitle($this->title);

		$copyObj->setEnglishtitle($this->englishtitle);

		$copyObj->setFilename($this->filename);

		$copyObj->setComment($this->comment);

		$copyObj->setWidth($this->width);

		$copyObj->setHeight($this->height);

		$copyObj->setThumbWidth($this->thumb_width);

		$copyObj->setThumbHeight($this->thumb_height);

		$copyObj->setInsDate($this->ins_date);


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
			self::$peer = new CartePeer();
		}
		return self::$peer;
	}

} 