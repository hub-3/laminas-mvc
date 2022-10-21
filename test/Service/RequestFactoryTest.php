<?php

declare(strict_types=1);

namespace LaminasTest\Mvc\Service;

use Laminas\Http\Request as HttpRequest;
use Laminas\Mvc\Service\RequestFactory;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Psr\Container\ContainerInterface;

class RequestFactoryTest extends TestCase
{
    use ProphecyTrait;

    public function testFactoryCreatesHttpRequest(): void
    {
        $factory = new RequestFactory();
        $request = $factory($this->prophesize(ContainerInterface::class)->reveal(), 'Request');
        $this->assertInstanceOf(HttpRequest::class, $request);
    }
}
