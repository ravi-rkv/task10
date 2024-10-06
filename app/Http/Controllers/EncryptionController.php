<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EncryptionController extends Controller
{

    public function encrypt(Request $request)
    {
        $request->validate([
            'data' => 'required|string',
        ]);


        $encryptedData = Crypt::encrypt($request->input('data'));

        return response()->json([
            'encrypted_data' => $encryptedData,
        ]);
    }


    public function decrypt(Request $request)
    {
        $request->validate([
            'encrypted_data' => 'required|string',  // The encrypted data field is required
        ]);

        try {
            // Decrypt the encrypted input data
            $decryptedData = Crypt::decrypt($request->input('encrypted_data'));

            return response()->json([
                'decrypted_data' => $decryptedData,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Invalid encrypted data',
            ], 400);
        }
    }
}
