<?php namespace App\Controllers\Web\IndexController;

use App\Services\UserService;
use ExtendedSlim\Exceptions\RecordNotFoundException;
use ExtendedSlim\Http\Response;
use ExtendedSlim\Http\Request;

class CacheDemoAction
{
    /**
     * @param Request     $request
     * @param Response    $response
     * @param UserService $userService
     *
     * @return Response
     * @throws RecordNotFoundException
     */
    public function __invoke(Request $request, Response $response, UserService $userService): Response
    {
        $response->getBody()->write($userService->findByName('balazs')->getUserName());

        return $response;
    }
}
