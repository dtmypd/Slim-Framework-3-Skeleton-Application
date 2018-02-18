<?php namespace Integration;

use ExtendedSlim\Tests\Integration\AbstractIntegrationTest;
use ExtendedSlim\App\Config\ContainerConfig;
use ExtendedSlim\App;

abstract class IntegrationTestBase extends AbstractIntegrationTest
{

    public function getApp()
    {
        require __DIR__ . '/../../src/App/Config/DiBase.php';
        require __DIR__ . '/../../src/App/Config/DiClassPredefine.php';
        require __DIR__ . '/../../src/App/Config/DiDev.php';

        return new App((new ContainerConfig(
            $baseConfig,
            $classConfig,
            $devConfig
        ))->getConfig());
    }

}
