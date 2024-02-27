<?php

namespace App\Http\Controllers;

use App\Models\SmsData;
use Illuminate\Http\Request;
use App\Models\WebhookData;


use Carbon\Carbon;

class WebhookController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming payload
        $validatedData = $request->validate([
            'data.content' => 'required',
            'data.owner' => 'required',
            'data.sim' => 'required',
            'data.timestamp' => 'required',
            'data.contact' => 'required',
        ]);

        // Extract relevant information from SMS content
        $smsContent = $validatedData['data']['content'];

        preg_match('/Transact ID ([A-Z0-9]+)/', $smsContent, $transactIdMatches);
        $transactId = $transactIdMatches[1] ?? null;

        preg_match('/received M(\d+\.\d+)/i', $smsContent, $receivedMatches);
        $receivedAmount = $receivedMatches[1] ?? null;

        // Convert the received amount to a decimal without the "M" symbol
        $receivedAmountDecimal = floatval($receivedAmount);

        preg_match('/from (\d+)/i', $smsContent, $fromMatches);
        $fromNumber = $fromMatches[1] ?? null;

        // Convert the timestamp to the correct format
        $timestamp = Carbon::parse($validatedData['data']['timestamp'])->toDateTimeString();

        if ($validatedData['data']['contact'] !== 'MPESA') {
            // Store in sms_data table
            SmsData::create([
                'content' => $validatedData['data']['content'],
                'from' => $validatedData['data']['owner'],
                'sim' => $validatedData['data']['sim'],
                'timestamp' => $timestamp,
                'to' => $validatedData['data']['contact'],
            ]);
        } else {
            // Store in webhook_data table
            WebhookData::create([
                'content' => $validatedData['data']['content'],
                'from' => $validatedData['data']['owner'],
                'sim' => $validatedData['data']['sim'],
                'timestamp' => $timestamp,
                'to' => $validatedData['data']['contact'],
                'transact_id' => $transactId,
                'received_amount' => $receivedAmountDecimal,
                'from_number' => $fromNumber,
            ]);
        }

        return response()->json(['message' => 'Data stored successfully']);
    }
}
