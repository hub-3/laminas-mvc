<?php

declare(strict_types=1);

namespace LaminasTest\Mvc\Service;

use Laminas\Mvc\Service\ViewJsonStrategyFactory;
use Laminas\View\Renderer\JsonRenderer;
use Laminas\View\Strategy\JsonStrategy;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Psr\Container\ContainerInterface;

class ViewJsonStrategyFactoryTest extends TestCase
{
    use ProphecyTrait;

    private function createContainer(): ContainerInterface
    {
        $renderer  = $this->prophesize(JsonRenderer::class);
        $container = $this->prophesize(ContainerInterface::class);
        $container->get('ViewJsonRenderer')->will(fn(): object => $renderer->reveal());
        return $container->reveal();
    }

    public function testReturnsJsonStrategy(): void
    {
        $factory = new ViewJsonStrategyFactory();
        $result  = $factory($this->createContainer(), 'ViewJsonStrategy');
        $this->assertInstanceOf(JsonStrategy::class, $result);
    }
}
