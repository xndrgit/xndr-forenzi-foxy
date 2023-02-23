<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Throwable;

class PaypalController extends Controller
{
    /**
     * @throws Exception
     * @throws Throwable
     */
    public function payment(Request $request)
    {
        $provider = new PayPalClient;

        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
    }

    /**
     * @throws Throwable
     */
    public function success(Request $request, $user_id)
    {
        $provider = new PayPalClient;

        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
    }

    /**
     * @throws Throwable
     */
    public function cancel(Request $request, $user_id)
    {
        $provider = new PayPalClient;

        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
    }
}
