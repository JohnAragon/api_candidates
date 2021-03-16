<?php

namespace App\Utils;

class Helpers
{
	  static function errorResponseJsonDB($ex)
    {

        \Log::error('Error DB-->>' . $ex->getMessage());
        return response()->json([
            'status' => 'ERROR',
            'message' => $ex->getMessage(),
            'data' => ''
        ]);
    }

    static function ResponseJson($status, $message, $data)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ]);
    }

}