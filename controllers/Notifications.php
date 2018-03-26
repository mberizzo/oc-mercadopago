<?php namespace Mberizzo\Mercadopago\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use MP;
use Mberizzo\Mercadopago\Models\Subscription;

/**
 * Notification Back-end Controller
 */
class Notifications extends Controller
{

    public $mp;

    public function __construct()
    {
        $this->mp = new MP(
            env('MP_CLIENT_ID'),
            env('MP_CLIENT_SECRET')
        );
    }

    public function mercadopago(Request $request)
    {
        if (! $request->id) {
            abort(400);
        }

        if ($request->topic == 'preapproval') {
            $preapproval = $this->mp->get_preapproval_payment($request->id);

            // Data for search
            $data = [
                'preapproval_id' => $request->id,
                'user_id' => $preapproval['response']['external_reference'],
            ];

            // Save in db
            $subscription = Subscription::firstOrNew($data);
            $data['status'] = $preapproval['response']['status'];
            $subscription->fill($data)->save();
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
