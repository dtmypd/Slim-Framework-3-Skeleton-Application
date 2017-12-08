<?php

use \App\Controllers\Web\IndexController;

$app->get('/', IndexController\IndexAction::class);
