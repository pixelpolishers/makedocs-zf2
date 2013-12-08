<?php
/**
 * This file is part of MakeDocs. An application created by Pixel Polishers.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @license https://github.com/pixelpolishers/makedocs-zf2
 */

namespace MakeDocsZf2\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use MakeDocs\WebHook\GitHub\GitHub;

class GitHubFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $generator = $serviceLocator->get('MakeDocs\Generator');

        return new GitHub($generator);
    }
}
