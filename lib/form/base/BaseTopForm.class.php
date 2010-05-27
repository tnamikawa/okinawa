<?php

/**
 * Top form base class.
 *
 * @method Top getObject() Returns the current form's model object
 *
 * @package    okinawa
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseTopForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'photo_id'   => new sfWidgetFormInputText(),
      'text_color' => new sfWidgetFormInputText(),
      'link_color' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'Top', 'column' => 'id', 'required' => false)),
      'photo_id'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'text_color' => new sfValidatorString(array('max_length' => 7)),
      'link_color' => new sfValidatorString(array('max_length' => 7)),
    ));

    $this->widgetSchema->setNameFormat('top[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Top';
  }


}
