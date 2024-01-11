<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class geolocation extends Controller
{
    public function stu_clockin_attendance(Request $request)
    {
        // Validate the request parameters
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'msg' => 'Clocking in for attendance failed.' . join(' ', $validator->errors()->all())
            ]);
        }

        try {
            // Validate student number
            $check = DB::table('tbluser')->where('userid', $request->student_no)->first();
        
            if (!$check) {
                return response()->json([
                    'ok' => false,
                    'msg' => 'Invalid student number'
                ]);
            }
        
            // Sample school location (replace with actual coordinates)
            $schoolLatitude = 37.7749;
            $schoolLongitude = -122.4194;
        
            // Maximum allowed distance (adjust as needed)
            $maxAllowedDistance = 100;
        
            // Check if the student is within the allowed distance from the school
            $distance = $this->calculateHaversineDistance($request->latitude, $request->longitude, $schoolLatitude, $schoolLongitude);
        
            if ($distance > $maxAllowedDistance) {
                return response()->json([
                    'ok' => false,
                    'msg' => 'You are not on campus. Clocking in is only allowed on campus.'
                ]);
            }
        
            // Check if the current time is within the allowed clock-in hours
            $currentTime = now()->format('H:i:s');
            $allowedStartTime = '06:00:00';
            $allowedEndTime = '22:00:00';
        
            if ($currentTime < $allowedStartTime || $currentTime > $allowedEndTime) {
                // If it's after 10 pm, insert an "absent" record
                if ($currentTime > '22:00:00') {
                    // DB::table('tblattendance')->insert([
                    //     'student_no' => $request->student_no,
                    //     'date' => now()->toDateString(), // Use the current date,
                    //     'status' => 'absent',
                    // ]);
        
                    return response()->json([
                        'ok' => true,
                        'msg' => 'Successfully inserted absent record.'
                    ]);
                }
        
                return response()->json([
                    'ok' => false,
                    'msg' => 'Clocking in is only allowed between 6 am and 10 pm.'
                ]);
            }
        
            // Check if the current day is a Monday to Friday
            $currentDayOfWeek = now()->dayOfWeek;
        
            if ($currentDayOfWeek < 1 || $currentDayOfWeek > 5) {
                return response()->json([
                    'ok' => false,
                    'msg' => 'Clocking in is only allowed on Mondays to Fridays.'
                ]);
            }
        
            // // Clock-in for attendance
            // DB::table('tblattendance')->insert([
            //     'student_no' => $request->student_no,
            //     'date' => $request->date,
            //     'status' => $request->status,
            // ]);
        
            return response()->json([
                'ok' => true,
                'msg' => 'Successfully clocked in for attendance'
            ]);
        
        } catch (\Exception $e) {
            Log::error("Clocking in for attendance failed: " . $e->getMessage());
            return response()->json([
                'ok' => false,
                'msg' => "Clocking in for attendance failed. An internal error occurred. If this continues, please contact an administrator",
                'error' => [
                    "msg" => "Could not clock in for attendance. {$e->getMessage()}",
                    "fix" => "Check the error message for clues",
                ]
            ]);
        }
    }


    /**
     * Calculate the Haversine distance between two sets of coordinates.
     */
    private function calculateHaversineDistance($lat1, $lon1, $lat2, $lon2)
    {
        // Radius of the Earth in meters
        $earthRadius = 6371000;

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        // Distance in meters
        $distance = $earthRadius * $c;

        return $distance;
    }
}
