<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function showHomePage()
    {

        $is_admin = Session::get('is_admin');
        if ($is_admin == 1) {
            $get_all_user = User::where('is_admin', 0)->where('is_deleted', 0)->get();
            return view('users.all_user_list', compact('get_all_user'));
        } else {
            return view('dashboard_userhome');
        }
     

     
    }

    public function alluserlist()
    {
        $get_all_user = User::where('is_admin', 0)->where('is_deleted', 0)->get();
        return view('users.all_user_list', compact('get_all_user'));
    }

    public function delete_data(Request $request)
    {

        // dd($request->all());
        $is_admin = Session::get('is_admin');
        if ($is_admin == 1) {
            $tbl_type = $request->tablename ?? null;
            $id = $request->id ?? null;
            if ($tbl_type == "users") {
                $delete_user = User::where('id', $id)->first();
                $delete_user->is_deleted = 1;
                $delete_user->save();
                return response()->json(['data' => '', 'message' => 'Delete Success', 'status' => true]);
            } else {
                return response()->json(['data' => '', 'message' => 'Not Delete, Something wrong', 'status' => false]);
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function edit_user_frm(Request $request, $id)
    {
        $is_admin = Session::get('is_admin');
        if ($is_admin == 1) {
            $get_details = User::where('id', $id)->first();
            return view('users.edituserfrm', compact('get_details'));
        } else {
            return redirect()->route('login');
        }
    }

    public function update_user(Request $request)
    {
        $is_admin = Session::get('is_admin');
        if ($is_admin == 1) {

            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string|max:255',
                'email' => 'required|email',
                'mobile' => 'required',
            ], [
                'full_name.required' => 'Please enter your name',
                'mobile.required' => 'Please enter your mobile number',
                'email.required' => 'Please enter your email address',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $id = $request->id;
            $full_name = $request->full_name;

            $nameParts = explode(' ', $full_name);
            $firstName = $nameParts[0];
            $lastName = $nameParts[1] ?? '';

            $email = $request->email;
            $mobile = $request->mobile;
            $get_details = User::where('id', $id)->first();

            $get_details->first_name = $firstName;
            $get_details->last_name = $lastName;
            $get_details->full_name = $full_name;
            $get_details->email = $email;
            $get_details->mobile = $mobile;
            $get_details->save();
            
            return redirect()->route('alluserlist')->with('success','User Update Successfully');

        } else {
            return redirect()->route('login');
        }
    }
}
