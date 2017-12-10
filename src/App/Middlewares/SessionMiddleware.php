<?php namespace App\Middlewares;

use ExtendedSlim\Http\Request;
use ExtendedSlim\Http\Response;
use ExtendedSlim\Services\SessionService;
use Psr\Http\Message\ResponseInterface;

class SessionMiddleware
{
    /** @var SessionService */
    private $sessionService;

    /**
     * @param SessionService $sessionService
     */
    public function __construct(SessionService $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param callable $next
     *
     * @return ResponseInterface
     */
    public function __invoke(Request $request, Response $response, $next)
    {
        $this->sessionService->sessionStart();

        return $next($request, $response);
    }
}
