<?php

namespace DemoShop\router;

class RouteMapping
{
    private string $requestUri;
    private string $requestMethod;
    private string $method;
    private string $controller;
    private array $parameters;
    private array $middlewares;

    public function __construct(
        string $requestUri,
        string $requestMethod,
        string $controller,
        string $method,
        array  $middlewares = [])
    {
        $this->requestUri = $requestUri;
        $this->requestMethod = $requestMethod;
        $this->method = $method;
        $this->controller = $controller;
        $this->parameters = [];
        $this->middlewares = $middlewares;
    }

    /**
     * Returns true if route matches the one in httpRequest
     * @param HttpRequestInterface $httpRequest
     * @return bool
     */
    public function matches(HttpRequestInterface $httpRequest): bool
    {
        if ($httpRequest->getMethod() === $this->requestMethod
            && preg_match($this->requestUri, $httpRequest->getUri(), $this->parameters)) {
            array_shift($this->parameters);

            return true;
        }

        return false;
    }

    /**
     * Return route controller
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * Returns method in controller that will be called
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Get parameters
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * Get all middlewares in route
     * @return array
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

}