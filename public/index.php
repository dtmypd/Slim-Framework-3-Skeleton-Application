<?php
//if (PHP_SAPI == 'cli-server') {
//    // To help the built-in PHP dev server, check if the request was actually for
//    // something which should probably be served as a static file
//    $url  = parse_url($_SERVER['REQUEST_URI']);
//    $file = __DIR__ . $url['path'];
//    if (is_file($file)) {
//        return false;
//    }
//}

use ExtendedSlim\App;
use ExtendedSlim\App\Config;
use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/ExtendedSlim/Helpers.php';

(new Config())->envSetup();
$app = new App();

require_once  __DIR__ . '/../routes/api.php';
require_once  __DIR__ . '/../routes/web.php';

try
{
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
catch (Exception $e)
{
    echo 'Unhandled error.';
    //@todo: Add logger
}
