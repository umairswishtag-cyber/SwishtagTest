<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Exercise4VendorAllocation extends Controller
{
   public function allocate(Request $request){
    $input = $request->input('input', []);
    if (!isset($input['order_qty']) || !isset($input['vendors'])) {
        return response()->json([
            'success' => false,
            'data' => null,
            'error' => 'Not Valid'
            ]);
            }
            
            $remaining = $input['order_qty']; 
            $vendors = $input['vendors'];
            $result = [];

            // dd($request->input('input.vendors'));
            
            foreach ($vendors as $vendor) {
                
                if ($remaining <= 0) break;
                $allocate = min($remaining, $vendor['stock']);
                $result[] = [
                    'vendor_id' => $vendor['id'],
                    'allocated' => $allocate
                    ];
                    $remaining -= $allocate;
                    }
                    
                return response()->json([
        'success' => true,
        'data' => $result,

        'error' => null
    
        ]);

}

}