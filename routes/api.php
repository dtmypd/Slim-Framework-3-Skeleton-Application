<?php

use App\Controllers\Api\v1\TodoController;
use App\Controllers\Api\v1\UserController;
use App\Middlewares\CorsMiddleware;
use ExtendedSlim\Http\Request;
use ExtendedSlim\Http\Response;

$corsMiddleware = new CorsMiddleware(env('CORS_ALLOW_ORIGIN', false));

if ($corsMiddleware->hasAllowOrigin())
{
    $app->options(
        '/{routes:.+}',
        function (Request $request, Response $response) use ($corsMiddleware)
        {
            return $corsMiddleware->setHeaders($response);
        }
    );
}

$app->group(
    '/v1',
    function ()
    {
        $this->group(
            '/todo',
            function ()
            {
                $this->post('/create', TodoController\CreateAction::class);
                $this->get('', TodoController\ListAction::class);
                $this->get('/{id}', TodoController\ShowAction::class);
            }
        );

        $this->group(
            '/users',
            function ()
            {
                $this->post('/create', UserController\CreateAction::class);
            }
        );
    }
)
    ->add($corsMiddleware);

