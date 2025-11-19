<?php

namespace App\Http\Controllers;

use App\Models\Ping;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PingController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'uuid'            => ['required', 'string'],
            'battery_percent' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        Ping::create([
            'uuid'            => $validated['uuid'],
            'battery_percent' => (int) $validated['battery_percent'],
        ]);

        return response()->json(['status' => 'ok']);
    }
}
