<?php

namespace DemoShop\router;

interface HttpRequestInterface
{

    public function getUri() : string;

    public function getMethod(): string;

}