<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;

class SubscriptionController extends Controller
{
    public function create(Request $request) {
        $this->validate($request, [
            'client_id' => 'required|integer',
            'service' => 'required|string',
        ]);
        $subscription = new Subscription($request->all());
        $subscription->active = 1;
        $subscription->save();

        return response()->json(null, 200);
    }

    public function cancel($sid) {
        $subscription = Subscription::findOrFail($sid);
        $subscription->active = 0;
        $subscription->save();

        return response()->json(null, 200);
    }
}
