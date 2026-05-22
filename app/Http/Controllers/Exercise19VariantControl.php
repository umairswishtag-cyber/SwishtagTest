<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Exercise19VariantControl extends Controller
{

public function controlVariant(Request $request)
    {
       $input = $request->input('input', []);
        if (
            !isset($input['options']) ||
            !isset($input['limit'])
        ) {
           return response()->json([
              "success" => false,
                "data" => null,
               "error" => "Invalid input"
            ]);
        }
        $options = $input['options'];
        $limit = $input['limit'];
        $totalCombinations = 1;
        foreach ($options as $option) {
           $totalCombinations *= $option['values'];
        }

        $exceeded = $totalCombinations > $limit;
        return response()->json([
            "success" => true,
            "data" => [
                "total_combinations" => $totalCombinations,
                "exceeded" => $exceeded
            ],
            "error" => null
        ]);
    }
        
    }
