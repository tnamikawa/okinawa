<?php
// auto-generated by sfViewConfigHandler
// date: 2010/01/04 07:54:18
$response = $this->context->getResponse();

if ($this->actionName.$this->viewName == 'placeSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'withinmapSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'photoinmapSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'keywordphotosSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'keywordpageSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'blogphotoSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'xmlreadSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'wanderupdateSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'mapthumbnailSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'addlinkSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'ajaxgetphotoSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'ajaxthumblistSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}

if ($templateName.$this->viewName == 'placeSuccess')
{
  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);
  $response->addMeta('title', '沖縄写真旅行', false, false);
  $response->addMeta('robots', 'index, follow', false, false);
  $response->addMeta('description', '沖縄の写真を多数掲載。', false, false);
  $response->addMeta('keywords', '沖縄,写真,写真集', false, false);
  $response->addMeta('language', 'ja', false, false);

  $response->addStylesheet('main', '', array ());
}
else if ($templateName.$this->viewName == 'withinmapSuccess')
{
  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);
  $response->addMeta('title', '沖縄写真旅行', false, false);
  $response->addMeta('robots', 'index, follow', false, false);
  $response->addMeta('description', '沖縄の写真を多数掲載。', false, false);
  $response->addMeta('keywords', '沖縄,写真,写真集', false, false);
  $response->addMeta('language', 'ja', false, false);

  $response->addStylesheet('main', '', array ());
}
else if ($templateName.$this->viewName == 'photoinmapSuccess')
{
  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);
  $response->addMeta('title', '沖縄写真旅行', false, false);
  $response->addMeta('robots', 'index, follow', false, false);
  $response->addMeta('description', '沖縄の写真を多数掲載。', false, false);
  $response->addMeta('keywords', '沖縄,写真,写真集', false, false);
  $response->addMeta('language', 'ja', false, false);

  $response->addStylesheet('main', '', array ());
}
else if ($templateName.$this->viewName == 'keywordphotosSuccess')
{
  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);
  $response->addMeta('title', '沖縄写真旅行', false, false);
  $response->addMeta('robots', 'index, follow', false, false);
  $response->addMeta('description', '沖縄の写真を多数掲載。', false, false);
  $response->addMeta('keywords', '沖縄,写真,写真集', false, false);
  $response->addMeta('language', 'ja', false, false);

  $response->addStylesheet('main', '', array ());
}
else if ($templateName.$this->viewName == 'keywordpageSuccess')
{
  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);
  $response->addMeta('title', '沖縄写真旅行', false, false);
  $response->addMeta('robots', 'index, follow', false, false);
  $response->addMeta('description', '沖縄の写真を多数掲載。', false, false);
  $response->addMeta('keywords', '沖縄,写真,写真集', false, false);
  $response->addMeta('language', 'ja', false, false);

  $response->addStylesheet('main', '', array ());
}
else if ($templateName.$this->viewName == 'blogphotoSuccess')
{
  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);
  $response->addMeta('title', '沖縄写真旅行', false, false);
  $response->addMeta('robots', 'index, follow', false, false);
  $response->addMeta('description', '沖縄の写真を多数掲載。', false, false);
  $response->addMeta('keywords', '沖縄,写真,写真集', false, false);
  $response->addMeta('language', 'ja', false, false);

  $response->addStylesheet('main', '', array ());
}
else if ($templateName.$this->viewName == 'xmlreadSuccess')
{
  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);
  $response->addMeta('title', '沖縄写真旅行', false, false);
  $response->addMeta('robots', 'index, follow', false, false);
  $response->addMeta('description', '沖縄の写真を多数掲載。', false, false);
  $response->addMeta('keywords', '沖縄,写真,写真集', false, false);
  $response->addMeta('language', 'ja', false, false);

  $response->addStylesheet('main', '', array ());
}
else if ($templateName.$this->viewName == 'wanderupdateSuccess')
{
  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);
  $response->addMeta('title', '沖縄写真旅行', false, false);
  $response->addMeta('robots', 'index, follow', false, false);
  $response->addMeta('description', '沖縄の写真を多数掲載。', false, false);
  $response->addMeta('keywords', '沖縄,写真,写真集', false, false);
  $response->addMeta('language', 'ja', false, false);

  $response->addStylesheet('main', '', array ());
}
else if ($templateName.$this->viewName == 'mapthumbnailSuccess')
{
  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);
  $response->addMeta('title', '沖縄写真旅行', false, false);
  $response->addMeta('robots', 'index, follow', false, false);
  $response->addMeta('description', '沖縄の写真を多数掲載。', false, false);
  $response->addMeta('keywords', '沖縄,写真,写真集', false, false);
  $response->addMeta('language', 'ja', false, false);

  $response->addStylesheet('main', '', array ());
}
else if ($templateName.$this->viewName == 'addlinkSuccess')
{
  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);
  $response->addMeta('title', '沖縄写真旅行', false, false);
  $response->addMeta('robots', 'index, follow', false, false);
  $response->addMeta('description', '沖縄の写真を多数掲載。', false, false);
  $response->addMeta('keywords', '沖縄,写真,写真集', false, false);
  $response->addMeta('language', 'ja', false, false);

  $response->addStylesheet('main', '', array ());
}
else if ($templateName.$this->viewName == 'ajaxgetphotoSuccess')
{
  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);
  $response->addMeta('title', '沖縄写真旅行', false, false);
  $response->addMeta('robots', 'index, follow', false, false);
  $response->addMeta('description', '沖縄の写真を多数掲載。', false, false);
  $response->addMeta('keywords', '沖縄,写真,写真集', false, false);
  $response->addMeta('language', 'ja', false, false);

  $response->addStylesheet('main', '', array ());
}
else if ($templateName.$this->viewName == 'ajaxthumblistSuccess')
{
  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);
  $response->addMeta('title', '沖縄写真旅行', false, false);
  $response->addMeta('robots', 'index, follow', false, false);
  $response->addMeta('description', '沖縄の写真を多数掲載。', false, false);
  $response->addMeta('keywords', '沖縄,写真,写真集', false, false);
  $response->addMeta('language', 'ja', false, false);

  $response->addStylesheet('main', '', array ());
}
else
{
  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else if (null === $this->getDecoratorTemplate() && !$this->context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);
  $response->addMeta('title', '沖縄写真旅行', false, false);
  $response->addMeta('robots', 'index, follow', false, false);
  $response->addMeta('description', '沖縄の写真を多数掲載。', false, false);
  $response->addMeta('keywords', '沖縄,写真,写真集', false, false);
  $response->addMeta('language', 'ja', false, false);

  $response->addStylesheet('main', '', array ());
}

