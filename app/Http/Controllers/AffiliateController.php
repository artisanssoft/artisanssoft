<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Session;
use Common;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class AffiliateController extends Controller
{
    public function index(){
        $token = session('api_token');
        $ch = curl_init('https://api.next.exchange/api/tokensale/address/eth');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
            "Accept: application/json",
            "Authorization: Bearer {$token}",
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        $refData = \Common::userRefData();
        $refId = $refData->data;

        $referalCampaignData = \App\Models\ReferalCampaign::where(['account_id'=>$refId])->get();
        $uniqueClicks = count($referalCampaignData);
        $signUps = 0;
        foreach($referalCampaignData as $val):
            if($val->sign_up == 1):
                $signUps++;
            endif;
        endforeach;
        if($response->success==true){
            $ref = '';
            $res= '';
        }else{
            $ref ='null';
            $res = 'null';
            $refId = '';
        }
        return view('pages.affiliate-page', compact('ref','res','refId','signUps','uniqueClicks'));
    }



}
