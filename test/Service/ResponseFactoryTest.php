<?php

declare(strict_types=1);

namespace LaminasTest\Mvc\Service;

use Laminas\Http\Response as HttpResponse;
use Laminas\Mvc\Service\ResponseFactory;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Psr\Container\ContainerInterface;

class ResponseFactoryTest extends TestCase
{
    use ProphecyTrait;

    public function testFactoryCreatesHttpResponse(): void
    {
        $factory  = new ResponseFactory();
        $response = $factory($this->prophesize(ContainerInterface::class)->reveal(), 'Response');
        $this->assertInstanceOf(HttpResponse::class, $response);
    }
}
