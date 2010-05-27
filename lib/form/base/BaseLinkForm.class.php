<?php

/**
 * Link form base class.
 *
 * @method Link getObject() Returns the current form's model object
 *
 * @package    okinawa
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseLinkForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'url'         => new sfWidgetFormInputText(),
      'title'       => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormInputText(),
      'category_id' => new sfWidgetFormInputText(),
      'inserted_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'Link', 'column' => 'id', 'required' => false)),
      'url'         => new sfValidatorString(array('max_length' => 255)),
      'title'       => new sfValidatorString(array('max_length' => 64)),
      'description' => new sfValidatorString(array('max_length' => 255)),
      'category_id' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'inserted_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('link[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Link';
  }


}
