<?php namespace Tests;

use PHPUnit\Framework\TestCase;

abstract class AbstractTest extends TestCase
{
    protected function setUp()
    {
        require_once __DIR__ . '/../src/ExtendedSlim/Helpers.php';

        parent::setUp();
    }
}
