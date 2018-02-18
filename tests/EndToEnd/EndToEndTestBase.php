<?php namespace EndToEnd;

use ExtendedSlim\App;
use ExtendedSlim\App\Config;
use ExtendedSlim\Tests\EndToEnd\AbstractEndToEndTest;
use ExtendedSlim\App\Config\ContainerConfig;

abstract class EndToEndTestBase extends AbstractEndToEndTest
{

    protected function setUpApp()
    {
        require_once __DIR__ . '/../../vendor/autoload.php';
        require_once __DIR__ . '/../../src/App/Config/DiBase.php';
        require_once __DIR__ . '/../../src/App/Config/DiClassPredefine.php';
        require_once __DIR__ . '/../../src/App/Config/DiDev.php';

        (new Config(realpath(__DIR__ . "/../../")))->envSetup();
        $app = new App((new ContainerConfig(
            $baseConfig,
            $classConfig,
            $devConfig
        ))->getConfig());

        require_once __DIR__ . '/../../routes/api.php';
        require_once __DIR__ . '/../../routes/web.php';

        return $app;
    }

}
