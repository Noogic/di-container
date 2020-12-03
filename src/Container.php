<?php

namespace Noogic\DiContainer;

use ReflectionClass;
use ReflectionMethod;
use ReflectionParameter;

class Container
{
    public function get(string $class): object
    {
        $reflectionClass = new ReflectionClass($class);

        if (! $reflectionClass->hasMethod('__construct')) {
            return new $class;
        }

        $params = $this->constructorParams($class);
        $dependencies = $this->buildDependencies($params);

        return $reflectionClass->newInstanceArgs($dependencies);
    }

    /**
     * @return ReflectionParameter[]
     */
    private function constructorParams(string $class): array
    {
        $reflectionMethod = new ReflectionMethod($class, '__construct');
        $params = $reflectionMethod->getParameters();

        return $params;
    }

    private function buildDependencies(array $reflectionParams)
    {
        $dependencies = [];

        /** @var ReflectionParameter $reflectionParam */
        foreach ($reflectionParams as $reflectionParam) {
            $className = $reflectionParam->getClass()->name;
            $dependencies[] = $this->get($className);
        }

        return $dependencies;
    }
}
