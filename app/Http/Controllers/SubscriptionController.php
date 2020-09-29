<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Channel $channel)
    {
        $subscription=$channel->subscriptions()->create([
            'user_id'=>auth()->user()->id
        ]);
       return response()->json($subscription);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel, Subscription $subscription)
    {
        $subscription->delete();
        Log::info($subscription->user_id);
        return response()->json([]);
    }
}
