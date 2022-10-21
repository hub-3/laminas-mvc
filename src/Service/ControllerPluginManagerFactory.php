<?php

declare(strict_types=1);

namespace Laminas\Mvc\Service;

use Laminas\Mvc\Controller\PluginManager as ControllerPluginManager;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class ControllerPluginManagerFactory implements FactoryInterface
{
    /**
     * @param string $name
     */
    public function __invoke(ContainerInterface $container, $name, ?array $options = null): ControllerPluginManager
    {
        if ($options) {
            return new ControllerPluginManager($container, $options);
        }
        $managerConfig = [];
        if ($container->has('config')) {
            $managerConfig = $container->get('config')['controller_plugins'] ?? [];
        }
        return new ControllerPluginManager($container, $managerConfig);
    }
}
