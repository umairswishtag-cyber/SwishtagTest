<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Ercise11ProductVisibility extends Controller
{
    public function checkProductVisibility(Request $request)
    {
        $input = $request->input('input', []);


        if (!isset($input['customer']['tags']) || !isset($input['products']) || !is_array($input['products'])) {
            return response()->json([
                "success" => false,
                "data" => null,
                "error" => "Invalid input"
            ]);
        }


        $customerTags = $input['customer']['tags'];
        $products = $input['products'];
        $visible = [];
        foreach ($products as $product) {
            $allow = $product['allow'];
            $block = $product['block'];
            if (!empty(array_intersect($block, $customerTags))) {
                continue;
            }
            if (empty($allow) || !empty(array_intersect($allow, $customerTags))) {
                $visible[] = $product['id'];
            }
        }
        return response()->json([
            "success" => true,
            "data" => $visible,
            "error" => null
        ]);
    }
}
