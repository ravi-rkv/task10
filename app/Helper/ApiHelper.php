<?php

namespace App\Helper;

class ApiHelper
{

    public static function apiResponse($resp_code = 500, $resp_desc = 'Internal Processing Error', $data = [])
    {
        $success = $resp_code == '200' ? true : false;
        return response()->json(['status' => $success, 'resp_code' => $resp_code, 'resp_desc' => $resp_desc, 'data' => $data], $resp_code);
    }

    public static function encrypt($data = [])
    {


    }



}
