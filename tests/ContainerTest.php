<?php

namespace Noogic\DiContainer\Tests;

use Noogic\DiContainer\Container;
use PHPUnit\Framework\TestCase;

class ContainerTest extends TestCase
{
    /** @test */
    public function it_can_be_created()
    {
        $container = new Container();
        $this->assertInstanceOf(Container::class, $container);
    }
}
