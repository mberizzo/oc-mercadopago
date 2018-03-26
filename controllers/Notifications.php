<?php namespace Mberizzo\Mercadopago\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use MP;
use Mberizzo\Mercadopago\Models\Subscription;
use RainLab\User\Models\User;

/**
 * Notification Back-end Controller
 */
class Notifications extends Controller
{

    public $mp;
    public $subscription;

    public function __construct()
    {
        $this->mp = new MP(
            env('MP_CLIENT_ID'),
            env('MP_CLIENT_SECRET')
        );

        $this->subscription = new Subscription;
    }

    public function mercadopago(Request $request)
    {
        if (! $request->id) {
            abort(400);
        }

        if ($request->topic == 'preapproval') {
            $preapproval = $this->mp->get_preapproval_payment($request->id);

            $data = [
                'preapproval_id' => $request->id,
                'user_id' => $preapproval['response']['external_reference'],
                'status' => $preapproval['response']['status'],
            ];

            $this->subscription->fill($data)->save();

            // Update users.is_subscribed field
            $user = User::find($this->subscription->user_id);
            $user->is_subscribed = ($this->subscription->status == 'authorized') ? 1 : 0;
            $user->save();
        }

        if ($request->topic == 'payment') {
            // guardo en db
            $paymentInfo = $mp->get_payment_info($request->id);

            // @TODO: handle payment info
            if ($paymentInfo['status'] == 200) {
                // print_r($paymentInfo['response']);
            }
        }

        return response(200);

    }
}
