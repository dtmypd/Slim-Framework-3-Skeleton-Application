<?php namespace Integration;

use ExtendedSlim\App\Config;
use ExtendedSlim\Tests\Integration\AbstractIntegrationTest;
use ExtendedSlim\App\Config\ContainerConfig;
use ExtendedSlim\App;

abstract class IntegrationTestBase extends AbstractIntegrationTest
{
    public function getApp()
    {
        $diBaseConfig           = require __DIR__ . '/../../config/DiBase.php';
        $diClassPredefineConfig = require __DIR__ . '/../../config/DiClassPredefine.php';
        $diDevConfig            = require __DIR__ . '/../../config/DiDev.php';

        (new Config(realpath(__DIR__ . "/../../")))->envSetup();
        return new App((new ContainerConfig($diBaseConfig, $diClassPredefineConfig, $diDevConfig))->getConfig());
    }
}
