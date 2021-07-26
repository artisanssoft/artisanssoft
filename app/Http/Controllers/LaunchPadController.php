<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class LaunchPadController extends Controller
{
    public function index(){
        $token = session('api_token');
        $url = "https://api.next.exchange/api/user";

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $headers = array(
               "Accept: application/json",
               "Authorization: Bearer {$token}",
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            //for debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            $resp = curl_exec($curl);
            
            curl_close($curl);
        return view('pages.index',compact('resp'));
    }
}
