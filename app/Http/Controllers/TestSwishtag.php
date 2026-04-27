<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class TestSwishtag extends Controller
{
      public function store(Request $request)
    {
       $input = $request->input('input');
        if (!$input || !is_array($input)) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'null'
            ]);
        }
       
        $valid = array_filter($input, function($item){
        return $item['approved'] == true && $item['rejected'] == false;
       });


         if(empty($valid)){
          return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'null'
          ]);
         }

         usort($valid, function($a, $b)
         {
            return $b['time'] <=> $a['time'];
         });
         $latest = $valid[0];
         return response()->json([
            'success' => true,
            'data' => [
                'id' => $latest['id']
            ],
            'error' => null
         ]);
    }
}
