<?php

declare(strict_types=1);

namespace Tdutrion\DoctrineORMMultiConf\EventListener;

use Doctrine\DBAL\Migrations\Tools\Console\Command\AbstractCommand as MigrationCommand;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Event\ConsoleCommandEvent;

final class MigrationConfigurationListener
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke(ConsoleCommandEvent $consoleCommandEvent)
    {
        if (!$consoleCommandEvent->getCommand() instanceof MigrationCommand) {
            return;
        }
        /* @var $command MigrationCommand */
        $command = $consoleCommandEvent->getCommand();
        $input = $consoleCommandEvent->getInput();
        $objectManagerName = 'doctrine.entitymanager.orm_default';
        if ($input->hasParameterOption(['--object-manager'])) {
            $objectManagerName = $input->getParameterOption(['--object-manager']);
        }
        $migrationConfiguration = $this->container->get(
            str_replace('entitymanager', 'migrations_configuration', $objectManagerName)
        );
        $command->setMigrationConfiguration($migrationConfiguration);
    }
}
