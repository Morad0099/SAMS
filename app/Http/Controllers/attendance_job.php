<?php

namespace App\Http\Controllers;

use App\Models\staff;
use Illuminate\Http\Request;

class attendance_job extends Controller
{
    public function jobOne()
    {
        $staff = staff::all();
        foreach ($staff as $key => $value) 
        {
            return date('l');
        }  
    }
}
