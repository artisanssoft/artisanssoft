<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Session;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class AffiliateController extends Controller
{
    public function index(){
        $token = session('api_token');
        $ch = curl_init('https://api.next.exchange/api/ref');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $headers = array(
               "Accept: application/json",
               "Authorization: Bearer {$token}",
            );
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            //curl_setopt($ch, CURLOPT_POSTFIELDS, 1);
            $response = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response);
            
            if($response->success==true){
                $ref = $response->data;
                return view('pages.affiliate-page', compact('ref'));
            }else{
                $ref ='null';
                return view('pages.affiliate-page', compact('ref'));
            }
           // return view('pages.affiliate-page');
    }
}
