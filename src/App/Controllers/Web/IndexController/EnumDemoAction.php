<?php namespace App\Controllers\Web\IndexController;

use App\Enums\UserStatus;
use ExtendedSlim\Http\Response;
use ExtendedSlim\Http\Request;

class EnumDemoAction
{
    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function __invoke(Request $request, Response $response): Response
    {
        $response->getBody()->write(UserStatus::byValue(1));
        $response->getBody()->write(UserStatus::get(UserStatus::DELETED));
        $response->getBody()->write(UserStatus::byName('DELETED'));
        $response->getBody()->write(UserStatus::byOrdinal(1));
        $response->getBody()->write(UserStatus::byOrdinal(2));
        $response->getBody()->write(UserStatus::DELETED);

        return $response;
    }
}
