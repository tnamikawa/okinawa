<?php

/**
 * SeoLink filter form base class.
 *
 * @package    okinawa
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseSeoLinkFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'linkstr' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'linkstr' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('seo_link_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SeoLink';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'linkstr' => 'Text',
    );
  }
}
