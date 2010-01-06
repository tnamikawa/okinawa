<?php

/**
 * Photo filter form base class.
 *
 * @package    okinawa
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BasePhotoFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'filename'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'comment'           => new sfWidgetFormFilterInput(),
      'width'             => new sfWidgetFormFilterInput(),
      'height'            => new sfWidgetFormFilterInput(),
      'thumb_width'       => new sfWidgetFormFilterInput(),
      'thumb_height'      => new sfWidgetFormFilterInput(),
      'icon_width'        => new sfWidgetFormFilterInput(),
      'icon_height'       => new sfWidgetFormFilterInput(),
      'wander_width'      => new sfWidgetFormFilterInput(),
      'wander_height'     => new sfWidgetFormFilterInput(),
      'slide_width'       => new sfWidgetFormFilterInput(),
      'slide_height'      => new sfWidgetFormFilterInput(),
      'longitude'         => new sfWidgetFormFilterInput(),
      'latitude'          => new sfWidgetFormFilterInput(),
      'shot_date'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'open_date'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'modified_date'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'metamodified_date' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'filemtime'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'title'             => new sfValidatorPass(array('required' => false)),
      'filename'          => new sfValidatorPass(array('required' => false)),
      'comment'           => new sfValidatorPass(array('required' => false)),
      'width'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'height'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'thumb_width'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'thumb_height'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'icon_width'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'icon_height'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'wander_width'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'wander_height'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'slide_width'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'slide_height'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'longitude'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'latitude'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'shot_date'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'open_date'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'modified_date'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'metamodified_date' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'filemtime'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('photo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Photo';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'title'             => 'Text',
      'filename'          => 'Text',
      'comment'           => 'Text',
      'width'             => 'Number',
      'height'            => 'Number',
      'thumb_width'       => 'Number',
      'thumb_height'      => 'Number',
      'icon_width'        => 'Number',
      'icon_height'       => 'Number',
      'wander_width'      => 'Number',
      'wander_height'     => 'Number',
      'slide_width'       => 'Number',
      'slide_height'      => 'Number',
      'longitude'         => 'Number',
      'latitude'          => 'Number',
      'shot_date'         => 'Date',
      'open_date'         => 'Date',
      'modified_date'     => 'Date',
      'metamodified_date' => 'Date',
      'filemtime'         => 'Date',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
    );
  }
}
