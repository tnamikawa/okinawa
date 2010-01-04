<?php

/**
 * BlogPhoto form base class.
 *
 * @method BlogPhoto getObject() Returns the current form's model object
 *
 * @package    okinawa
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseBlogPhotoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'photo_id' => new sfWidgetFormInputText(),
      'use_date' => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorPropelChoice(array('model' => 'BlogPhoto', 'column' => 'id', 'required' => false)),
      'photo_id' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'use_date' => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('blog_photo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BlogPhoto';
  }


}
