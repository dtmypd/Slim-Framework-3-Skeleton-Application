<?php namespace Integration;

use ExtendedSlim\Tests\Integration\AbstractIntegrationTest;
use App\Config\ContainerConfig;
use ExtendedSlim\App;

abstract class IntegrationTestBase extends AbstractIntegrationTest
{

    public function getApp()
    {
        return new App((new ContainerConfig())->getConfig());
    }

}
