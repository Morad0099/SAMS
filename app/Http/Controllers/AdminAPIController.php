<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdminAPIController extends Controller
{
    public function add_staff(Request $request){
        $validator = Validator::make(
            $request->all(),[
                'name' => 'required',
                'id' => 'required|unique:staff,employee_id',
                'email' => 'required|unique:staff,email',
                'course' => 'required',
                'phone' => 'required|unique:staff,phone',
                'gender' => 'required'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'msg' => 'Adding staff failed.'. join(' ', $validator->errors()->all())
            ]);
        }

        try {
            DB::table('staff')->insert([
                'name' => $request->name,
                'employee_id' => $request->id,
                'email' => $request->email,
                'course' => $request->course,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'class' => null
            ]);

            return response()->json([
                'ok' => true,
                'msg' => 'Staff added successfully'
            ]);
        } catch (Exception $e) {
            Log::error('Adding staff failed: '. $e->getMessage());
            return response()->json([
                'ok' => false,
                'msg' => 'Adding staff failed. An internal error occured. If this continues, please contact an administrator',
                'error' => [
                    'msg' => "Could not add staff. {$e->getMessage()}",
                    'fix' => 'Check the errors for clues'
                ]
            ]);
        }
    }

    public function edit_staff(Request $request){
        $validator = Validator::make(
            $request->all(),[
                'phone' => 'required'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'msg' => 'Failed to update phone number.' .join(" ", $validator->errors()->all())
            ]);
        }

        try {
            DB::table('staff')->where('employee_id', $request->employee_id)
            ->where('deleted',0)
            ->update(['phone' => $request->phone]);

            return response()->json([
                'ok' => true,
                'msg' => 'Phone number updated successfully'
            ]);
        } 
        catch (Exception $e) {
            Log::error("Failed updating phone number: ". $e->getMessage());
            return response()->json([
                'ok' => false,
                'msg' => 'Updating phone number failed. An internal error occured. If this continues, contact an administrator',
                'error' => [
                    'msg' => "Could not update phone number. {$e->getMessage()}",
                    'fix' => 'Check errors for clues'
                ]
            ]);
        }
    }

    public function delete_staff($id){
        DB::table('staff')->where('employee_id', $id)
        ->update(['deleted' => 1]);

        return response()->json([
            'ok' => true,
            'msg' => 'Staff deleted successfully'
        ]);
    }

    public function add_announcement(Request $request){
        $validator = Validator::make(
            $request->all(),[
                'title' => 'required',
                'content' => 'required'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'msg' => 'Adding notice failed.' . join(" ", $validator->errors()->all())
            ]);
        }

        try {
            DB::table('announcement')->insert([
                'title' => $request->title,
                'content' => $request->content,
                'submitted_date' => now()->toDateString()
            ]);

            return response()->json([
                'ok' => true,
                'msg' => 'Adding notice successful'
            ]);
        } 
        catch (Exception $e) {
            Log::error("Adding notice failed: " . $e->getMessage());
            return response()->json([
                'ok' => false,
                'msg' => 'Adding notice failed. An internal error occured. If this continues, contact an adminstrator',
                'error' => [
                    'msg' => "Could not add staff. {$e->getMessage()}",
                    'fix' => "Check errors for clues"
                ]
                ]);
        }
    }

    public function edit_announcement(Request $request){
        $validator = Validator::make(
            $request->all(),[
                'title' => 'string',
                'content' => 'required|string'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'msg' => 'Failed to update announcement.' . join(" ", $validator->errors()->all())
            ]);
        }

        try {
            DB::table('announcement')->where('id', $request->id)
            ->where('deleted', 0)
            ->update([
                'title' => $request->title,
                'content' => $request->content
            ]);

            return response()->json([
                'ok' => true,
                'msg' => 'Announcement updated successfully'
            ]);
        } catch (Exception $e) {
            Log::error("Failed to update announcemt" . $e->getMessage());
            return response()->json([
                'ok' => false,
                'msg' => 'Updating announcement failed. An internal error occured. If it contines, contact an administrator',
                'error' => [
                    'msg' => "Could not update announcement. {$e->getMessage()}",
                    'fix' => 'Check errors for clues'
                ]
            ]);
        }
    }

    public function delete_announcement($id){
        DB::table('announcement')->where('id', $id)
        ->update(['deleted' => 1]);

        return response()->json([
            'ok' => true,
            'msg' => 'Announcement deleted successfully'
        ]);
    }
}
