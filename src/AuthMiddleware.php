<?php

namespace Arek\Exercise;

use \Psr\Http\Message\ServerRequestInterface;
use \Psr\Http\Message\ResponseInterface;

class AuthMiddleware
{
    private $credentials;

    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        if ($this->credentials['authorization'] == 'Basic') {
            if ($request->getHeader('Authorization')[0] != 'Basic ' . $this->getBasicToken()) {
                return $response->withJson([
                    'status' => HttpStatus::UNAUTHORIZED,
                    'message' => 'Unauthorized Access',
                ], HttpStatus::UNAUTHORIZED);
            }
        }

        return $next($request, $response);
    }

    private function getBasicToken()
    {
        return base64_encode($this->credentials['username'] . ':' . $this->credentials['password']);
    }
}
