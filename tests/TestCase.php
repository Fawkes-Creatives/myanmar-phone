<?php

/**
 * @author fawkescreatives created on 17/09/2021
 */

namespace MyanmarPhone\Tests;

use MyanmarPhone\MyanmarPhoneServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected $validator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = $this->app['validator'];
    }

    protected function getPackageProviders($app): array
    {
        return [
            MyanmarPhoneServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app): array
    {
        return [
            'MyanmarPhone' => 'MyanmarPhone\Facades\MyanPhone',
        ];
    }

    protected function defineEnvironment($app)
    {
        $app['config']->set('logging.default', 'null');
    }
}
