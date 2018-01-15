<?php namespace App\Controllers\Web\IndexController;

use ExtendedSlim\Http\Request;
use ExtendedSlim\Http\Response;

class CliGetDemoAction
{
    /**
     * @param Request     $request
     * @param Response    $response
     *
     * @return Response
     */
    public function __invoke(Request $request, Response $response): Response
    {
        $response->getBody()->write('Use the command in terminal: $ php cli.php GET /cli-get-demo');

        return $response;
    }
}
