<?php

namespace App\Http\Controllers\Error;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ErrorPage extends Controller
{
    public function index()
    {
        return view('exit.error');
    }
}
