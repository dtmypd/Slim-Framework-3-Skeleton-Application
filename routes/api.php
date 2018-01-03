<?php

use App\Controllers\Api\v1\TodoController;
use App\Controllers\Api\v1\UserController;
use App\Middlewares\CorsMiddleware;
use ExtendedSlim\Http\Request;
use ExtendedSlim\Http\Response;

$corsAllowOrigin = env('CORS_ALLOW_ORIGIN', false);

if (false !== $corsAllowOrigin)
{
    $app->options(
        '/{routes:.+}',
        function (Request $request, Response $response) use ($corsAllowOrigin)
        {
            return $response
                ->withHeader('Access-Control-Allow-Origin', $corsAllowOrigin)
                ->withHeader(
                    'Access-Control-Allow-Headers',
                    'X-Requested-With, Content-Type, Accept, Origin, Authorization'
                )
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
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
    ->add(new CorsMiddleware($corsAllowOrigin));

