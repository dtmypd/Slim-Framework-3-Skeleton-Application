<?php

if (in_array(PHP_SAPI , ['cli', 'cli-server'])) {
    print "\n\n" . 'Error: CLI calls are not allowed on the public entry point.' . "\n\n";

    exit;
}

use ExtendedSlim\App;
use ExtendedSlim\App\Config;
use Psr\Container\ContainerExceptionInterface;
use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;
use App\Config\ContainerConfig;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/professionhu/extended-slim/src/ExtendedSlim/Helpers.php';

(new Config(realpath('../')))->envSetup();
$app = new App((new ContainerConfig())->getConfig());

try
{
    require_once  __DIR__ . '/../routes/api.php';
    require_once  __DIR__ . '/../routes/web.php';

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
