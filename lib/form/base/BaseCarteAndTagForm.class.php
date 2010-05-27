<?php

/**
 * CarteAndTag form base class.
 *
 * @method CarteAndTag getObject() Returns the current form's model object
 *
 * @package    okinawa
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseCarteAndTagForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'carte_id' => new sfWidgetFormInputText(),
      'tag_id'   => new sfWidgetFormInputText(),
      'id'       => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'carte_id' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'tag_id'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'id'       => new sfValidatorPropelChoice(array('model' => 'CarteAndTag', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('carte_and_tag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CarteAndTag';
  }


}
