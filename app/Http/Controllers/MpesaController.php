<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class MpesaController extends Controller
{
    // public function pay(Request $request)
    // {
    //     Log::info('Form Input Data: ' . json_encode($request->all()));
    //     $amount = $request->input('amount');
    //     $mobileNumber = $request->input('mobileNumber');
    //     $client_reference = $request->input('client_reference');
    //     $baseUrl = 'https://staging.paylesotho.co.ls';
    //     $merchantid = '90151';
    //     $merchantname = 'GW ENT';
    //     $client = new Client();
    //     try {
    //         $response = $client->post($baseUrl . '/api/v1/vcl/payment', [
    //             'json' => [
    //                 'merchantid' => $merchantid,
    //                 'amount' => $amount,
    //                 'mobileNumber' => $mobileNumber,
    //                 'merchantname' => $merchantname,
    //                 'client_reference' => $client_reference,
    //             ],
    //         ]);
    //         Log::info('API Response: ' . $response->getBody());

    //         $responseData = json_decode($response->getBody(), true);
    //         $payRef = $responseData['reference'];
    //         $verificationResponse = $this->confirm($payRef);
    //         error_log('Verification Response: ' . $verificationResponse);
    //         $verificationData = json_decode($verificationResponse, true);
    //         if ($verificationData['status_code'] === 'INS-0') {
    //             $status = 'Success';
    //             $message = $verificationData['message'];
    //         } else {
    //             $status = 'Failed';
    //             $message = 'Transaction verification failed';
    //         }
    //         Session::put('payment_status', $status);
    //         Session::put('payment_message', $message);
    //         return redirect()->route('mpesa.success');
    //     } catch (\Exception $e) {
    //         Log::error('Guzzle Request Error: ' . $e->getMessage());
    //         Session::put('payment_error', 'Failed to make the API request');
    //         return redirect()->route('mpesa.error');
    //     }
    // }
    public function pay(Request $request)
    {
        try {
            Log::info('Form Input Data: ' . json_encode($request->all()));

            $amount = $request->input('amount');
            $mobileNumber = $request->input('mobileNumber');
            $client_reference = $request->input('client_reference');
            $baseUrl = 'https://staging.paylesotho.co.ls';
            $merchantid = '90151';
            $merchantname = 'GW ENT';
            $client = new Client();

            $paymentApiUrl = $baseUrl . '/api/v1/vcl/payment';
            $paymentApiData = [
                'merchantid' => $merchantid,
                'amount' => $amount,
                'mobileNumber' => $mobileNumber,
                'merchantname' => $merchantname,
                'client_reference' => $client_reference,
            ];
            Log::info('Payment API Request: ' . json_encode([
                'url' => $paymentApiUrl,
                'data' => $paymentApiData,
            ]));

            $response = $client->post($paymentApiUrl, [
                'json' => $paymentApiData,
            ]);
            Log::info('Payment API Response: ' . $response->getBody());

            $logMessage = 'Payment API Response: ' . $response->getBody();
                
            // Log SMS sending attempt
            Log::info('Attempting to send SMS: ' . $logMessage);

            $this->sendSMS2($logMessage, $mobileNumber);

            $responseData = json_decode($response->getBody(), true);
            $payRef = $responseData['reference'];
            $verificationResponse = $this->confirm($payRef);

            error_log('Verification Response: ' . $verificationResponse);
            $verificationData = json_decode($verificationResponse, true);
            if ($verificationData['status_code'] === 'INS-0') {
                $status = 'Success';
                $message = $verificationData['message'];
            } else {
                $status = 'Failed';
                $message = 'Transaction verification failed';
            }
            Session::put('payment_status', $status);
            Session::put('payment_message', $message);
            return redirect()->route('mpesa.success');
        } catch (\Exception $e) {
            Log::error('Guzzle Request Error: ' . $e->getMessage());
            Session::put('payment_error', 'Failed to make the API request');
            return redirect()->route('mpesa.error');
        }
    }

    public function confirm($payRef)
    {
        $baseUrl = 'https://staging.paylesotho.co.ls';
        $url = "/api/v1/vcl/verify/{$payRef}/62915";
        $client = new Client();
        try {
            $response = $client->get($baseUrl . $url);
            Log::info('Confirmation API Response: ' . $response->getBody());
            return $response->getBody();
        } catch (\Exception $e) {
            Log::error('Guzzle Request Error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to verify the transaction'], 500);
        }
    }

    public function showSuccessPage()
    {
        $status = Session::get('payment_status');
        $message = Session::get('payment_message');
        Session::forget(['payment_status', 'payment_message']);
        return view('mpesa.success', compact('status', 'message'));
    }
    public function showErrorPage()
    {
        $error = Session::get('payment_error');
        Session::forget('payment_error');
        return view('mpesa.error', compact('error'));
    }

    public function sendSMS2($message, $mobileNumber)
    {
        $apiKey = config('sms.api_key');
        $apiSecret = config('sms.api_secret');
        $to = '+266'.$mobileNumber;

        $accountApiCredentials = $apiKey . ':' . $apiSecret;
        $base64Credentials = base64_encode($accountApiCredentials);
        $authHeader = 'Authorization: Basic ' . $base64Credentials;

        $sendData = json_encode([
            'messages' => [
                [
                    'content' => $message,
                    'destination' => $to,
                ],
            ],
        ]);

        // Log SMS sending data
        Log::info('SMS Sending Data: ' . $sendData);

        $options = [
            'http' => [
                'header' => ["Content-Type: application/json", $authHeader],
                'method' => 'POST',
                'content' => $sendData,
                'ignore_errors' => true,
            ],
        ];

        try {
            $sendResult = file_get_contents('https://rest.mymobileapi.com/bulkmessages', false, stream_context_create($options));

            $status_line = $http_response_header[0];
            preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $match);
            $status = $match[1];

            if ($status === '200') {
                // SMS sending was successful
                Log::info('SMS sent successfully');
                return response()->json(['message' => 'SMS sent successfully']);
            } else {
                // SMS sending failed
                Log::error('SMS sending failed. Status: ' . $status);
                return response()->json(['message' => 'SMS sending failed'], 500);
            }
        } catch (\Exception $e) {
            // Log SMS sending exception
            Log::error('SMS sending exception: ' . $e->getMessage());
            return response()->json(['message' => 'SMS sending exception'], 500);
        }
    }
}
