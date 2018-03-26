<?php namespace Mberizzo\Mercadopago\Tests;

use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factory;
use PluginTestCase;

class Base extends PluginTestCase
{

    protected const SECONDS_TO_WAIT = 5;
    protected $baseUrl = '/';
    protected $factory;

    public function createApplication()
    {
        return parent::createApplication();
    }

    public function setUp()
    {
        parent::setUp();

        include plugins_path('mberizzo/mercadopago/routes.php');

        $this->factory = Factory::construct(
            Faker::create(),
            plugins_path('mberizzo/mercadopago/database/factories')
        );
    }

    protected function wait($seconds = null)
    {
        if (! $seconds) {
            $seconds = self::SECONDS_TO_WAIT;
        }

        sleep($seconds);

        return $this;
    }
}
