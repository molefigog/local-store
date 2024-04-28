<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Music;
use App\Models\Mpesa;
use App\Models\Beat;
use App\Models\Downloads;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\MusicController;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Mail\MusicDownloadNotification;

class MpesaController extends Controller
{
    public function beatPay(Request $request)
    {
        try {
            Log::info('Form Input Data: ' . json_encode($request->all()));
            $amount = $request->input('amount');
            $mobileNumber = $request->input('mobileNumber');
            $client_reference = $request->input('client_reference');
            $baseUrl = 'https://staging.paylesotho.co.ls';
            $merchantid = config('cpay.mpesa_sc');
            $merchantname = config('cpay.merchant_name');
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
            $responseData = json_decode($response->getBody(), true);
            $payRef = $responseData['reference'];
            $verificationResponse = $this->confirm($payRef);
            $verificationData = json_decode($verificationResponse, true);
            error_log('Verification Response: ' . $verificationResponse);
            if ($verificationData['status_code'] === 'INS-0') {
                $status = 'success';
                $message = $verificationData['message'];


                $beatId = $request->input('beatId');
                Log::info('Attempting to read beatid: ' . $beatId);
                $downloadUrl = route('beat.download', ['beat' => $beatId]);

                $responseData = [
                    'status' => $status,
                    'message' => $message,
                    'download_url' => $downloadUrl,
                ];
                return response()->json($responseData);
            } else {
                $status = 'error';
                $message = 'Transaction verification failed Error 400';

                $responseData = [
                    'status' => $status,
                    'message' => $message,
                ];
                return response()->json($responseData);
            }
        } catch (\Exception $e) {
            Log::error('Guzzle Request Error: ' . $e->getMessage());
            $responseData = [
                'status' => 'error',
                'message' => 'Failed to make the API request',
            ];
            return response()->json($responseData);
        }
    }
    public function downloadBeat($beatId)
    {
        Log::info('Beat ID: ' . $beatId);
        $beat = Beat::where('id', $beatId)->where('used', false)->first();

        if (!$beat) {
            Log::error('Beat track not found for ID: ' . $beatId);
            return redirect()->back()->with('error', 'Beat track not found.');
        }

        $beatFilePath = $beat->file;
        $beat->markAsUsed();

        if (!Storage::exists($beatFilePath)) {
            Log::error('Beat file not found in storage: ' . $beatFilePath);
            return redirect()->back()->with('error', 'Beat file not found.');
        }

        $response = Storage::download($beatFilePath, $beat->artist . '-' . $beat->title . '.mp3');
        Log::info('Download Response: ' . $response);

        return $response;
    }

    public function uploadStatus(Request $request)
    {
        try {
            // Log::info('Form Input Data: ' . json_encode($request->all()));
            $userId = $request->input('userId');
            $amount = $request->input('amount');
            $mobileNumber = $request->input('mobileNumber');
            $client_reference = $request->input('client_reference');
            $baseUrl = 'https://staging.paylesotho.co.ls';
            $merchantid = config('cpay.mpesa_sc');
            $merchantname = config('cpay.merchant_name');
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
            $responseData = json_decode($response->getBody(), true);
            $payRef = $responseData['reference'];
            $verificationResponse = $this->confirm($payRef);
            $this->mpesaTransaction($payRef, $mobileNumber, $amount);
            $verificationData = json_decode($verificationResponse, true);
            error_log('Verification Response: ' . $verificationResponse);
            if ($verificationData['status_code'] === 'INS-0') {
                $status = 'success';
                $message = $verificationData['message'];

                $user = User::find($userId);
                $user->upload_status += 1;
                $user->save();
                // $uploadUrl = route('all-music.create');
                $responseData = [
                    'status' => $status,
                    'message' => $message,
                    // 'upload_url' => $uploadUrl,
                ];
                return response()->json($responseData);
            } else {
                $status = 'error';
                $message = 'Transaction verification failed Error 400';

                $responseData = [
                    'status' => $status,
                    'message' => $message,
                ];
                return response()->json($responseData);
            }
        } catch (\Exception $e) {
            Log::error('Guzzle Request Error: ' . $e->getMessage());
            $responseData = [
                'status' => 'error',
                'message' => 'Failed to make the API request',
            ];
            return response()->json($responseData);
        }
    }
    public function pay(Request $request)
    {
        try {
            // Log::info('Form Input Data: ' . json_encode($request->all()));
            $amount = $request->input('amount');
            $mobileNumber = $request->input('mobileNumber');
            $client_reference = $request->input('client_reference');
            $baseUrl = 'https://staging.paylesotho.co.ls';
            $merchantid = config('cpay.mpesa_sc');
            $merchantname = config('cpay.merchant_name');
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
            $responseData = json_decode($response->getBody(), true);
            $payRef = $responseData['reference'];
            $verificationResponse = $this->confirm($payRef);
            $verificationData = json_decode($verificationResponse, true);
            error_log('Verification Response: ' . $verificationResponse);
            if ($verificationData['status_code'] === 'INS-0') {

                $this->updateUserBalance($request->input('musicId'), $request->input('amount'));
                $this->userMusic($request);

                $status = 'success';
                $message = $verificationData['message'];

                $musicId = $request->input('musicId');
                $downloadUrl = route('music.download', ['music' => $musicId]);

                $responseData = [
                    'status' => $status,
                    'message' => $message,
                    'download_url' => $downloadUrl,
                ];
                return response()->json($responseData);
            } else {
                $status = 'error';
                $message = 'Transaction verification failed Error 400';

                $responseData = [
                    'status' => $status,
                    'message' => $message,
                ];
                return response()->json($responseData);
            }
        } catch (\Exception $e) {
            Log::error('Guzzle Request Error: ' . $e->getMessage());
            $responseData = [
                'status' => 'error',
                'message' => 'Failed to make the API request',
            ];
            return response()->json($responseData);
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

    public function userMusic(Request $request)
    {
        $musicId = $request->input('musicId');
        $mobileNumber = $request->input('mobileNumber');
        $music = Music::find($musicId);
        if ($music) {
            $otp = 'GW' . rand(1000, 9999);
            $url = config('app.url');
            $fullurl = $url . '/getdownloads';
            $downloads = new Downloads([
                'artist' => $music->artist,
                'title' => $music->title,
                'mobile' => $mobileNumber,
                'file' => $music->file,
                'otp' => $otp,
            ]);
            $downloads->save();
            $message = 'Enter this ' . $otp . ' on ' . $fullurl . ' if download did not start';
            $this->sendSMS2($message,  $mobileNumber);
        } else {
            Log::error('Music track not found for ID: ' . $musicId);
        }
    }


    private function updateUserBalance($musicId, $amount)
    {
        $music = Music::find($musicId);
        if (!$music) {
            Log::error('Music track not found for ID: ' . $musicId);
            return;
        }
        $pivot = $music->users()->wherePivot('music_id', $musicId)->first()->pivot;
        if (!$pivot) {
            Log::error('Pivot record not found for music ID: ' . $musicId);
            return;
        }
        $uploaderId = $pivot->user_id;
        $user = User::find($uploaderId);
        if (!$user) {
            Log::error('Uploader user not found for ID: ' . $uploaderId);
            return;
        }
        $user->balance += $amount;
        $user->save();
        Log::info('User balance updated successfully for User ID: ' . $user->id);
    }

    public function sendSMS2($message, $mobileNumber)
    {
        $apiKey = config('sms.api_key');
        $apiSecret = config('sms.api_secret');
        $to = '+266' . $mobileNumber;
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
        Log::info('SMS Sending Data: ' . $sendData);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://rest.mymobileapi.com/bulkmessages');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $sendData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            $authHeader
        ]);

        $result = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($status === 200) {
            Log::info('SMS sent successfully');
            return response()->json(['message' => 'SMS sent successfully']);
        } else {
            Log::error('SMS sending failed. Status: ' . $status);
            return response()->json(['message' => 'SMS sending failed'], 500);
        }
    }

    // public function mpesaTransaction($payRef, $mobileNumber, $amount)
    // {

    //     $net_income = $amount - ($amount * 0.01);
    //     $pay_lesotho = $amount * 0.01;

    //     $transaction = new Mpesa([
    //         'number' => $mobileNumber,
    //         'ref' => $payRef,
    //         'gross_income' =>  $amount,
    //         'net_income' => $net_income,
    //         'pay_lesotho' => $pay_lesotho
    //     ]);

    //     $transaction->save();
    // }

    public function downloadSong($musicId)
    {
        Log::info('Music ID: ' . $musicId);
        $music = Music::find($musicId);

        if (!$music) {
            Log::error('Music track not found for ID: ' . $musicId);
            return redirect()->back()->with('error', 'Music track not found.');
        }
        $musicFilePath = $music->file;
        $music->md++;
        $music->downloads++;
        $music->save();

        if (!Storage::exists($musicFilePath)) {
            Log::error('Music file not found in storage: ' . $musicFilePath);
            return redirect()->back()->with('error', 'Music file not found.');
        }
        $response = Storage::download($musicFilePath, $music->artist . '-' . $music->title . '.mp3');
        Log::info('Download Response: ' . $response);
        return $response;
    }
    // public function downloadSong($musicId)
    // {
    //     // Logging the music ID for debugging purposes
    //     Log::info('Music ID: ' . $musicId);

    //     // Finding the music track based on the provided ID
    //     $music = Music::find($musicId);

    //     // If music track not found, log error and redirect back with error message
    //     if (!$music) {
    //         Log::error('Music track not found for ID: ' . $musicId);
    //         return redirect()->back()->with('error', 'Music track not found.');
    //     }

    //     $user = User::find($uploaderId);

    //     // If user not found, log error and return
    //     if (!$user) {
    //         Log::error('Uploader user not found for ID: ' . $uploaderId);
    //         return redirect()->back()->with('error', 'Uploader user not found.');
    //     }

    //     // Incrementing user's balance
    //     $user->balance += $music->amount;
    //     $user->save();

    //     $music->md++; // What is md? Ensure it's defined properly
    //     $music->downloads++;
    //     $music->save();

    //     // Retrieving the file path of the music track
    //     $musicFilePath = $music->file;

    //     // If music file not found in storage, log error and redirect back with error message
    //     if (!Storage::exists($musicFilePath)) {
    //         Log::error('Music file not found in storage: ' . $musicFilePath);
    //         return redirect()->back()->with('error', 'Music file not found.');
    //     }

    //     // Downloading the music file and returning the response
    //     $response = Storage::download($musicFilePath, $music->artist . '-' . $music->title . '.mp3');

    //     // Logging the download response for debugging purposes
    //     Log::info('Download Response: ' . $response);

    //     return $response;
    // }


}
