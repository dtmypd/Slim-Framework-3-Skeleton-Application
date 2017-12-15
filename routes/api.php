<?php

use App\Controllers\Api\v1\TodoController;
use App\Controllers\Api\v1\UserController;
use App\Middlewares\CorsMiddleware;

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
    ->add(new CorsMiddleware(env('CORS_ALLOW_ORIGIN', false)));
