<?php

namespace DemoShop\router;

use DemoShop\router\Exceptions\RouteNotFoundException;

class Router
{
    /**
     * Finds right route in route mapping
     * @param HttpRequestInterface $httpRequest
     * @param string $path
     * @return RouteMapping
     * @throws RouteNotFoundException
     */
    public function getRoute(HttpRequestInterface $httpRequest, string $path): RouteMapping
    {
        $mappings = include $path;

        foreach ($mappings as $mapping) {

            if ($mapping->matches($httpRequest)) {

                return $mapping;
            }
        }

        throw new RouteNotFoundException();
    }

}