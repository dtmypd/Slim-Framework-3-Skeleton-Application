<?php

use App\Controllers\Api\v1\TodoListController;
use App\Controllers\Api\v1\UserController;
use App\Middlewares\CorsMiddleware;

$app->group(
    '/v1',
    function ()
    {
        $this->group(
            '/todo-list',
            function ()
            {
                $this->post('/create', TodoListController\CreateAction::class);
                $this->get('', TodoListController\ListAction::class);
                $this->get('/{id}', TodoListController\ShowAction::class);
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
