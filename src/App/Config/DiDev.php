<?php
/**
 * Created by PhpStorm.
 * User: gabor.budai
 * Date: 2018.02.18.
 * Time: 23:19
 */

use ExtendedSlim\Handlers\Error;
use ExtendedSlim\Handlers\NotAllowed;
use ExtendedSlim\Handlers\NotFound;
use ExtendedSlim\Handlers\PhpError;


$devConfig = [
    'errorHandler'      => DI\object(Error::class)
        ->constructor(
            DI\get('settings.displayErrorDetails'),
            DI\get('settings.outputBuffering')
        ),
    'phpErrorHandler'   => DI\object(PhpError::class)
        ->constructor(
            DI\get('settings.displayErrorDetails'),
            DI\get('settings.outputBuffering')
        ),
    'notFoundHandler'   => DI\object(NotFound::class),
    'notAllowedHandler' => DI\object(NotAllowed::class),
];
