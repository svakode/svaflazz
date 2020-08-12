<?php

namespace Svakode\Svaflazz\Tests;

use Mockery;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        Mockery::close();
    }

    /**
     * Set up the environment.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        config([
            'svaflazz.username' => 'username',
            'svaflazz.key' => 'key',
            'svaflazz.base_url' => 'http://digiflazz.com',
        ]);
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            'Svakode\Svaflazz\SvaflazzServiceProvider',
        ];
    }

    /**
     * @param string $keyword
     * @return string
     */
    public function sign(string $keyword)
    {
        return md5('username' . 'key' . $keyword);
    }
}
