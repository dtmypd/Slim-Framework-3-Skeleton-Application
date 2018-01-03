<?php namespace App\Middlewares;

use ExtendedSlim\Http\Request;
use ExtendedSlim\Http\Response;
use Psr\Http\Message\ResponseInterface;

class CorsMiddleware
{
    /** @var string */
    private $allowOrigin;

    /**
     * @param string $allowOrigin
     */
    public function __construct(string $allowOrigin)
    {
        $this->allowOrigin = $allowOrigin;
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param callable $next
     *
     * @return ResponseInterface
     */
    public function __invoke(Request $request, Response $response, callable $next)
    {
        /** @var Response $next */
        $next = $next($request, $response);

        if (false === $this->allowOrigin)
        {
            return $next;
        }

        return $next
            ->withHeader('Access-Control-Allow-Origin', $this->allowOrigin)
            ->withHeader(
                'Access-Control-Allow-Headers',
                'X-Requested-With, Content-Type, Accept, Origin, Authorization'
            )
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }
}
