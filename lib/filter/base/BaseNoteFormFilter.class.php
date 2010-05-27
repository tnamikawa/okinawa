<?php

/**
 * Note filter form base class.
 *
 * @package    okinawa
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseNoteFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'photo_id'    => new sfWidgetFormFilterInput(),
      'name'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'content'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'font_family' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'font_size'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'write_date'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'photo_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'name'        => new sfValidatorPass(array('required' => false)),
      'content'     => new sfValidatorPass(array('required' => false)),
      'font_family' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'font_size'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'write_date'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('note_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Note';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'photo_id'    => 'Number',
      'name'        => 'Text',
      'content'     => 'Text',
      'font_family' => 'Number',
      'font_size'   => 'Number',
      'write_date'  => 'Date',
    );
  }
}
