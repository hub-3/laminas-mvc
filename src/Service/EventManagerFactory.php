<?php

declare(strict_types=1);

namespace Laminas\Mvc\Service;

use Laminas\EventManager\EventManager;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class EventManagerFactory implements FactoryInterface
{
    /**
     * Create an EventManager instance
     *
     * Creates a new EventManager instance, seeding it with a shared instance
     * of SharedEventManager.
     *
     * @param  string $name
     * @param  null|array $options
     * @return EventManager
     */
    public function __invoke(ContainerInterface $container, $name, ?array $options = null)
    {
        $shared = $container->has('SharedEventManager') ? $container->get('SharedEventManager') : null;

        return new EventManager($shared);
    }
}
