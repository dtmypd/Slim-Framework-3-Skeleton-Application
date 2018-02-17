<?php namespace EndToEnd;

use ExtendedSlim\App;
use ExtendedSlim\App\Config;
use ExtendedSlim\Tests\EndToEnd\AbstractEndToEndTest;
use App\Config\ContainerConfig;

abstract class EndToEndTestBase extends AbstractEndToEndTest
{

    protected function setUpApp()
    {
        require_once __DIR__ . '/../../vendor/autoload.php';
        (new Config(realpath(__DIR__ . "/../../")))->envSetup();
        $app = new App((new ContainerConfig())->getConfig());

        require __DIR__ . '/../../routes/api.php';
        require __DIR__ . '/../../routes/web.php';

        return $app;
    }

}
