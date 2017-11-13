<?php

declare(strict_types=1);

namespace Tdutrion\DoctrineORMMultiConf;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;

final class Module implements BootstrapListenerInterface, ConfigProviderInterface, DependencyIndicatorInterface
{
    /**
     * @param EventInterface $event
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function onBootstrap(EventInterface $event)
    {
        /* @var $container ContainerInterface */
        $container = $event->getTarget()->getServiceManager();
        /* @var $doctrineCli Application */
        $doctrineCli = $container->get('doctrine.cli');

        $eventDispatcher = $container->get('doctrine.cli.event_dispatcher');
        $doctrineCli->setDispatcher($eventDispatcher);
    }

    public function getConfig() : array
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getModuleDependencies() : array
    {
        return [
            'DoctrineORMModule',
            'DoctrineModule',
        ];
    }
}
