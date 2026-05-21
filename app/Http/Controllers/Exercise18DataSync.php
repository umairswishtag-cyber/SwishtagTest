<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Exercise18DataSync extends Controller
{
    public function syncData(Request $request)
    {
        $validatedData =  $request->validate([
            'input' => 'required|array',
            'input.shopify' => 'required|array',
            'input.shopify.price' => 'required|numeric',
            'input.shopify.updated_at' => 'required|numeric',
            'input.internal' => 'required|array',
            'input.internal.price' => 'required|numeric',
            'input.internal.updated_at' => 'required|numeric',
        ]);

        $shopifyData = $validatedData['input']['shopify'];
        $internalData = $validatedData['input']['internal'];

        if ($shopifyData['updated_at'] > $internalData['updated_at']) {
            $price = $shopifyData['price'];
            $internalData['updated_at'] = $shopifyData['updated_at'];
        } else {
            $price = $internalData['price'];
            $shopifyData['updated_at'] = $internalData['updated_at'];
        }

        return response()->json([
            'success' => true,
            'data' => $price,
            'error' => null

        ]);
    }
}
