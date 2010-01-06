<?php

/**
 * Tag form base class.
 *
 * @method Tag getObject() Returns the current form's model object
 *
 * @package    okinawa
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseTagForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'title'          => new sfWidgetFormInputText(),
      'englishtitle'   => new sfWidgetFormInputText(),
      'filename'       => new sfWidgetFormInputText(),
      'description'    => new sfWidgetFormInputText(),
      'order_priority' => new sfWidgetFormInputText(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorPropelChoice(array('model' => 'Tag', 'column' => 'id', 'required' => false)),
      'title'          => new sfValidatorString(array('max_length' => 255)),
      'englishtitle'   => new sfValidatorString(array('max_length' => 255)),
      'filename'       => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'description'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'order_priority' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'     => new sfValidatorDateTime(array('required' => false)),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tag';
  }


}
