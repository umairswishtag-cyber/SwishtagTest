<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Exercise2TierPricing extends Controller
{
    public function getPrice(Request $request){
  $input = $request->input('input');
       
        if (!isset($input['quantity']) || !isset($input['tiers'])) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'invalid input'
            ]);
        }
        $quantity = $input['quantity'];
        $tiers = $input['tiers'];
        
        $validTiers = array_filter($tiers, function ($tier) use ($quantity) {
            return $quantity >= $tier['min'];
        });
        
        if (empty($validTiers)) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'null'
            ]);
        }
        
        usort($validTiers, function ($a, $b) {
            return $b['min'] <=> $a['min']; 
            
        });
        $selectedTier = $validTiers[0];
        
        return response()->json([
            'success' => true,
            'data' => [
                'price' => $selectedTier['price']
            ],
            'error' => null
        ]);

    }
}
 