<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function clockin(){
        $clockins = DB::table('staff_attendances')->select('*', 'users.staff_id')
        ->join('users', 'staff_attendances.staff_id', 'users.staff_id')
        ->where('staff_attendances.attendance_date', now()->toDateString())
        ->where('users.staff_id', Auth::user()->staff_id)
        ->first();
        return view('user_dash.clockin', ['clockins' => $clockins]);
    }

    public function staff_attendance(){
        $records = DB::table('staff_attendances')->select('*', 'users.staff_id')
        ->join('users', 'staff_attendances.staff_id', 'users.staff_id')
        ->where('users.staff_id', Auth::user()->staff_id)
        ->get();
        return view('user_dash.attendance', ['records' => $records]);
    }

    public function staff_leave(){
        $leaves = DB::table('leave_management')
        // ->select('*', 'users.staff_id')
        // ->join('users', 'leave_management.staff_id', 'users.staff_id')
        // ->where('users.staff_id', Auth::user()->staff_id)
        ->where('leave_management.deleted', 0)
        ->get();

        $totalLeaveCounts = DB::table('leave_management')
        ->where('staff_id', Auth::user()->staff_id)
        ->where('deleted', 0)
        ->count();
        return view('user_dash.leave', ['leaves' => $leaves, 'totalLeaveCounts' => $totalLeaveCounts]);
    }

    public function staff_announcement(){
        $notices = DB::table('announcement')->where('deleted', 0)->get();
        return view('user_dash.announcemt', ['notices' => $notices]);
    }

    public function getAttendanceData(){
        $attendanceData = DB::table('staff_attendances')
        ->select(DB::raw('MONTH(attendance_date) as month, COUNT(*) as count, status'))
        ->where('staff_id', Auth::user()->staff_id)
        ->groupBy('month', 'status')
        ->get();

        return response()->json($attendanceData);
    }
}
