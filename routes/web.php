<?php

use \App\Controllers\Web\IndexController;

$app->get('/', IndexController\IndexAction::class);
$app->get('/translation-demo', IndexController\TranslationDemoAction::class);
