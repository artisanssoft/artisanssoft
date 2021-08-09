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
                $chb = curl_init("https://api.blockcypher.com/v1/eth/main/addrs/738d145faabb1e00cf5a017588a9c0f998318012");
                curl_setopt($chb, CURLOPT_RETURNTRANSFER, true);
                $headers = array(
                "Accept: application/json",
                );
                curl_setopt($chb, CURLOPT_HTTPHEADER, $headers);
                $res = curl_exec($chb);
                curl_close($chb);
                $res= json_decode($res);
                dd($res);
                return view('pages.affiliate-page', compact('ref','res'));
            }else{
                $ref ='null';
                $res = 'null';
                return view('pages.affiliate-page', compact('ref','res'));
            }
           // return view('pages.affiliate-page');
    }
}
