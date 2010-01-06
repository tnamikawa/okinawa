<?php

/**
 * ViewLog filter form base class.
 *
 * @package    okinawa
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseViewLogFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'photo_id'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ipaddress'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'photo_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ipaddress'  => new sfValidatorPass(array('required' => false)),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('view_log_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ViewLog';
  }

  public function getFields()
  {
    return array(
      'photo_id'   => 'Number',
      'ipaddress'  => 'Text',
      'created_at' => 'Date',
      'id'         => 'Number',
    );
  }
}
