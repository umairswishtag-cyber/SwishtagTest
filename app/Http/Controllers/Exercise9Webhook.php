<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Exercise9Webhook extends Controller
{

    public function handleWebhook(Request $request)
    {

        $events = $request->input('input', []);

        if (!is_array($events)) {
            return response()->json([
                "success" => false,
                "data" => null,
                "error" => "Invalid input"
            ]);
        }
        $uniqueIds = [];
        foreach ($events as $event) {
            if (isset($event['id']) && !in_array($event['id'], $uniqueIds)) {
                $uniqueIds[] = $event['id'];
            }
        }

        return response()->json([

            "success" => true,

            "data" => $uniqueIds,

            "error" => null

        ]);
    }
}
