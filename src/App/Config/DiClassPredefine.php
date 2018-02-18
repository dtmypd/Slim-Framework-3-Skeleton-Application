<?php

use ExtendedSlim\App\PhpDIEntity;
use App\Services\TodoService;
use App\Repositories\TodoRepository;
use ExtendedSlim\Database\Connection;
use Monolog\Logger;

$classConfig = [
    (new PhpDIEntity(TodoService::class))
        ->setConstructorParameter('todoRepository', TodoRepository::class)
        ->setConstructorParameter('connection', Connection::class)
        ->setConstructorParameter('logger', Logger::class),
];
