<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Exercise13CartMerge extends Controller
{
    public function mergeCart(Request $request)

    {
        $input = $request->input('input', []);
        if (!isset($input['guest']) || !isset($input['user'])) {
            return response()->json([
                "success" => false,
                "data" => null,
                "error" => "Invalid input"
            ]);
        }
        $guestCart = $input['guest'];
        $userCart = $input['user'];
        $merged = [];
        foreach ($userCart as $item) {
            $merged[$item['id']] = [
                "id" => $item['id'],
                "qty" => $item['qty']
            ];
        }
        foreach ($guestCart as $item) {

           if (isset($merged[$item['id']])) {
                $merged[$item['id']]['qty'] += $item['qty'];
            } else {
                $merged[$item['id']] = [
                    "id" => $item['id'],
                    "qty" => $item['qty']
                ];
            }
        }
        return response()->json([
            "success" => true,
            "data" => array_values($merged),
            "error" => null
        ]);
    }
}
