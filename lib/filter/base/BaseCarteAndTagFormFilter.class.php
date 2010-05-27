<?php

/**
 * CarteAndTag filter form base class.
 *
 * @package    okinawa
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseCarteAndTagFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'carte_id' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tag_id'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'carte_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tag_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('carte_and_tag_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CarteAndTag';
  }

  public function getFields()
  {
    return array(
      'carte_id' => 'Number',
      'tag_id'   => 'Number',
      'id'       => 'Number',
    );
  }
}
