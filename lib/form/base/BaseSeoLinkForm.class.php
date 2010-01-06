<?php

/**
 * SeoLink form base class.
 *
 * @method SeoLink getObject() Returns the current form's model object
 *
 * @package    okinawa
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseSeoLinkForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'linkstr' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorPropelChoice(array('model' => 'SeoLink', 'column' => 'id', 'required' => false)),
      'linkstr' => new sfValidatorString(array('max_length' => 255)),
    ));

    $this->widgetSchema->setNameFormat('seo_link[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SeoLink';
  }


}
