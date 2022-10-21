<?php

declare(strict_types=1);

namespace Laminas\Mvc\Service;

use Laminas\Mvc\Application;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class ApplicationFactory implements FactoryInterface
{
    /**
     * Create the Application service
     *
     * Creates a Laminas\Mvc\Application service, passing it the configuration
     * service and the service manager instance.
     *
     * @param  string $name
     * @param  null|array $options
     * @return Application
     */
    public function __invoke(ContainerInterface $container, $name, ?array $options = null)
    {
        $application = new Application(
            $container,
            $container->get('EventManager'),
            $container->get('Request'),
            $container->get('Response')
        );

        if (! $container->has('config')) {
            return $application;
        }

        $em        = $application->getEventManager();
        $listeners = $container->get('config')[Application::class]['listeners'] ?? [];
        foreach ($listeners as $listener) {
            $container->get($listener)->attach($em);
        }
        return $application;
    }
}
