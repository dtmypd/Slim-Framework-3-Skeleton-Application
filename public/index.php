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

require __DIR__ . '/../vendor/autoload.php';

$app = new App();

(new Config())->envSetup();

require_once  __DIR__ . '/../routes/api.php';
require_once  __DIR__ . '/../routes/web.php';

try
{
    $app->run();
}
catch (\Slim\Exception\MethodNotAllowedException $e)
{
    echo 'methdod not found';
}
catch (\Slim\Exception\NotFoundException $e)
{
    echo 'not found';
}
catch (Exception $e)
{
    echo 'exception';
}
