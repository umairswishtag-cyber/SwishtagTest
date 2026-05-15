<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class Exercise14Upsell extends Controller

{
    public function suggestUpsell(Request $request)
    {
        $input = $request->input('input', []);
        if (
            !isset($input['nums']) ||
            !isset($input['target'])
        ) {
           return response()->json([
                "success" => false,
                "data" => null,
                "error" => "Invalid input"
            ]);
        }

       $nums = $input['nums'];
        $target = $input['target'];
        $map = [];
        foreach ($nums as $index => $num) {
            $needed = $target - $num;
            if (isset($map[$needed])) {
                return response()->json([
                    "success" => true,
                    "data" => [$map[$needed], $index],
                    "error" => null
                ]);
            }
            $map[$num] = $index;
        }
       return response()->json([
            "success" => false,
            "data" => [],
            "error" => "No solution found"
        ]);
}
}