<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EncryptDecrypt
{
    public function handle($request, Closure $next):Response
    {
        if ($request->isMethod('post') || $request->isMethod('put')) {
            if ($request->has('data')) {
                $decryptedData = Crypt::decrypt($request->input('data'));
                $request->merge($decryptedData);  // Merge decrypted data into the request
            }
        }
        $response = $next($request);

        if ($response->isSuccessful() && $request->isMethod('get')) {
            $encryptedResponse = Crypt::encrypt($response->getContent());
            $response->setContent($encryptedResponse);
        }

        return $response;
    }


}
