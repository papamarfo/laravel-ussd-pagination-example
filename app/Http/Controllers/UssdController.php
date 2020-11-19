<?php

namespace App\Http\Controllers;

use App\Http\Ussd\States\Welcome;
use Sparors\Ussd\Facades\Ussd;

class UssdController extends Controller
{
    public function index()
    {
        $ussd = Ussd::machine()->set([
            'phone_number' => request('msisdn'),
            'network' => request('network'),
            'sessionId' => request('UserSessionID'),
            'input' => request('msg')
        ])
        ->setInitialState(Welcome::class)
        ->setResponse(function(string $message, string $action) {
            return [
                'USSDResp' => [
                    'action' => $action,
                    'menus' => '',
                    'title' => $message
                ]
            ];
        });
        
        return response()->json($ussd->run());
    }
}
