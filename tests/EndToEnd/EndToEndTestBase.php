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
        $diBaseConfig           = require __DIR__ . '/../../config/DiBase.php';
        $diClassPredefineConfig = require __DIR__ . '/../../config/DiClassPredefine.php';
        $diDevConfig            = require __DIR__ . '/../../config/DiDev.php';


        (new Config(realpath(__DIR__ . "/../../")))->envSetup();
        $app = new App((new ContainerConfig($diBaseConfig, $diClassPredefineConfig, $diDevConfig))->getConfig());

        require_once __DIR__ . '/../../routes/api.php';
        require_once __DIR__ . '/../../routes/web.php';

        return $app;
    }
}
