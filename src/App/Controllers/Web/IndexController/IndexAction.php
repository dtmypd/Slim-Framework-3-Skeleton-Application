<?php namespace App\Controllers\Web\IndexController;

use ExtendedSlim\Http\Response;
use Slim\Http\Request;

class IndexAction
{
    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function __invoke(Request $request, Response $response)
    {
        $response->getBody()->write('HTML part can go later with Twig!');

        return $response;
    }
}
