<?php

use App\Controllers\Api\v1\TodoListController;
use \App\Controllers\Api\v1\UserController;

$app->group('/v1',
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

        $this->group('/users',
            function ()
            {
                $this->post('/create', UserController\CreateAction::class);
            }
        );
    }
);
