<?php

/**
 * Note form base class.
 *
 * @method Note getObject() Returns the current form's model object
 *
 * @package    okinawa
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseNoteForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'photo_id'    => new sfWidgetFormInputText(),
      'name'        => new sfWidgetFormInputText(),
      'content'     => new sfWidgetFormTextarea(),
      'font_family' => new sfWidgetFormInputText(),
      'font_size'   => new sfWidgetFormInputText(),
      'write_date'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'Note', 'column' => 'id', 'required' => false)),
      'photo_id'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 64)),
      'content'     => new sfValidatorString(),
      'font_family' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'font_size'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'write_date'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('note[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Note';
  }


}
