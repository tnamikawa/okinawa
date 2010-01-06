<?php

/**
 * tool actions.
 *
 * @package    okinawa
 * @subpackage tool
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class toolActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->Photos = PhotoPeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new PhotoForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new PhotoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($Photo = PhotoPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Photo does not exist (%s).', $request->getParameter('id')));
    $this->form = new PhotoForm($Photo);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($Photo = PhotoPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Photo does not exist (%s).', $request->getParameter('id')));
    $this->form = new PhotoForm($Photo);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($Photo = PhotoPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Photo does not exist (%s).', $request->getParameter('id')));
    $Photo->delete();

    $this->redirect('tool/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $Photo = $form->save();

      $this->redirect('tool/edit?id='.$Photo->getId());
    }
  }
}
