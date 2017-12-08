<?php

use App\Controllers\TodoListController;
use App\Controllers\UserController;

$app->group(
    '/todo-list',
    function ()
    {
        $this->post('/create', TodoListController\CreateAction::class);
        $this->get('', TodoListController\ListAction::class);
        $this->get('/{id}', TodoListController\ShowAction::class);
    }
);

$app->group('/users',
    function ()
    {
        $this->post('/create', UserController\CreateAction::class);
    }
);