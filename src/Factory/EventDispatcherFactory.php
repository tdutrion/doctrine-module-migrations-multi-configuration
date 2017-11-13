<?php

declare(strict_types=1);

namespace Tdutrion\DoctrineORMMultiConf\Factory;

use Psr\Container\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Tdutrion\DoctrineORMMultiConf\Exception\InvalidConfigurationException;

final class EventDispatcherFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return EventDispatcher
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws InvalidConfigurationException
     */
    public function __invoke(ContainerInterface $container) : EventDispatcher
    {
        $eventDispatcher = new EventDispatcher();

        $config = $container->get('config');
        foreach ($config['doctrine']['cli']['event_dispatcher']['listeners'] ?? [] as $event => $listener) {
            if (!$container->has($listener)) {
                throw new InvalidConfigurationException(
                    "configuration for doctrine.cli.event_dispatcher.listeners is invalid: Unable to find $listener in container."
                );
            }
            $eventDispatcher->addListener($event, $container->get($listener));
        }

        return $eventDispatcher;
    }
}
