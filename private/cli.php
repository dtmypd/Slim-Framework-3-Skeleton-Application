<?php

use ExtendedSlim\App;
use ExtendedSlim\App\Config;
use ExtendedSlim\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;
use Slim\Http\Environment;
use ExtendedSlim\Config\ContainerConfig;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/professionhu/extended-slim/src/ExtendedSlim/Helpers.php';
require __DIR__ . '../src/App/Config/DiBase.php';
require __DIR__ . '../src/App/Config/DiClassPredefine.php';
require __DIR__ . '../src/App/Config/DiDev.php';

$argv = $GLOBALS['argv'];

$requestMethod = $argv[1];
$requestUri    = $argv[2];

(new Config( __DIR__ . '../'))->envSetup();
$appConfig = (new ContainerConfig(
    $baseConfig,
    $classConfig,
    $devConfig,
    [
        'request' => Request::createFromEnvironment(
            Environment::mock(
                [
                    'REQUEST_URI' => '/' . $requestUri,
                ]
            )
        )
    ]
))->getConfig();

$app = new App($appConfig);

try
{
    require_once __DIR__ . '/../routes/api.php';
    require_once __DIR__ . '/../routes/web.php';

    $app->run();
}
catch (MethodNotAllowedException $e)
{
    echo 'Unhandled error: method not found.';
    //@todo: Add logger
}
catch (NotFoundException $e)
{
    echo 'Unhandled error: not found.';
    //@todo: Add logger
}
catch (ContainerExceptionInterface $e)
{
    echo 'Unhandled error: item not found in container.';
    //@todo: Add logger
}
catch (Exception $e)
{
    echo 'Unhandled error.';
    //@todo: Add logger
}
