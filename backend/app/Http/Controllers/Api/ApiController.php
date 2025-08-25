<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function helloWorld()
    {
        return response()->json(['text' => 'Привет мир!']);
    }

    public function getAndTakeText(Request $request)
    {
        // $data = $request->validate([
        //     'text' => ['required', 'string']
        // ]);

        // $text = $data['text'];

        return response()->json(['text' => $request]);
    }
}
