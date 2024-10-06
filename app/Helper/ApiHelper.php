<?php

namespace App\Helper;

class ApiHelper
{

    public static function apiResponse($status_code = 500, $message = 'Internal Processing Error', $data = [])
    {
        $success = $status_code == '200' ? true : false;
        return response()->json(['success' => $success, 'status' => $status_code, 'message' => $message, 'data' => $data], $status_code);
    }

}
