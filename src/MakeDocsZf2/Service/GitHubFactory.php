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
use MakeDocs\WebHook\GitHub\Config;
use MakeDocs\WebHook\GitHub\GitHub;

class GitHubFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $generator = $serviceLocator->get('MakeDocs\Generator');

        $config = $serviceLocator->get('Config');
        if (!array_key_exists('makedocs', $config)) {
            throw new \RuntimeException('No makedocs configuration present.');
        }

        $makedocsConfig = $config['makedocs'];
        if (!array_key_exists('listeners', $makedocsConfig)) {
            throw new \RuntimeException('No listeners configuration present.');
        }

        $webhook = new GitHub($generator);

        foreach ($makedocsConfig['listeners'] as $name => $options) {
            $configuration = $this->parseConfiguration($name, $options);

            $webhook->addConfiguration($configuration);
        }

        return $webhook;
    }

    private function parseConfiguration($name, $options)
    {
        $result = new Config();
        $result->setName($name);
        $result->setDriver($options['driver']);
        $result->setSource($options['source']);
        $result->setRepository($options['repository']);

        foreach ($options['builders'] as $builder) {
            $builder = $this->parseBuilder($builder);

            $result->addBuilder($builder);
        }

        return $result;
    }

    private function parseBuilder($builder)
    {
        // TODO
        return $builder;
    }
}
