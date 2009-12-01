<?php


abstract class BasePhoto extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $title;


	
	protected $filename;


	
	protected $comment;


	
	protected $width;


	
	protected $height;


	
	protected $thumb_width;


	
	protected $thumb_height;


	
	protected $icon_width;


	
	protected $icon_height;


	
	protected $wander_width;


	
	protected $wander_height;


	
	protected $slide_width;


	
	protected $slide_height;


	
	protected $longitude;


	
	protected $latitude;


	
	protected $shot_date;


	
	protected $open_date;


	
	protected $modified_date;


	
	protected $metamodified_date;


	
	protected $filemtime;


	
	protected $created_at;


	
	protected $updated_at;

	
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

	
	public function getIconWidth()
	{

		return $this->icon_width;
	}

	
	public function getIconHeight()
	{

		return $this->icon_height;
	}

	
	public function getWanderWidth()
	{

		return $this->wander_width;
	}

	
	public function getWanderHeight()
	{

		return $this->wander_height;
	}

	
	public function getSlideWidth()
	{

		return $this->slide_width;
	}

	
	public function getSlideHeight()
	{

		return $this->slide_height;
	}

	
	public function getLongitude()
	{

		return $this->longitude;
	}

	
	public function getLatitude()
	{

		return $this->latitude;
	}

	
	public function getShotDate($format = 'Y-m-d H:i:s')
	{

		if ($this->shot_date === null || $this->shot_date === '') {
			return null;
		} elseif (!is_int($this->shot_date)) {
						$ts = strtotime($this->shot_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [shot_date] as date/time value: " . var_export($this->shot_date, true));
			}
		} else {
			$ts = $this->shot_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getOpenDate($format = 'Y-m-d')
	{

		if ($this->open_date === null || $this->open_date === '') {
			return null;
		} elseif (!is_int($this->open_date)) {
						$ts = strtotime($this->open_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [open_date] as date/time value: " . var_export($this->open_date, true));
			}
		} else {
			$ts = $this->open_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getModifiedDate($format = 'Y-m-d H:i:s')
	{

		if ($this->modified_date === null || $this->modified_date === '') {
			return null;
		} elseif (!is_int($this->modified_date)) {
						$ts = strtotime($this->modified_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [modified_date] as date/time value: " . var_export($this->modified_date, true));
			}
		} else {
			$ts = $this->modified_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getMetamodifiedDate($format = 'Y-m-d H:i:s')
	{

		if ($this->metamodified_date === null || $this->metamodified_date === '') {
			return null;
		} elseif (!is_int($this->metamodified_date)) {
						$ts = strtotime($this->metamodified_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [metamodified_date] as date/time value: " . var_export($this->metamodified_date, true));
			}
		} else {
			$ts = $this->metamodified_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getFilemtime($format = 'Y-m-d H:i:s')
	{

		if ($this->filemtime === null || $this->filemtime === '') {
			return null;
		} elseif (!is_int($this->filemtime)) {
						$ts = strtotime($this->filemtime);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [filemtime] as date/time value: " . var_export($this->filemtime, true));
			}
		} else {
			$ts = $this->filemtime;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
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
			$this->modifiedColumns[] = PhotoPeer::ID;
		}

	} 
	
	public function setTitle($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = PhotoPeer::TITLE;
		}

	} 
	
	public function setFilename($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->filename !== $v) {
			$this->filename = $v;
			$this->modifiedColumns[] = PhotoPeer::FILENAME;
		}

	} 
	
	public function setComment($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->comment !== $v) {
			$this->comment = $v;
			$this->modifiedColumns[] = PhotoPeer::COMMENT;
		}

	} 
	
	public function setWidth($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->width !== $v) {
			$this->width = $v;
			$this->modifiedColumns[] = PhotoPeer::WIDTH;
		}

	} 
	
	public function setHeight($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->height !== $v) {
			$this->height = $v;
			$this->modifiedColumns[] = PhotoPeer::HEIGHT;
		}

	} 
	
	public function setThumbWidth($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->thumb_width !== $v) {
			$this->thumb_width = $v;
			$this->modifiedColumns[] = PhotoPeer::THUMB_WIDTH;
		}

	} 
	
	public function setThumbHeight($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->thumb_height !== $v) {
			$this->thumb_height = $v;
			$this->modifiedColumns[] = PhotoPeer::THUMB_HEIGHT;
		}

	} 
	
	public function setIconWidth($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->icon_width !== $v) {
			$this->icon_width = $v;
			$this->modifiedColumns[] = PhotoPeer::ICON_WIDTH;
		}

	} 
	
	public function setIconHeight($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->icon_height !== $v) {
			$this->icon_height = $v;
			$this->modifiedColumns[] = PhotoPeer::ICON_HEIGHT;
		}

	} 
	
	public function setWanderWidth($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->wander_width !== $v) {
			$this->wander_width = $v;
			$this->modifiedColumns[] = PhotoPeer::WANDER_WIDTH;
		}

	} 
	
	public function setWanderHeight($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->wander_height !== $v) {
			$this->wander_height = $v;
			$this->modifiedColumns[] = PhotoPeer::WANDER_HEIGHT;
		}

	} 
	
	public function setSlideWidth($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->slide_width !== $v) {
			$this->slide_width = $v;
			$this->modifiedColumns[] = PhotoPeer::SLIDE_WIDTH;
		}

	} 
	
	public function setSlideHeight($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->slide_height !== $v) {
			$this->slide_height = $v;
			$this->modifiedColumns[] = PhotoPeer::SLIDE_HEIGHT;
		}

	} 
	
	public function setLongitude($v)
	{

		if ($this->longitude !== $v) {
			$this->longitude = $v;
			$this->modifiedColumns[] = PhotoPeer::LONGITUDE;
		}

	} 
	
	public function setLatitude($v)
	{

		if ($this->latitude !== $v) {
			$this->latitude = $v;
			$this->modifiedColumns[] = PhotoPeer::LATITUDE;
		}

	} 
	
	public function setShotDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [shot_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->shot_date !== $ts) {
			$this->shot_date = $ts;
			$this->modifiedColumns[] = PhotoPeer::SHOT_DATE;
		}

	} 
	
	public function setOpenDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [open_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->open_date !== $ts) {
			$this->open_date = $ts;
			$this->modifiedColumns[] = PhotoPeer::OPEN_DATE;
		}

	} 
	
	public function setModifiedDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [modified_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->modified_date !== $ts) {
			$this->modified_date = $ts;
			$this->modifiedColumns[] = PhotoPeer::MODIFIED_DATE;
		}

	} 
	
	public function setMetamodifiedDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [metamodified_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->metamodified_date !== $ts) {
			$this->metamodified_date = $ts;
			$this->modifiedColumns[] = PhotoPeer::METAMODIFIED_DATE;
		}

	} 
	
	public function setFilemtime($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [filemtime] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->filemtime !== $ts) {
			$this->filemtime = $ts;
			$this->modifiedColumns[] = PhotoPeer::FILEMTIME;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = PhotoPeer::CREATED_AT;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = PhotoPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->title = $rs->getString($startcol + 1);

			$this->filename = $rs->getString($startcol + 2);

			$this->comment = $rs->getString($startcol + 3);

			$this->width = $rs->getInt($startcol + 4);

			$this->height = $rs->getInt($startcol + 5);

			$this->thumb_width = $rs->getInt($startcol + 6);

			$this->thumb_height = $rs->getInt($startcol + 7);

			$this->icon_width = $rs->getInt($startcol + 8);

			$this->icon_height = $rs->getInt($startcol + 9);

			$this->wander_width = $rs->getInt($startcol + 10);

			$this->wander_height = $rs->getInt($startcol + 11);

			$this->slide_width = $rs->getInt($startcol + 12);

			$this->slide_height = $rs->getInt($startcol + 13);

			$this->longitude = $rs->getFloat($startcol + 14);

			$this->latitude = $rs->getFloat($startcol + 15);

			$this->shot_date = $rs->getTimestamp($startcol + 16, null);

			$this->open_date = $rs->getDate($startcol + 17, null);

			$this->modified_date = $rs->getTimestamp($startcol + 18, null);

			$this->metamodified_date = $rs->getTimestamp($startcol + 19, null);

			$this->filemtime = $rs->getTimestamp($startcol + 20, null);

			$this->created_at = $rs->getTimestamp($startcol + 21, null);

			$this->updated_at = $rs->getTimestamp($startcol + 22, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 23; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Photo object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PhotoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PhotoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(PhotoPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(PhotoPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PhotoPeer::DATABASE_NAME);
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
					$pk = PhotoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PhotoPeer::doUpdate($this, $con);
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


			if (($retval = PhotoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PhotoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getFilename();
				break;
			case 3:
				return $this->getComment();
				break;
			case 4:
				return $this->getWidth();
				break;
			case 5:
				return $this->getHeight();
				break;
			case 6:
				return $this->getThumbWidth();
				break;
			case 7:
				return $this->getThumbHeight();
				break;
			case 8:
				return $this->getIconWidth();
				break;
			case 9:
				return $this->getIconHeight();
				break;
			case 10:
				return $this->getWanderWidth();
				break;
			case 11:
				return $this->getWanderHeight();
				break;
			case 12:
				return $this->getSlideWidth();
				break;
			case 13:
				return $this->getSlideHeight();
				break;
			case 14:
				return $this->getLongitude();
				break;
			case 15:
				return $this->getLatitude();
				break;
			case 16:
				return $this->getShotDate();
				break;
			case 17:
				return $this->getOpenDate();
				break;
			case 18:
				return $this->getModifiedDate();
				break;
			case 19:
				return $this->getMetamodifiedDate();
				break;
			case 20:
				return $this->getFilemtime();
				break;
			case 21:
				return $this->getCreatedAt();
				break;
			case 22:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PhotoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTitle(),
			$keys[2] => $this->getFilename(),
			$keys[3] => $this->getComment(),
			$keys[4] => $this->getWidth(),
			$keys[5] => $this->getHeight(),
			$keys[6] => $this->getThumbWidth(),
			$keys[7] => $this->getThumbHeight(),
			$keys[8] => $this->getIconWidth(),
			$keys[9] => $this->getIconHeight(),
			$keys[10] => $this->getWanderWidth(),
			$keys[11] => $this->getWanderHeight(),
			$keys[12] => $this->getSlideWidth(),
			$keys[13] => $this->getSlideHeight(),
			$keys[14] => $this->getLongitude(),
			$keys[15] => $this->getLatitude(),
			$keys[16] => $this->getShotDate(),
			$keys[17] => $this->getOpenDate(),
			$keys[18] => $this->getModifiedDate(),
			$keys[19] => $this->getMetamodifiedDate(),
			$keys[20] => $this->getFilemtime(),
			$keys[21] => $this->getCreatedAt(),
			$keys[22] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PhotoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setFilename($value);
				break;
			case 3:
				$this->setComment($value);
				break;
			case 4:
				$this->setWidth($value);
				break;
			case 5:
				$this->setHeight($value);
				break;
			case 6:
				$this->setThumbWidth($value);
				break;
			case 7:
				$this->setThumbHeight($value);
				break;
			case 8:
				$this->setIconWidth($value);
				break;
			case 9:
				$this->setIconHeight($value);
				break;
			case 10:
				$this->setWanderWidth($value);
				break;
			case 11:
				$this->setWanderHeight($value);
				break;
			case 12:
				$this->setSlideWidth($value);
				break;
			case 13:
				$this->setSlideHeight($value);
				break;
			case 14:
				$this->setLongitude($value);
				break;
			case 15:
				$this->setLatitude($value);
				break;
			case 16:
				$this->setShotDate($value);
				break;
			case 17:
				$this->setOpenDate($value);
				break;
			case 18:
				$this->setModifiedDate($value);
				break;
			case 19:
				$this->setMetamodifiedDate($value);
				break;
			case 20:
				$this->setFilemtime($value);
				break;
			case 21:
				$this->setCreatedAt($value);
				break;
			case 22:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PhotoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFilename($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setComment($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setWidth($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setHeight($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setThumbWidth($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setThumbHeight($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIconWidth($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setIconHeight($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setWanderWidth($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setWanderHeight($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setSlideWidth($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setSlideHeight($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setLongitude($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setLatitude($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setShotDate($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setOpenDate($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setModifiedDate($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setMetamodifiedDate($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setFilemtime($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setCreatedAt($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setUpdatedAt($arr[$keys[22]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PhotoPeer::DATABASE_NAME);

		if ($this->isColumnModified(PhotoPeer::ID)) $criteria->add(PhotoPeer::ID, $this->id);
		if ($this->isColumnModified(PhotoPeer::TITLE)) $criteria->add(PhotoPeer::TITLE, $this->title);
		if ($this->isColumnModified(PhotoPeer::FILENAME)) $criteria->add(PhotoPeer::FILENAME, $this->filename);
		if ($this->isColumnModified(PhotoPeer::COMMENT)) $criteria->add(PhotoPeer::COMMENT, $this->comment);
		if ($this->isColumnModified(PhotoPeer::WIDTH)) $criteria->add(PhotoPeer::WIDTH, $this->width);
		if ($this->isColumnModified(PhotoPeer::HEIGHT)) $criteria->add(PhotoPeer::HEIGHT, $this->height);
		if ($this->isColumnModified(PhotoPeer::THUMB_WIDTH)) $criteria->add(PhotoPeer::THUMB_WIDTH, $this->thumb_width);
		if ($this->isColumnModified(PhotoPeer::THUMB_HEIGHT)) $criteria->add(PhotoPeer::THUMB_HEIGHT, $this->thumb_height);
		if ($this->isColumnModified(PhotoPeer::ICON_WIDTH)) $criteria->add(PhotoPeer::ICON_WIDTH, $this->icon_width);
		if ($this->isColumnModified(PhotoPeer::ICON_HEIGHT)) $criteria->add(PhotoPeer::ICON_HEIGHT, $this->icon_height);
		if ($this->isColumnModified(PhotoPeer::WANDER_WIDTH)) $criteria->add(PhotoPeer::WANDER_WIDTH, $this->wander_width);
		if ($this->isColumnModified(PhotoPeer::WANDER_HEIGHT)) $criteria->add(PhotoPeer::WANDER_HEIGHT, $this->wander_height);
		if ($this->isColumnModified(PhotoPeer::SLIDE_WIDTH)) $criteria->add(PhotoPeer::SLIDE_WIDTH, $this->slide_width);
		if ($this->isColumnModified(PhotoPeer::SLIDE_HEIGHT)) $criteria->add(PhotoPeer::SLIDE_HEIGHT, $this->slide_height);
		if ($this->isColumnModified(PhotoPeer::LONGITUDE)) $criteria->add(PhotoPeer::LONGITUDE, $this->longitude);
		if ($this->isColumnModified(PhotoPeer::LATITUDE)) $criteria->add(PhotoPeer::LATITUDE, $this->latitude);
		if ($this->isColumnModified(PhotoPeer::SHOT_DATE)) $criteria->add(PhotoPeer::SHOT_DATE, $this->shot_date);
		if ($this->isColumnModified(PhotoPeer::OPEN_DATE)) $criteria->add(PhotoPeer::OPEN_DATE, $this->open_date);
		if ($this->isColumnModified(PhotoPeer::MODIFIED_DATE)) $criteria->add(PhotoPeer::MODIFIED_DATE, $this->modified_date);
		if ($this->isColumnModified(PhotoPeer::METAMODIFIED_DATE)) $criteria->add(PhotoPeer::METAMODIFIED_DATE, $this->metamodified_date);
		if ($this->isColumnModified(PhotoPeer::FILEMTIME)) $criteria->add(PhotoPeer::FILEMTIME, $this->filemtime);
		if ($this->isColumnModified(PhotoPeer::CREATED_AT)) $criteria->add(PhotoPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(PhotoPeer::UPDATED_AT)) $criteria->add(PhotoPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PhotoPeer::DATABASE_NAME);

		$criteria->add(PhotoPeer::ID, $this->id);

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

		$copyObj->setFilename($this->filename);

		$copyObj->setComment($this->comment);

		$copyObj->setWidth($this->width);

		$copyObj->setHeight($this->height);

		$copyObj->setThumbWidth($this->thumb_width);

		$copyObj->setThumbHeight($this->thumb_height);

		$copyObj->setIconWidth($this->icon_width);

		$copyObj->setIconHeight($this->icon_height);

		$copyObj->setWanderWidth($this->wander_width);

		$copyObj->setWanderHeight($this->wander_height);

		$copyObj->setSlideWidth($this->slide_width);

		$copyObj->setSlideHeight($this->slide_height);

		$copyObj->setLongitude($this->longitude);

		$copyObj->setLatitude($this->latitude);

		$copyObj->setShotDate($this->shot_date);

		$copyObj->setOpenDate($this->open_date);

		$copyObj->setModifiedDate($this->modified_date);

		$copyObj->setMetamodifiedDate($this->metamodified_date);

		$copyObj->setFilemtime($this->filemtime);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


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
			self::$peer = new PhotoPeer();
		}
		return self::$peer;
	}

} 