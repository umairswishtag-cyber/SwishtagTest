<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Exercise8Shipment extends Controller
{
    public function trackShipment(Request $request)
    {
        $order = $request->input('input.ordered');
        $shipped = $request->input('input.shipped');

        $totalshipped = array_sum($shipped);
    
        $remaining = max(0, $order - $totalshipped);
        return response()->json([
            "success" => true,
            "data" => [
                "remaining" => $remaining
            ],
            "error" => null
        ]);
    }
}
