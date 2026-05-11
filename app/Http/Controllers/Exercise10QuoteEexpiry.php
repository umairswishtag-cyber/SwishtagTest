<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Exercise10QuoteEexpiry extends Controller
{ 

    public function checkQuoteExpiry(Request $request)
    {
        $createdAt = $request->input('created_at');
        $validDays = $request->input('valid_days');
        $currentDate = $request->input('current_date');
 
        $expiryDate = date('Y-m-d', strtotime($createdAt . ' + ' . $validDays . ' days'));
 
        $isValid = ($currentDate <= $expiryDate);

        return response()->json([
            'success' => true,
            'data' => ['valid' => $isValid],
            'error' => null
        ]);
    }

}