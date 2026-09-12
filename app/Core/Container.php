<?php

namespace App\Core;

use ReflectionClass;

class Container
{
    private array $bindings = [];

    public function instance(string $name, object $instance): void
    {
        $this->bindings[$name] = $instance;
    }

    public function get(string $name)
    {
        return $this->bindings[$name];
    }

    public function make(string $className)
    {
        $reflection = new ReflectionClass($className);
        $constructor = $reflection->getConstructor();

        if ($constructor === null) {
            return new $className();
        }

        $parameters = $constructor->getParameters();
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $type = $parameter->getType();
            $name = $type->getName();

            if (isset($this->bindings[$name])) {
                $dependencies[] = $this->get($name);
            } else {
                $dependencies[] = $this->make($name);
            }
        }
        return new $className(...$dependencies);
    }
    
}
