<?php

declare(strict_types=1);

use Symfony\Component\Console\ConsoleEvents;
use Tdutrion\DoctrineORMMultiConf\EventListener\MigrationConfigurationListener;
use Tdutrion\DoctrineORMMultiConf\Factory\EventDispatcherFactory;
use Tdutrion\DoctrineORMMultiConf\Factory\MigrationConfigurationListenerFactory;

return [
    'service_manager' => [
        'factories' => [
            'doctrine.cli.event_dispatcher' => EventDispatcherFactory::class,
            MigrationConfigurationListener::class => MigrationConfigurationListenerFactory::class,
        ],
    ],
    'doctrine' => [
        'cli' => [
            'event_dispatcher' => [
                'listeners' => [
                    ConsoleEvents::COMMAND => MigrationConfigurationListener::class,
                ],
            ],
        ],
    ],
];
