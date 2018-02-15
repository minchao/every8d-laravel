<?php

namespace Every8d\Laravel\Tests;

use Every8d\Laravel\Every8dServiceProvider;
use Orchestra\Testbench\TestCase;

abstract class AbstractTestCase extends TestCase
{
    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [Every8dServiceProvider::class];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getApplicationAliases($app)
    {
        return ['Every8d' => Every8dServiceProvider::class];
    }

    /**
     * @param string $class
     * @param string $property
     * @param mixed $object
     * @return mixed
     * @throws \ReflectionException
     */
    public function getClassProperty($class, $property, $object)
    {
        $reflectionClass = new \ReflectionClass($class);
        $refProperty = $reflectionClass->getProperty($property);
        $refProperty->setAccessible(true);

        return $refProperty->getValue($object);
    }
}
