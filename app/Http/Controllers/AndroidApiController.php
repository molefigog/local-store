<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Webhook;
use Illuminate\Support\Facades\Http;
use App\Mail\WebhookReceived;
use Illuminate\Support\Facades\Mail;

class AndroidApiController extends Controller
{
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'text' => 'required',
    //         'MSISDN' => 'required',
    //     ]);

    //     $webhook = Webhook::create([
    //         'text' => $request->input('text'),
    //         'MSISDN' => $request->input('MSISDN'),
    //     ]);

    //     // Send an email with the incoming data
    //     $data = [
    //         'text' => $request->input('text'),
    //         'MSISDN' => $request->input('MSISDN'),
    //     ];

    //     // You can use Laravel's built-in Mail functionality to send an email
    //     Mail::to('molefigw@gmail.com')->send(new WebhookReceived($data));

    //     return response()->json(['message' => 'Webhook data stored and email sent'], 200);
    // }
    public function store(Request $request, $useremail)
    {
        $request->validate([
            'text' => 'required',
            'MSISDN' => 'required',
        ]);
    
        $webhook = Webhook::create([
            'text' => $request->input('text'),
            'MSISDN' => $request->input('MSISDN'),
        ]);
    
        // Send an email with the incoming data to both useremail and a default email
        $data = [
            'text' => $request->input('text'),
            'MSISDN' => $request->input('MSISDN'),
        ];
    
        $useremail = $useremail . '@gmail.com'; // Concatenation of 'gmail.com'
    
        Mail::to($useremail)->send(new WebhookReceived($data));
        // Mail::to('molefigw@gmail.com')->send(new WebhookReceived($data));
    
        return response()->json(['message' => 'Webhook data stored and email sent'], 200);
    }
    
    

}
