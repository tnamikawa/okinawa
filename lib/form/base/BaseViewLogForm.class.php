<?php

/**
 * ViewLog form base class.
 *
 * @method ViewLog getObject() Returns the current form's model object
 *
 * @package    okinawa
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseViewLogForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'photo_id'   => new sfWidgetFormInputText(),
      'ipaddress'  => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'id'         => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'photo_id'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'ipaddress'  => new sfValidatorString(array('max_length' => 15)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'id'         => new sfValidatorPropelChoice(array('model' => 'ViewLog', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('view_log[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ViewLog';
  }


}
