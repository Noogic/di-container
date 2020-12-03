<?php

namespace Noogic\DiContainer\Tests\Examples;

class Car
{
    private $engine;

    public function __construct(Engine $engine)
    {
        $this->engine = $engine;
    }
}
