<?php namespace ExtendedSlim;

use App\Config\ContainerConfig;
use DI\ContainerBuilder;

class App extends \Slim\App
{
    public function __construct($config = [])
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions(array_merge((new ContainerConfig())->getConfig(), $config));

        parent::__construct($containerBuilder->build());
    }
}
