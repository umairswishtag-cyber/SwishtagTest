<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use const Dom\VALIDATION_ERR;

class Exercise16FraudCheck extends Controller
{
public function checkFraud(Request $request)
    {

        $data = $request->input('input');
 
        if (!isset($data['order']) || !isset($data['rules'])) {
            return response()->json(['error' => 'Invalid input structure'], VALIDATION_ERR);
        }

        $order = $data['order'];
        $rules = $data['rules'];
 
        if (!is_numeric($order['amount']) || !is_string($order['country']) || !is_numeric($order['previous_orders'])) {
            return response()->json(['error' => 'Invalid order data types'], VALIDATION_ERR);
        }
 
        if (!is_numeric($rules['max_amount']) || !is_array($rules['blocked_countries'])) {
            return response()->json(['error' => 'Invalid rules data types'], VALIDATION_ERR);
        }
 
        $isFlagged = false;

        if ($order['amount'] > $rules['max_amount']) {
            $isFlagged = true;
        }

        if (in_array($order['country'], $rules['blocked_countries'])) {
            $isFlagged = true;
        }

        return response()->json(['flagged' => $isFlagged]);
    }

}
