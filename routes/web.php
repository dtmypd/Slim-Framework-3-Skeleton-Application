<?php

use App\Controllers\Web\IndexController;
use App\Middlewares\SessionMiddleware;
use ExtendedSlim\Services\SessionService;

$app->group(
    '',
    function ()
    {
        $this->get('/', IndexController\IndexAction::class);
        $this->get('/translation-demo', IndexController\TranslationDemoAction::class);
        $this->get('/session-demo', IndexController\SessionDemoAction::class);
    }
)
    ->add(new SessionMiddleware($app->getContainer()->get(SessionService::class)));
