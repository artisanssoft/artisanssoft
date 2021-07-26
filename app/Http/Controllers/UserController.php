<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;

class UserController extends Controller
{  

    protected $token;

    
    function login(Request $request){
        // set post fields
        $post = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $ch = curl_init('https://api.next.exchange/api/login');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        // execute!
        $response = curl_exec($ch);
        // close the connection, release resources used
        curl_close($ch);
        $response = json_decode($response);

       //dd($response);
        if($response->success==true){
            $token = $response->data->token;
            Session::put('api_token', $token);
            return redirect()->route('launchpad')->with('success','you are logged in successfully!');
        }else{
            return redirect()->route('login-check')->with('error','Please check email or password!');
        }
    }

    public function register(Request $request){
        // set post fields
       
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'c_password' => $request->c_password,
        ];
        $url = "https://api.next.exchange/api/register";

        $curl = curl_init($url);
        $headers = array(
           "Accept: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $resp = curl_exec($curl);
       // dd($resp);
        curl_close($curl);
        $response = json_decode($resp);

        
        if($response->success==true){
            $token = $response->data->token;
            return view('pages.index');
        }else{
            abort(403);
        }
    }

    public function logout(Request $request){
        // set post fields
       
         $token = session('api_token');
        $url = "https://api.next.exchange/api/logout";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
        $headers = array(
               "Accept: application/json",
               "Authorization: Bearer {$token}",
            );
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);             
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        
        if($response->success==true){
            Session::forget('api_token');
            return redirect()->route('login-check');
        }else{
            abort(403);
        }
    }
}
