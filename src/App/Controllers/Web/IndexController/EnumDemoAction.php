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
        $status = UserStatus::byValue(1);
        $response->getBody()->write($status->getName());

        $status = UserStatus::get(UserStatus::DELETED);
        $response->getBody()->write('<br />' . $status->getName());
        $response->getBody()->write('<br />' . $status->getValue());
        $response->getBody()->write('<br />' . $status->getOrdinal());
        $response->getBody()->write('<br />');

        $status = UserStatus::byName('DELETED');
        $response->getBody()->write('<br />' . $status->getName());
        $response->getBody()->write('<br />' . $status->getValue());
        $response->getBody()->write('<br />' . $status->getOrdinal());
        $response->getBody()->write('<br />');

        $status = UserStatus::byOrdinal(1);
        $response->getBody()->write('<br />' . $status->getName());
        $response->getBody()->write('<br />' . $status->getValue());
        $response->getBody()->write('<br />' . $status->getOrdinal());
        $response->getBody()->write('<br />');

        $status = UserStatus::byOrdinal(2);
        $response->getBody()->write('<br />' . $status->getName());
        $response->getBody()->write('<br />' . $status->getValue());
        $response->getBody()->write('<br />' . $status->getOrdinal());
        $response->getBody()->write('<br />');

        $response->getBody()->write('<br />' . print_r(UserStatus::getEnumerators(), true));
        $response->getBody()->write('<br />' . print_r(UserStatus::getValues(), true));
        $response->getBody()->write('<br />' . print_r(UserStatus::getNames(), true));
        $response->getBody()->write('<br />' . print_r(UserStatus::getOrdinals(), true));
        $response->getBody()->write('<br />' . print_r(UserStatus::getConstants(), true));

        return $response;
    }
}
