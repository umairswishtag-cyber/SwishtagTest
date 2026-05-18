<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Exercise15ShippingRule extends Controller
{
    public function shippingRuleEngine(Request $request)
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
        $matchedRules = [];
        foreach ($rules as $rule) {
            $matched = true;
            if (
                isset($rule['max_weight']) &&
                $order['weight'] > $rule['max_weight']
            ) {
                $matched = false;
            }
            if (
                isset($rule['country']) &&
                $order['country'] !== $rule['country']
            ) {
                $matched = false;
            }
            if ($matched) {
                $matchedRules[] = $rule;
            }
        }
        // dd($matchedRules);
        if (empty($matchedRules)) {
            return response()->json([
                "success" => false,
                "data" => null,
                "error" => "No shipping rule matched"
            ]);
        }
        usort($matchedRules, function ($a, $b) {
            return $b['priority'] <=> $a['priority'];
        });
        $selected = $matchedRules[0];
        // dd($selected);
        return response()->json([
            "success" => true,
            "data" => [
                "method" => $selected['method']
            ],

            "error" => null
        ]);
    }
}
