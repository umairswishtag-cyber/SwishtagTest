<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Exercise7Inventory extends Controller
{
    public function reserve(Request $request)
    {

        $input = $request->input('input', []);
        if (!isset($input['stock']) || !isset($input['requests'])) {
            return response()->json([
                "success" => false,
                "data" => null,
                "error" => "Invalid input"
            ]);
        }
        $stock = $input['stock'];
        $requests = $input['requests'];
        $result = [];
        foreach ($requests as $request) {
            if ($request < 0) {
                $result[] = false;
                continue;
            }
            if ($stock >= $request) {
                $result[] = true;
                $stock -= $request;
            } else {
                $result[] = false;
            }
        }
        return response()->json([
            "success" => true,
            "data" => $result,
            "error" => null
        ]);
    }
}
