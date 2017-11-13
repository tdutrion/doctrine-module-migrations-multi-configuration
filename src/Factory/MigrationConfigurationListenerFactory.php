<?php

declare(strict_types=1);

namespace Tdutrion\DoctrineORMMultiConf\Factory;

use Psr\Container\ContainerInterface;
use Tdutrion\DoctrineORMMultiConf\EventListener\MigrationConfigurationListener;

final class MigrationConfigurationListenerFactory
{
    public function __invoke(ContainerInterface $container) : MigrationConfigurationListener
    {
        return new MigrationConfigurationListener($container);
    }
}
