<?php

namespace Noogic\DiContainer\Tests;

use Noogic\DiContainer\Container;
use Noogic\DiContainer\Tests\Examples\Bicycle;
use Noogic\DiContainer\Tests\Examples\Car;
use Noogic\DiContainer\Tests\Examples\Engine;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionProperty;

class ContainerTest extends TestCase
{
    /** @test */
    public function it_can_be_created()
    {
        $container = new Container;
        $this->assertInstanceOf(Container::class, $container);
    }

    /** @test */
    public function it_can_create_an_instance_of_another_class()
    {
        $container = new Container;
        $object = $container->get(Bicycle::class);

        $this->assertInstanceOf(Bicycle::class, $object);
    }

    /** @test */
    public function it_can_create_an_instance_of_a_class_with_dependencies()
    {
        $container = new Container;
        $car = $container->get(Car::class);

        $this->assertInstanceOf(Car::class, $car);

        $reflectionClass = new ReflectionClass($car);
        $properties = $reflectionClass->getProperties();

        /** @var ReflectionProperty $engineProperty */
        $engineProperty = $properties[0];
        $engineProperty->setAccessible(true);

        $this->assertInstanceOf(Engine::class, $engineProperty->getValue($car));
    }
}
