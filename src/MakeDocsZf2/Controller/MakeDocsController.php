<?php
/**
 * This file is part of MakeDocs. An application created by Pixel Polishers.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @license https://github.com/pixelpolishers/makedocs-zf2
 */

namespace MakeDocsZf2\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class MakeDocsController extends AbstractActionController
{
    public function webhookAction()
    {
        $serviceName = 'MakeDocs\\WebHook\\' . ucfirst($this->params('webhook'));

        $webhook = $this->getServiceLocator()->get($serviceName);

        $result = $webhook->listen();

        return $this->getResponse()->setContent($result);
    }
}
