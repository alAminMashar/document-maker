<?php

namespace App\Http\Controllers;
use AfricasTalking\SDK\AfricasTalking;
use Illuminate\Http\Request;

class SmsController extends Controller
{

    public function sendMessage()
    {
        // use 'sandbox' for development in the test environment
        $username = 'sandbox';
        // use your sandbox app API key for development in the test environment
        $apiKey   = '28b2216e64b89abef817272a71721161c126e3ea99eb6eb996066f91c45e1813';
        $AT       = new AfricasTalking($username, $apiKey);

        // Get one of the services
        $sms      = $AT->sms();

        // Use the service
        $result   = $sms->send([
            'to'      => '+254799147582',
            'message' => 'hey there this is a test from Canon Security Services. Please Ignore.'
        ]);

        // print_r($result);

    }

}

