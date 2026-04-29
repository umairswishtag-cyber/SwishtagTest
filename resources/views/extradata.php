<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Eexercise3CartValidator extends Controller
{


 public function validateCart(Request $request)
{
    $items = $request->input('input’, []);
    if (!is_array($items)) {
        return response()->json([
            'success' => false,
            'data' => null,
            'error' => 'Invalid input'
        ]);
    }
    $invalidItems = collect($items)
        ->filter(function ($item) {
            return isset($item['id’], $item['required’], $item['done’]) &&
                filter_var($item['required’], FILTER_VALIDATE_BOOLEAN) &&
                !filter_var($item['done’], FILTER_VALIDATE_BOOLEAN);
        })
        ->pluck('id’)
        ->values()
        ->toArray();
    return response()->json([
        'success' => true,
        'data' => [
            'valid' => empty($invalidItems),
            'invalid_items' => $invalidItems
        ],
        'error' => null
    ]);
}
    }