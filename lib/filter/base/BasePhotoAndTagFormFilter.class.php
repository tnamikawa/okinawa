<?php

/**
 * PhotoAndTag filter form base class.
 *
 * @package    okinawa
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BasePhotoAndTagFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'photo_id'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tag_id'    => new sfWidgetFormFilterInput(),
      'open_flag' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'photo_id'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tag_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'open_flag' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('photo_and_tag_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PhotoAndTag';
  }

  public function getFields()
  {
    return array(
      'photo_id'  => 'Number',
      'tag_id'    => 'Number',
      'open_flag' => 'Number',
      'id'        => 'Number',
    );
  }
}
