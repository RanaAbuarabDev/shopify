<?php

namespace App\Helpers;

class ResponseFormatter
{
    public static function success($message, $data = null)
    {
        return response()->json(['message' => $message, 'data' => $data], 200);
    }
    public static function error($message, $code = 400)
    {
        return response()->json(['message' => $message], $code);
    }
}
