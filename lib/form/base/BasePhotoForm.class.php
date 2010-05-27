<?php

/**
 * Photo form base class.
 *
 * @method Photo getObject() Returns the current form's model object
 *
 * @package    okinawa
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BasePhotoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'title'             => new sfWidgetFormInputText(),
      'filename'          => new sfWidgetFormInputText(),
      'comment'           => new sfWidgetFormInputText(),
      'width'             => new sfWidgetFormInputText(),
      'height'            => new sfWidgetFormInputText(),
      'thumb_width'       => new sfWidgetFormInputText(),
      'thumb_height'      => new sfWidgetFormInputText(),
      'icon_width'        => new sfWidgetFormInputText(),
      'icon_height'       => new sfWidgetFormInputText(),
      'wander_width'      => new sfWidgetFormInputText(),
      'wander_height'     => new sfWidgetFormInputText(),
      'slide_width'       => new sfWidgetFormInputText(),
      'slide_height'      => new sfWidgetFormInputText(),
      'longitude'         => new sfWidgetFormInputText(),
      'latitude'          => new sfWidgetFormInputText(),
      'shot_date'         => new sfWidgetFormDateTime(),
      'open_date'         => new sfWidgetFormDate(),
      'modified_date'     => new sfWidgetFormDateTime(),
      'metamodified_date' => new sfWidgetFormDateTime(),
      'filemtime'         => new sfWidgetFormDateTime(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorPropelChoice(array('model' => 'Photo', 'column' => 'id', 'required' => false)),
      'title'             => new sfValidatorString(array('max_length' => 255)),
      'filename'          => new sfValidatorString(array('max_length' => 64)),
      'comment'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'width'             => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'height'            => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'thumb_width'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'thumb_height'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'icon_width'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'icon_height'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'wander_width'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'wander_height'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'slide_width'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'slide_height'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'longitude'         => new sfValidatorNumber(array('required' => false)),
      'latitude'          => new sfValidatorNumber(array('required' => false)),
      'shot_date'         => new sfValidatorDateTime(array('required' => false)),
      'open_date'         => new sfValidatorDate(array('required' => false)),
      'modified_date'     => new sfValidatorDateTime(array('required' => false)),
      'metamodified_date' => new sfValidatorDateTime(array('required' => false)),
      'filemtime'         => new sfValidatorDateTime(array('required' => false)),
      'created_at'        => new sfValidatorDateTime(array('required' => false)),
      'updated_at'        => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorPropelUnique(array('model' => 'Photo', 'column' => array('filename'))),
        new sfValidatorPropelUnique(array('model' => 'Photo', 'column' => array('title'))),
      ))
    );

    $this->widgetSchema->setNameFormat('photo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Photo';
  }


}
