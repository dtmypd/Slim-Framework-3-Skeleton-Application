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
        $this->get('/enum-demo', IndexController\EnumDemoAction::class);
        $this->get('/cache-demo', IndexController\CacheDemoAction::class);
        $this->get('/cli-get-demo', IndexController\CliGetDemoAction::class);
    }
)
    ->add(new SessionMiddleware($app->getContainer()->get(SessionService::class)));
