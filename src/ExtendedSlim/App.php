<?php namespace ExtendedSlim;

use App\Config\ContainerConfig;
use DI\ContainerBuilder;

class App extends \Slim\App
{
    public function __construct()
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions((new ContainerConfig())->getConfig());

        parent::__construct($containerBuilder->build());
    }
}
