<?php

/**
 * Carte filter form base class.
 *
 * @package    okinawa
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseCarteFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'englishtitle' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'filename'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'comment'      => new sfWidgetFormFilterInput(),
      'width'        => new sfWidgetFormFilterInput(),
      'height'       => new sfWidgetFormFilterInput(),
      'thumb_width'  => new sfWidgetFormFilterInput(),
      'thumb_height' => new sfWidgetFormFilterInput(),
      'ins_date'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'title'        => new sfValidatorPass(array('required' => false)),
      'englishtitle' => new sfValidatorPass(array('required' => false)),
      'filename'     => new sfValidatorPass(array('required' => false)),
      'comment'      => new sfValidatorPass(array('required' => false)),
      'width'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'height'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'thumb_width'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'thumb_height' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ins_date'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('carte_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Carte';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'title'        => 'Text',
      'englishtitle' => 'Text',
      'filename'     => 'Text',
      'comment'      => 'Text',
      'width'        => 'Number',
      'height'       => 'Number',
      'thumb_width'  => 'Number',
      'thumb_height' => 'Number',
      'ins_date'     => 'Date',
    );
  }
}
