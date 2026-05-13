<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class Exercise12BundlePricing extends Controller
{
   public function bundlePricing(Request $request)
   {
      $input = $request->input('input', []);
      // dd($input);
      if (
         !isset($input['items']) ||
         !isset($input['bundle_price']) ||
         !isset($input['apply_bundle'])
      ) {
         return response()->json([
            "success" => false,
            "data" => null,
            "error" => "Invalid input"
         ]);
      }
      $items = $input['items'];
      $bundlePrice = $input['bundle_price'];
      $applyBundle = $input['apply_bundle'];
      $individualTotal = 0;
      foreach ($items as $item) {
         $individualTotal += $item['price'];
      }
      $finalPrice = $individualTotal;
      if ($applyBundle) {
         $finalPrice = min($individualTotal, $bundlePrice);
      }
      return response()->json([
         "success" => true,
         "data" => [
            "final_price" => $finalPrice
         ],
         "error" => null
      ]);
   }
}
