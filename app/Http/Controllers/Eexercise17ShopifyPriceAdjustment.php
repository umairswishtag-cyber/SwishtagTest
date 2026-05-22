<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Eexercise17ShopifyPriceAdjustment extends Controller
{
     public function adjustPrices(Request $request)
    {
        $prices = $request->input('input.prices');
        $x = $request->input('input.adjustment_value');
 
        if (!$prices || !$x) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid input'
            ], 400);
        }
 
        $flatPrices = [];

        foreach ($prices as $row) {
            foreach ($row as $price) {
                $flatPrices[] = $price;
            }
        } 
        $base = $flatPrices[0];

        foreach ($flatPrices as $price) {
            if (($price - $base) % $x !== 0) {
                return response()->json([
                    'success' => true,
                    'data' => [
                        'minimum_operations' => -1
                    ]
                ]);
            }
        }

        sort($flatPrices);

        $n = count($flatPrices);

        $target = $flatPrices[intdiv($n, 2)];

        $operations = 0;

        foreach ($flatPrices as $price) {
            $operations += abs($price - $target) / $x;
        }

        return response()->json([
            'success' => true,
            'data' => [
                'minimum_operations' => (int)$operations
            ],
            'error' => null
        ]);
    }
}
