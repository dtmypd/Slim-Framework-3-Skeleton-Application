<?php namespace ExtendedSlim;

use App\Config\ContainerConfig;
use DI\ContainerBuilder;
use Slim\App as SlimApp;

class App extends SlimApp
{
    public function __construct()
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions((new ContainerConfig())->getConfig());

        parent::__construct($containerBuilder->build());
    }
}
