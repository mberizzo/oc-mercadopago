<?php namespace Mberizzo\Mercadopago\Tests;

use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factory;
use PluginTestCase;

class Base extends PluginTestCase
{

    protected $baseUrl = 'http://oc-mercadopago.plugin';
    protected $factory;

    public function createApplication()
    {
        putenv('APP_ENV=testing'); // Load config from 'config/testing' path

        return parent::createApplication();
    }

    public function setUp()
    {
        parent::setUp();

        $this->factory = Factory::construct(
            Faker::create(),
            plugins_path('mberizzo/mercadopago/database/factories')
        );
    }

    protected function mockMPPaymentInfo($external_reference = '', $status = 200, $payment_status = 'approved')
    {
        return [
            'status' => $status,
            'response' => [
                'collection' => [
                   'id' => '2003283983',
                   'site_id' => 'MLA',
                   'external_reference' => $external_reference,
                   'reason' => '',
                   'currency_id' => 'ARS',
                   'transaction_amount' => '',
                   'total_paid_amount' => '',
                   'status' => $payment_status,
                   'status_detail' => $payment_status,
                   'installments' => '1',
                ],
            ],
        ];
    }
}
