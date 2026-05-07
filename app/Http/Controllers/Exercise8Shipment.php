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
    if (!is_numeric($order) || !is_array($shipped) || !array_reduce($shipped, fn($carry, $item) => $carry && is_numeric($item), true)) {
            return response()->json([
                "success" => false,
                "data" => null,
                "error" => "Invalid input. 'ordered' and 'shipped' values must be numeric."
            ], 400);
        }

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
