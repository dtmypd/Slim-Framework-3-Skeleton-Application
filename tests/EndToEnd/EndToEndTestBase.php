<?php namespace EndToEnd;

use ExtendedSlim\App;
use ExtendedSlim\App\Config;
use ExtendedSlim\Tests\EndToEnd\AbstractEndToEndTest;

abstract class EndToEndTestBase extends AbstractEndToEndTest
{

    protected function setUpApp()
    {
        require_once __DIR__ . '/../../vendor/autoload.php';
        (new Config(realpath(__DIR__ . "/../../")))->envSetup();
        $app = new App();

        require __DIR__ . '/../../routes/api.php';
        require __DIR__ . '/../../routes/web.php';

        return $app;
    }

}
