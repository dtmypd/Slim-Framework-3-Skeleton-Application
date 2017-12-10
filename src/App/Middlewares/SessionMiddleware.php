<?php namespace App\Middlewares;

use ExtendedSlim\Http\Request;
use ExtendedSlim\Http\Response;
use ExtendedSlim\Services\SessionService;
use Psr\Http\Message\ResponseInterface;

class SessionMiddleware
{
    /**
     * @param Request  $request
     * @param Response $response
     * @param callable $next
     *
     * @return ResponseInterface
     */
    public function __invoke(Request $request, Response $response, $next)
    {
        SessionService::sessionStart();

        return $next($request, $response);
    }
}
