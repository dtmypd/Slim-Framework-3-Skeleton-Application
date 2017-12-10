<?php namespace App\Controllers\Web\IndexController;

use App\Services\CounterService;
use ExtendedSlim\Http\Response;
use ExtendedSlim\Http\Request;

class SessionDemoAction
{
    /**
     * @param Request        $request
     * @param Response       $response
     * @param CounterService $counterService
     *
     * @return Response
     */
    public function __invoke(Request $request, Response $response, CounterService $counterService)
    {
        $response->getBody()->write($counterService->addAndGet(2));

        return $response;
    }
}
