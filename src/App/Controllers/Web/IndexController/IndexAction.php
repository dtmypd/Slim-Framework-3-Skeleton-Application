<?php namespace App\Controllers\Web\IndexController;

use ExtendedSlim\Http\Response;
use ExtendedSlim\Http\Request;

class IndexAction
{
    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function __invoke(Request $request, Response $response): Response
    {
        $response->getBody()->write('HTML part can go later with Twig!');

        return $response;
    }
}
