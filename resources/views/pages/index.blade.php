<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Your Laravel App') }}</title>
    
    <!-- Font & Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    
    @livewireStyles
    
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
   
    <!-- @include('layouts.components.flash-message') -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- ** --}}
            <div class="bg-white mb-4 overflow-hidden shadow-xl sm:rounded-sm">
                <div class="px-6 py-3 sm:px-10 bg-white border-b border-gray-200">                    
                    <h1 class="text-2xl font-medium">ICO Launchpad Closed</h1>
                </div>
            </div>
            {{-- ** --}}
            <div class="bg-white mb-4 overflow-hidden shadow-xl sm:rounded-sm">
                <div class="sm:bg-white border-b border-gray-200">
                    <div class="p-6 sm:px-10 flex justify-between ">
                        <h2 class="text-lg">
                            Welcome to the Merchant Token App
                        </h2>
                        <p class="text-sm">
                        {{$refData->data}}
                        </p>
                    </div>
                    
                    <div class="border-b border-t py-2 border-gray-200">
                    </div>
                    
                    <div class="p-6 sm:px-10 flex justify-between">
                        <i class="fa fa-info-circle pt-1 pr-1  text-green-light text-green-600" aria-hidden="true"></i> <p class="text-sm px-1"><strong>2021-07-01 -</strong> The Merchant Token ICO has successfully ended and are now closed for new investments. No more more tokens can be purchased in the ICO. Within a few days there will be a burn event and token distributions. After that you will be able to buy or sell merchant token on the open market, ie Uniswap.<strong>- Team Hips</strong></p>
                    </div>
                    
                    <div class="border-t bg-gray-100 border-gray-200">
                        <div class="p-6 flex-wrap sm:px-10 flex">
                            <div class="mb-4 border-0 p-0 w-full sm:mb-0 w-auto border-r pr-4 border-gray-200">
                                <p class="text-sm">
                                    Account ID
                                </p>
                                <p class="text-xs rounded-lg px-2 font-medium py-0.8 bg-gray-200 text-gray-700">
                                {{$refData->data}}
                                </p>
                            </div>
                            <div class="mb-4 border-0 p-0 w-full sm:mb-0 w-auto border-r px-4 border-gray-200">
                                <p class="text-sm">
                                    Status
                                </p>
                                <p class="text-xs rounded-lg font-medium px-2 py-0.8  bg-green-100  text-green-600">
                                    Enabled
                                </p>
                            </div>
                            <div class="mb-4 border-0 p-0 w-full sm:mb-0 w-auto border-r px-4 border-gray-200">
                                <p class="text-sm ">
                                    My ETH Balance <span class="text-xxs rounded-lg px-1 py-1 font-medium bg-blue-100 text-indigo-500">$0.00</span>
                                </p>
                                <p class="text-xs ethbalance">
                                 
                                </p>
                            </div>
                            <div class="w-full border-0 p-0 sm:mb-0 w-auto pl-4">
                                <p class="text-sm">
                                    My MTO Balance <span class="text-xxs rounded-lg px-1 font-medium py-1 bg-blue-100 text-indigo-500">$0.00</span>
                                </p>
                                <p class="text-xs">
                                    0.0000000000000000
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ** --}}
            <div class="bg-white mb-4 overflow-hidden shadow-xl sm:rounded-sm">
                <div class="px-6 py-3 bg-white sm:px-10">                    
                    <h2 class="text-lg font-medium">
                        Token Withdrawal
                    </h2>
                </div>
                <div class="px-6 py-2 bg-white border-b border-t bg-gray-100 border-gray-200 sm:px-10">
                    <p class="text-sm">
                        2021-07-01 - Finalizing distribution contracts, this will take a few days...
                    </p>
                </div>
                <div class="p-6 sm:px-10">
                    <p class="text-sm">
                        Token withdrawal address: <span class="text-xxs rounded-lg px-1 py-0.8 font-medium bg-red-300 text-red-700">Not set</span>
                    </p>
                    <button class="py-1 text-sm px-4 text-white bg-indigo-600 rounded-sm mt-3">Set my withdrawal address</button>
                </div>
            </div>
            {{-- ** --}}
            <div class="bg-white mb-4 overflow-hidden shadow-xl sm:rounded-sm">
                <div>
                    <div class="px-6 border-b border-gray-200 py-3 sm:px-10">                    
                        <h2 class="text-lg font-medium">
                            My ETH transactions
                        </h2>
                    </div>
                    <div class="px-6 text-center py-8 sm:px-10">
                        <img class="mx-auto w-6" src="/images/ethereum.png" alt="ethereum">
                        <p class="text-sm mt-4">No Ethereum transactions made to your deposit address yet</p>
                    </div>
                </div>
            </div>
            {{-- ** --}}
            <div class="bg-white mb-4 overflow-hidden shadow-xl sm:rounded-sm">
                <div>
                    <div class="px-6 py-3 border-b border-gray-200 sm:px-10">                    
                        <h2 class="text-lg font-medium">
                            My MTO transactions
                        </h2>
                    </div>
                    <div class="px-6 text-center py-8 sm:px-10">
                        <img class="mx-auto w-6" src="/images/coin.png" alt="token">
                        <p class="text-sm mt-4">No Merchant Token exchanges made in your account yet</p>
                    </div>
                </div>
            </div>
            {{-- ** --}}
        
        </div>
    </div>
</div>
</x-app-layout>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$( window ).on('load',function() {
   var metaMaskEthBlance = localStorage.getItem('ethbalance');
    if(metaMaskEthBlance==null || metaMaskEthBlance =='' || metaMaskEthBlance == undefined){
        $('.ethbalance').text('0');
    }else{
        $('.ethbalance').text(metaMaskEthBlance);
    }
});
</script>
</html>