<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApprovalFlowValidator extends Controller
{
   public function validateFlow(Request $request)
{
    $steps = $request->input('input.steps', []);
    if (!is_array($steps)) {
        return response()->json([
            "success" => false,
            "data" => null,
            "error" => "Invalid input"
        ]);
    } 
    $ids = collect($steps)->pluck('id')->toArray();
    $valid = true;
    foreach ($steps as $step) {
        if (!array_key_exists('id', $step)) {
            $valid = false;
            break;
        } 
        if (!is_null($step['depends_on']) && !in_array($step['depends_on'], $ids)) {
            $valid = false;
            break;
        }
    }
    return response()->json([
        "success" => true,
        "data" => [
            "valid" => $valid
        ],
        "error" => null
    ]);
}
}
 