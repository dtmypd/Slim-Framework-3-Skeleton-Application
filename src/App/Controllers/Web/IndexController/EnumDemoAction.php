<?php namespace App\Controllers\Web\IndexController;

use App\Enums\UserStatusEnum;
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
        $status = UserStatusEnum::byValue(1);
        $response->getBody()->write($status->getName());

        $status = UserStatusEnum::get(UserStatusEnum::DELETED);
        $response->getBody()->write('<br />' . $status->getName());
        $response->getBody()->write('<br />' . $status->getValue());
        $response->getBody()->write('<br />' . $status->getOrdinal());
        $response->getBody()->write('<br />');

        $status = UserStatusEnum::byName('DELETED');
        $response->getBody()->write('<br />' . $status->getName());
        $response->getBody()->write('<br />' . $status->getValue());
        $response->getBody()->write('<br />' . $status->getOrdinal());
        $response->getBody()->write('<br />');

        $status = UserStatusEnum::byOrdinal(1);
        $response->getBody()->write('<br />' . $status->getName());
        $response->getBody()->write('<br />' . $status->getValue());
        $response->getBody()->write('<br />' . $status->getOrdinal());
        $response->getBody()->write('<br />');

        $status = UserStatusEnum::byOrdinal(2);
        $response->getBody()->write('<br />' . $status->getName());
        $response->getBody()->write('<br />' . $status->getValue());
        $response->getBody()->write('<br />' . $status->getOrdinal());
        $response->getBody()->write('<br />');

        $response->getBody()->write('<br />' . print_r(UserStatusEnum::getEnumerators(), true));
        $response->getBody()->write('<br />' . print_r(UserStatusEnum::getValues(), true));
        $response->getBody()->write('<br />' . print_r(UserStatusEnum::getNames(), true));
        $response->getBody()->write('<br />' . print_r(UserStatusEnum::getOrdinals(), true));
        $response->getBody()->write('<br />' . print_r(UserStatusEnum::getConstants(), true));

        return $response;
    }
}
