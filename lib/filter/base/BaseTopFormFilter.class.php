<?php

/**
 * Top filter form base class.
 *
 * @package    okinawa
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseTopFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'photo_id'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'text_color' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'link_color' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'photo_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'text_color' => new sfValidatorPass(array('required' => false)),
      'link_color' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('top_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Top';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'photo_id'   => 'Number',
      'text_color' => 'Text',
      'link_color' => 'Text',
    );
  }
}
