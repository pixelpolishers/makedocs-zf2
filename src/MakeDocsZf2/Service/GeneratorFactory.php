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
use MakeDocs\Generator\Generator;

class GeneratorFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        if (!array_key_exists('makedocs', $config)) {
            throw new \RuntimeException('No makedocs configuration present.');
        }

        $generator = new Generator();

        $this->parseConfig($serviceLocator, $generator, $config['makedocs']);

        return $generator;
    }

    private function parseConfig(ServiceLocatorInterface $serviceLocator, Generator $generator, array $config)
    {
        if (array_key_exists('input', $config)) {
            $generator->setInputDirectory($config['input']);
        }

        if (array_key_exists('builders', $config)) {
            $this->parseBuilders($serviceLocator, $generator, $config['builders']);
        }
    }

    private function parseBuilders(ServiceLocatorInterface $serviceLocator, Generator $generator, array $builders)
    {
        foreach ($builders as $type => $config) {
            $serviceName = 'MakeDocs\\Builder\\' . ucfirst($type);

            $builder = $serviceLocator->get($serviceName);
            $builder->setConfig($config);

            $generator->addBuilder($builder);
        }
    }

}
