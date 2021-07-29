<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Http;
use Session;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

         Fortify::authenticateUsing(function (LoginRequest $request) {
            $post = [
                'email' => $request->email,
                'password' => $request->password,
            ];
            $ch = curl_init('https://api.next.exchange/api/login');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $response = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response);
            if($response->success==true){
                $user = User::where('email', $request->email)->first();
                $token = $response->data->token;
                if ($user && Hash::check($request->password, $user->password)){
                    return $user;
                }else{
                    $users = User::create([
                        'name' => $response->data->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                    ]);
                    $user = User::where('email', $request->email)->first();
                    if ($user && Hash::check($request->password, $user->password)){
                        return $user;
                    }else{
                        return view('login')->with('error','Credentials not matched!');
                    }
                }
            }else{
                return view('login')->with('error','Credentials not matched!');
            }
        });

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
