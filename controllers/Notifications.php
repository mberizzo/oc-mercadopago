<?php namespace Mberizzo\Mercadopago\Controllers;

use Illuminate\Routing\Controller;
use MP;

/**
 * Notification Back-end Controller
 */
class Notifications extends Controller
{

    public function mercadopago()
    {
        $mp = new MP(env('MP_CLIENT_ID'), env('MP_CLIENT_SECRET'));

        if (! isset($_GET['id']) || ! ctype_digit($_GET['id'])) {
            abort(400);
            return;
        }

        $paymentInfo = $mp->get_payment_info($_GET['id']);

        if ($paymentInfo['status'] == 200) {
            print_r($paymentInfo['response']);
        }
    }
}
