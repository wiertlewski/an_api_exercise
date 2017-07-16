<?php

use PHPUnit\Framework\TestCase;

abstract class AbstractTestCase extends TestCase
{
    protected function getContainer($mocks)
    {
        return new \Slim\Container($mocks);
    }

    protected function getRequest($requestMethod, $requestUri, $queryString = '')
    {
        return \Slim\Http\Request::createFromEnvironment(\Slim\Http\Environment::mock([
            'REQUEST_METHOD' => $requestMethod,
            'REQUEST_URI' => $requestUri,
            'QUERY_STRING' => $queryString,
        ]));
    }

    protected function getResponse()
    {
        return new \Slim\Http\Response();
    }

    protected function tearDown()
    {
        \Mockery::close();
    }
}
