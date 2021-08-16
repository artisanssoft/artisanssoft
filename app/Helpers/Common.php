<?php
namespace App\Helpers;
class Common{
    public static function userRefData(){
        // get account or ref id
        $token = session('api_token');
        $chRef = curl_init('https://api.next.exchange/api/ref');
        curl_setopt($chRef, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
            "Accept: application/json",
            "Authorization: Bearer {$token}",
        );
        curl_setopt($chRef, CURLOPT_HTTPHEADER, $headers);
        $resRef = curl_exec($chRef);
        curl_close($chRef);
        $resRef= json_decode($resRef);
        $refData = [];
        if($resRef){
            $refData = $resRef;
        }
        return $refData;
    }

    public static function getUserIpAddr(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public static function getUserEthAddress(){
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
            return $response;
    }

}
?>