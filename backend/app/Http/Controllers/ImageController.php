<?php

namespace App\Http\Controllers;

use CURLFile;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public static function uploadImage($image)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.imgur.com/3/upload',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'image' => new CURLFILE($image)
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Client-ID '.env('IMGUR_CLIENT_ID'),
            ),
        ));

        $response = curl_exec($curl);
        if ($error = curl_error($curl)) {
            die('cURL error:'.$error);
        }

        curl_close($curl);
        return json_decode($response, true);
    }
}
