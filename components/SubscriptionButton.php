<?php namespace Mberizzo\Mercadopago\Components;

use Auth;
use Cms\Classes\ComponentBase;
use MP;

class SubscriptionButton extends ComponentBase
{

    public $preapproval;
    public $user;

    public function componentDetails()
    {
        return [
            'name'        => 'Subscription Button',
            'description' => 'Crea la preferencia de pago para una suscripcion'
        ];
    }

    public function defineProperties()
    {
        return [
            'client_id' => [
                'label' => 'Client ID',
                'default' => env('MP_CLIENT_ID'),
            ],
            'client_secret' => [
                'label' => 'Client SECRET',
                'default' => env('MP_CLIENT_SECRET'),
            ],
            'reason' => [
                'label' => 'Titulo',
            ],
            'transaction_amount' => [
                'label' => 'Monto'
            ],
            'back_url' => [
                'label' => 'Back url'
            ],
        ];
    }

    public function onRun()
    {
        $this->user = Auth::getUser();

        if (! $this->user) {
            throw new Exception(
                'Se necesita estar logueado ya que se utiliza el user_id como external_reference y el email como payer_email'
            );
        }

        $mp = new MP($this->property('client_id'), $this->property('client_secret'));

        $preapproval_data = $this->getData();

        $this->preapproval = $this->page['preapproval'] = $mp->create_preapproval_payment($preapproval_data);
    }

    private function getData()
    {
        $payerEmail = env('MP_TEST_PAYER_EMAIL');

        if (env('APP_ENV') == 'production') {
            $payerEmail = $this->user->email;
        }

        return [
            'payer_email' => $payerEmail,
            'back_url' => $this->property('back_url') ?? env('APP_URL'),
            'reason' => $this->property('reason'),
            'external_reference' => $this->user->id,
            'auto_recurring' => [
                'frequency' => 1,
                'frequency_type' => 'months',
                'transaction_amount' => $this->property('transaction_amount'),
                'currency_id' => "ARS",
            ],
        ];
    }
}
