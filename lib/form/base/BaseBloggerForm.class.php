<?php

/**
 * Blogger form base class.
 *
 * @method Blogger getObject() Returns the current form's model object
 *
 * @package    okinawa
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseBloggerForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'url'         => new sfWidgetFormInputText(),
      'last_access' => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'Blogger', 'column' => 'id', 'required' => false)),
      'url'         => new sfValidatorString(array('max_length' => 64)),
      'last_access' => new sfValidatorDate(),
    ));

    $this->widgetSchema->setNameFormat('blogger[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Blogger';
  }


}
