<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaunchPadController extends Controller
{
    public function index(){
        return view('pages.launchpad-page');
    }
}
