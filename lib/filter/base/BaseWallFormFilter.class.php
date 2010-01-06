<?php

/**
 * Wall filter form base class.
 *
 * @package    okinawa
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseWallFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'photo_id' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'photo_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('wall_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Wall';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'photo_id' => 'Number',
    );
  }
}
