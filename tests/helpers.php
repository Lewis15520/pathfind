<?php

namespace Tests;

function invokeMethod(&$object, string $methodName, array $parameters = [])
{
    $pathFind = new \ReflectionClass(get_class(new PathFind()));
    $method = $pathFind->getMethod('getNodeMap');
    $method->setAccessible(true);

    return $method->invokeArgs($object, $parameters);
}