<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Exercise5Discount extends Controller
{
    public function resolveDiscount(Request $request)

    {
        $input = $request->input('input', []);

       
        if (!isset($input['price']) || !isset($input['discounts'])) {
            
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'Invalid input'
                ]);
        }
        $price = $input['price'];
        $discounts = $input['discounts'];
        $finalPrices = [];
        foreach ($discounts as $discount) {
            if ($discount['type'] === 'percentage') {

                $discountAmount = ($price * $discount['value']) / 100;
                $final = $price - $discountAmount;
                
            } elseif ($discount['type'] === 'flat') {
                $final = $price - $discount['value'];
            } else {
                continue;
            }
            $final = max($final, 0);
            $finalPrices[] = $final;
        }
        if (empty($finalPrices)) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'No validation on discounts'
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => [
                'final_price' => min($finalPrices)
            ],

            'error' => null

        ]);
    }
}
