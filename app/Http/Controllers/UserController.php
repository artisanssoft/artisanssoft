<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Session;
use Common;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

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
        
        $user= User::where('email', $request->email)->first();


        if($response->success == true){
            $token = $user->createToken('my-app-token')->plainTextToken;
        
            $response = [
                'user' => $user,
                'status' =>201,
                'token' => $token
            ];
            return redirect()->route('launchpad')->with('success','you are logged in successfully!');
        }
        else{
            $response=[
                'status'=>404,
                'message'=>'credentials not matched'
            ];
        }
        return response($response);
       //dd($response);
        // if($response->success==true){

        //     $token = $response->data->token;
        //     Session::put('api_token', $token);
        //     return redirect()->route('launchpad')->with('success','you are logged in successfully!');
        // }else{
        //     return redirect()->route('login-check')->with('error','Please check email or password!');
        // }
    }

    public function register(Request $request){
        // set post fields
       dd($request->all());
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
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
        //     $users = User::create([
        // 'name' => $request->name,
        // 'email' => $request->email,
        // 'password' => Hash::make($request->password),
        // ]);

            $token = $user->createToken('my-app-token')->plainTextToken;

            // check if any referal id exists
            $userIpAddress = Common::getUserIpAddr();
            $referAccountId = \Cookie::get('refer-account-id');
            echo $referAccountId;die;
            $checkData = \App\Models\ReferalCampaign::where(['account_id'=>$referAccountId,'current_user_ip'=>$userIpAddress])->first();
            if($checkData){

            }
            dd($user);

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
    
    public function referal(Request $request){
        try{
            $refId = $request->ref;
            $userIpAddress = Common::getUserIpAddr();
            $checkData = \App\Models\ReferalCampaign::where(['account_id'=>$refId,'current_user_ip'=>$userIpAddress])->first();
            if(!$checkData){
                $referalCampaignObj = new \App\Models\ReferalCampaign();
                $referalCampaignObj->account_id = $refId;
                $referalCampaignObj->current_user_ip = $userIpAddress;
                $referalCampaignObj->sign_up = 0;
                $referalCampaignObj->sign_up_account_id = 0;
                $referalCampaignObj->save();
            }
            $cookie =   \Cookie::queue(\Cookie::make('refer-account-id', $refId,1800));
            return redirect('register');
        }catch(\Exception $e){
            echo $e->getMessage();die;
            return redirect()->back();
        }
    }
}
