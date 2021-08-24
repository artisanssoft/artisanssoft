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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Next Page --}}

            <div class="alert alert-danger" id="alert-error-https" style="display: none;margin-bottom:20px;">
                You can run this only over HTTPS connection.
            </div>
            <div id="error-msg"></div>

            <div class="bg-white mb-4 overflow-hidden shadow-xl sm:rounded-sm">
                <div class="sm:bg-white border-b border-gray-200">
                    <div class="p-6 sm:px-10 flex justify-between ">
                        <h2 class="text-lg">
                            My Token
                        </h2>
                        <p class="text-sm">
                            {{$refData->data}}
                        </p>
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
                                <p class="text-sm">
                                    ETH Balance
                                </p>
                                <p class="text-xs" id="eth-balance">
                                    0.0000000000000000
                                </p>
                            </div>
                            <div class="w-full border-0 p-0 sm:mb-0 w-auto pl-4">
                                <p class="text-sm">
                                    MTO Balance
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
                <div>
                    <div class="px-6 border-b border-gray-200 py-3 sm:px-10">                    
                        <h2 class="text-lg font-medium">
                            My ETH transactions
                        </h2>
                    </div>
                    <div class="px-6 text-center py-8 sm:px-10">
                        {{-- <img class="mx-auto w-6" src="/images/ethereum.png" alt="ethereum"> --}}
                        <div id="transaction-blck">

                        </div>
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
            <div class="bg-white mb-4 overflow-hidden shadow-xl sm:rounded-sm">
                <div>
                    <div class="px-6 text-center py-8 sm:px-10">
                        <h1 class="text-lg font-medium">Wallet Connect Web-3</h1>
                        <div id="prepare">
                            <button class="btn btn-primary" id="btn-connect">Connect wallet</button>
                        </div>
                        <div id="connected" style="display: none">
                            <button class="btn btn-primary" id="btn-disconnect">Disconnect wallet</button>
                            <hr>
                            <div id="network">
                                <p><strong>Connected blockchain:</strong> <span id="network-name"></span></p>
                                <p><strong>Selected account:</strong> <span id="selected-account"></span></p>
                            </div>
                            <hr>
                            <h3>All account balances</h3>
                            <table class="table table-listing">
                                <thead>
                                <th>Address</th>
                                <th>ETH balance</th>
                                </thead>

                                <tbody id="accounts">
                                </tbody>
                            </table>
                            <p>Please try to switch between different accounts in your wallet if your wallet supports this functonality.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="templates" style="display: none">
                <template id="template-balance">
                    <tr>
                    <th class="address"></th>
                    <td class="balance"></td>
                    </tr>
                </template>
            </div>
            {{-- ** --}}
        </div>
    </div>
</x-app-layout>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.5.2/web3.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/web3@1.2.11/dist/web3.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/web3modal@1.9.0/dist/index.js"></script>
    <script type="text/javascript" src="https://unpkg.com/evm-chains@0.2.0/dist/umd/index.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/@walletconnect/web3-provider@1.2.1/dist/umd/index.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/fortmatic@2.0.6/dist/fortmatic.js"></script>
    <script type="text/javascript" src="{{asset('js/ethereum-script.js')}}"></script>
</html>