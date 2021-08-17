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
            <div class="bg-white mb-4 overflow-hidden shadow-xl sm:rounded-sm">
                <div class="sm:bg-white border-b border-gray-200">
                    <div class="p-6 sm:px-10 ">
                        <h2 class="text-lg">
                            Merchant Token Affiliate Program
                        </h2>
                    </div>
                    <div class="border-t bg-gray-100 border-gray-200">
                        <div class="p-6 flex-wrap sm:px-10 flex">
                            <div class="mb-4 border-0 p-0 w-full sm:mb-0 w-auto border-r pr-4 border-gray-200">
                                <p class="text-sm">
                                    Account ID
                                </p>
                                <p class="text-xs rounded-lg px-2 font-medium py-0.8 bg-gray-200 text-gray-700">
                                    {{$refId}}
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
                            <div class="w-full border-0 p-0 sm:mb-0 w-auto pl-4">
                                <p class="text-sm">
                                    My MTO Balance <span class="text-xxs rounded-lg px-1 font-medium py-1 bg-blue-100 text-indigo-500">$0.00</span>
                                </p>
                                <p class="text-xs">
                                    @if($res)
                                        {{$res->final_balance}}
                                    @else
                                        NA
                                    @endif
                                    
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ** --}}
            <div class="bg-white mb-4 overflow-hidden shadow-xl sm:rounded-sm">
                <div class="sm:bg-white border-b border-gray-200">
                    <div class="p-6 sm:px-10 ">
                        <h3 class="text-sm font-medium mb-3">How do the affiliate program work?</h3>
                        <p class="text-sm">Share the MTO Launchpad ICO with friends. All you need do is to send your unique referal link via private message, post it in your social media, video or article in your community. We will reward you for every investor made from your recommendation.</p>
                    </div>
                    <div class="border-t bg-gray-100 border-gray-200">
                        <div class="p-6 sm:px-10">
                            <p class="text-sm mb-3">
                                Your revshare: <span class="text-xs rounded-lg px-1 font-bold py-1 bg-gray-200 text-gray-700">25% of MTO invested</span>
                            </p>
                            <p class="text-sm mb-3">
                                For example; if you have referred two people that invested in sum 5 ETH, and bought 450 000 MTO, you will get 112 500 MTO in reward.
                            </p>
                            <p class="text-sm">
                                After the ICO, you can choose to keep your MTO or convert them to any listed pair via the exchanges where MTO is listed.
                            </p>
                        </div>
                    </div>
                    <div class="p-6 sm:px-10 flex justify-between">
                        <p class="text-xs text-gray-300">Convert MTO to ETH</p>
                    </div>
                </div>
            </div>
            {{-- ** --}}
            <div class="bg-white mb-4 overflow-hidden shadow-xl sm:rounded-sm">
                <div class="sm:bg-white border-b border-gray-200">
                    <div class="p-6 flex-wrap sm:px-10 flex justify-between">
                        <h2 class="text-lg font-medium">
                            My affiliate link
                        </h2>
                        <div>
                            <i class="fa fa-info-circle pt-1 pr-1 text-indigo-600" aria-hidden="true"></i><a class="text-indigo-600 font-xs" href="">Learn more about the affiliate link</a>
                        </div>
                    </div>
                    <div class="border-t bg-gray-100 border-gray-200">
                        <div class="py-3 sm:px-10">
                            <a class="text-xs rounded-sm px-1 py-0.8 font-medium bg-red-100 text-red-700" href="#">{{url('/referal').'?ref='.$refId}}</a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ** --}}
            <div class="bg-white mb-4 overflow-hidden shadow-xl sm:rounded-sm">
                <div class="sm:bg-white border-b border-gray-200">
                    <div class="py-4  border-b border-gray-200 sm:px-10  ">
                        <h2 class="text-lg font-medium">
                            My referal campaigns
                        </h2>
                    </div>
                    <div class=" mb-2 border-b border-gray-200">
                        <div class="px-2 py-2 sm:px-10">
                            <table class="table-responsive w-full">
                                <thead>
                                    <tr>
                                        <th class="text-left">
                                            <span class="text-xs font-medium">Campaign ID</span>
                                        </th>
                                        <th class="text-right">
                                            <span class="text-xs font-medium">Unique Clicks</span>
                                        </th>
                                        <th class="text-right">
                                            <span class="text-xs font-medium">CR</span>
                                        </th>
                                        <th class="text-right">
                                            <span class="text-xs font-medium">Signups</span>
                                        </th>
                                        <th class="text-right">
                                            <span class="text-xs font-medium">Earnings in MTO</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-left">
                                            <span class="text-xs font-medium">1</span>
                                        </td>
                                        <td class="text-right">
                                            <span class="text-xs font-medium">{{$uniqueClicks}}</span>
                                        </td>
                                        <td class="text-right"><span class="text-xs font-medium">-</span></td>
                                        <td class="text-right"><span class="text-xs font-medium">{{$signUps}}</span></td>
                                        <td class="text-right"><span class="text-xs font-medium">-</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="flex justify-between  border-t border-gray-200">
                        <div class="v2-table-page-results px-2  py-4 sm:px-10">
                            <span class="v2-text-base">0 campaigns</span>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ** --}}

        </div>
    </div>
</x-app-layout>
</html>