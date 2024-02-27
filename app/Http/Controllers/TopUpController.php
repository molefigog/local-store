<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\models\Items;
use App\Models\Music;
use Illuminate\Support\Facades\Auth;
use App\Models\WebhookData;

use App\Http\Controllers\PaypalController;

class TopUpController extends Controller
{
    public function showTopUpForm()
    {
        $Paypal = config('paypal.paypal_url');
        $PAYPAL_ID = config('paypal.paypal_id');
        $currency = config('paypal.paypal_currency');

        // $userId = Auth::user()->id;

        $user = auth()->user();

        // Retrieve songs for the authenticated user
        $songs = $user->music;
        return view('top-up', compact('songs', 'Paypal', 'PAYPAL_ID', 'currency'));
    }

    public function processTopUp(Request $request)
    {
        $transactionId = $request->input('transaction_id');

        // Check if the transaction ID has already been used
        $webhookData = WebhookData::where('transact_id', $transactionId)->where('used', false)->first();

        if ($webhookData) {
            // Mark the transaction ID as used
            $webhookData->markAsUsed();

            // Update the user's balance
            $user = Auth::user();
            $user->balance += $webhookData->received_amount;
            $user->save();

            return redirect()->route('top-up')->with('success', 'Balance updated successfully.');
        } else {
            return redirect()->route('top-up')->with('error', 'Transaction ID not found or already used.');
        }
    }

    public function index()
    {
        // Retrieve the authenticated user
        $user = auth()->user();

        // Retrieve songs for the authenticated user
        $songs = $user->music;

        return view('sales', compact('songs'));
    }
    
}
