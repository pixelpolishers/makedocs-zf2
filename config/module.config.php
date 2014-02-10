<?php
/**
 * This file is part of MakeDocs. An application created by Pixel Polishers.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @license https://github.com/pixelpolishers/makedocs
 */
return array(
    'router' => array(
        'routes' => array(
            'makedocs' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/makedocs/webhook/:webhook',
                    'defaults' => array(
                        'controller' => 'makedocs',
                        'action' => 'webhook',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'MakeDocs\WebHook\GitHub' => 'MakeDocsZf2\Service\GitHubFactory',
        ),
        'invokables' => array(
            'MakeDocs\Generator' => 'MakeDocs\Generator\Generator',
            'MakeDocs\Builder\Html' => 'MakeDocs\Builder\Html\HtmlBuilder',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'makedocs' => 'MakeDocsZf2\Controller\MakeDocsController'
        ),
    ),
);
