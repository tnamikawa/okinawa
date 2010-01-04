<?php

/**
 * PhotoAndTag form base class.
 *
 * @method PhotoAndTag getObject() Returns the current form's model object
 *
 * @package    okinawa
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BasePhotoAndTagForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'photo_id'  => new sfWidgetFormInputText(),
      'tag_id'    => new sfWidgetFormInputText(),
      'open_flag' => new sfWidgetFormInputText(),
      'id'        => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'photo_id'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'tag_id'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'open_flag' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'id'        => new sfValidatorPropelChoice(array('model' => 'PhotoAndTag', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('photo_and_tag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PhotoAndTag';
  }


}
