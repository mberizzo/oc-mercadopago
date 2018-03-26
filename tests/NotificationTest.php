<?php namespace Mberizzo\Mercadopago\Tests;

use MP;

class NotificationTest extends Base
{

    /**
     * @test
     */
    public function ipn_url_without_parameters_return_error()
    {
        $response = $this->post('notifications/mercadopago');
        $response->assertStatus(400);
    }

    /**
     * @test
     */
    public function we_receive_a_preapproval_notification()
    {
        $preapproval = $this->createPreapprovalResource();

        // Assert the mp response: 201 created
        $this->assertEquals(201, $preapproval['status']);

        // We have to simulate the ipn notification in this environment
        // Because the endpoint is on testing mode
        $response = $this->post('notifications/mercadopago', [
            'topic' => 'preapproval',
            'id' => $preapproval['response']['id']
        ]);

        // Assert for ipn web hook endpoint response
        $response->assertStatus(200);

        // See in subscriptions table
        $this->assertDatabaseHas('mberizzo_mercadopago_subscriptions', [
            'preapproval_id' => $preapproval['response']['id'],
            'user_id' => $preapproval['response']['external_reference'],
            'status' => $preapproval['response']['status'],
        ]);
    }

    /**
     * Create a valid preapproval resource
     *
     * @return array $preapproval
     */
    private function createPreapprovalResource()
    {
        // @TODO: factory is not work
        // $user = $this->factory->of(\RainLab\User\Models\User::class)->create();

        $data = [
            'payer_email' => env('MP_TEST_PAYER_EMAIL'),
            'back_url' => 'https://github.com/mberizzo/oc-mercadopago',
            'reason' => 'PLAN MENSUAL',
            'external_reference' => 1, // user_id
            'auto_recurring' => [
                'frequency' => 1,
                'frequency_type' => 'months',
                'transaction_amount' => 29,
                'currency_id' => 'ARS',
            ]
        ];

        // Create a preapproval with MP api
        $mp = new MP(env('MP_CLIENT_ID'), env('MP_CLIENT_SECRET'));

        $preapproval = $mp->create_preapproval_payment($data);

        // Wait few seconds until MP returns
        $this->wait();

        return $preapproval;
    }
}
