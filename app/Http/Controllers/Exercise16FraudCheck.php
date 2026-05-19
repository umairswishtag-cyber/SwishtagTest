<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Exercise16FraudCheck extends Controller

{
    public function fraudCheck(Request $request)

    {
        $input = $request->input('input', []);
        if (

            !isset($input['order']) ||

            !isset($input['rules'])
        ) {
            return response()->json([
                "success" => false,
                "data" => null,
                "error" => "Invalid input"
            ]);
        }
        $order = $input['order'];
        $rules = $input['rules'];
        $flagged = false;

        if (

            isset($rules['max_amount']) &&

            $order['amount'] > $rules['max_amount']

        ) {
            $flagged = true;
        }
        if (
            isset($rules['blocked_countries']) &&
            in_array($order['country'], $rules['blocked_countries'])
        ) {
            $flagged = true;
        }

        return response()->json([
            "success" => true,
            "data" => [
                "flagged" => $flagged
            ],
            "error" => null
        ]);
    }
}
