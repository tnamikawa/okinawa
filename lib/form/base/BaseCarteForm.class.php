<?php

/**
 * Carte form base class.
 *
 * @method Carte getObject() Returns the current form's model object
 *
 * @package    okinawa
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseCarteForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'title'        => new sfWidgetFormInputText(),
      'englishtitle' => new sfWidgetFormInputText(),
      'filename'     => new sfWidgetFormInputText(),
      'comment'      => new sfWidgetFormInputText(),
      'width'        => new sfWidgetFormInputText(),
      'height'       => new sfWidgetFormInputText(),
      'thumb_width'  => new sfWidgetFormInputText(),
      'thumb_height' => new sfWidgetFormInputText(),
      'ins_date'     => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorPropelChoice(array('model' => 'Carte', 'column' => 'id', 'required' => false)),
      'title'        => new sfValidatorString(array('max_length' => 255)),
      'englishtitle' => new sfValidatorString(array('max_length' => 255)),
      'filename'     => new sfValidatorString(array('max_length' => 64)),
      'comment'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'width'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'height'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'thumb_width'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'thumb_height' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'ins_date'     => new sfValidatorDate(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorPropelUnique(array('model' => 'Carte', 'column' => array('filename'))),
        new sfValidatorPropelUnique(array('model' => 'Carte', 'column' => array('title'))),
      ))
    );

    $this->widgetSchema->setNameFormat('carte[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Carte';
  }


}
