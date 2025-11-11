<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewRequestController extends Controller
{
     public function index()
    {
        return view('new-request');
    }
}
