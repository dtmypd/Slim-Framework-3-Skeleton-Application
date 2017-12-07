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

use App\Controllers\TodoListController;
use App\Controllers\UserController;
use ExtendedSlim\App;
use ExtendedSlim\App\Config;

require __DIR__ . '/../vendor/autoload.php';

$app = new App();

(new Config())->envSetup();

$app->group(
    '/todo-list',
    function ()
    {
        $this->post('/create', TodoListController\CreateAction::class);
        $this->get('', TodoListController\ListAction::class);
        $this->get('/{id}', TodoListController\ShowAction::class);
    }
);

$app->group('/users',
    function ()
    {
        $this->post('/create', UserController\CreateAction::class);
    }
);

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
