<?php namespace App\Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SessionMiddleware
{
    /**
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface      $response
     * @param  callable               $next
     *
     * @return ResponseInterface
     */
    public function __invoke($request, $response, $next)
    {
        session_start();

        return $next($request, $response);
    }
}
