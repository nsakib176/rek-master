<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Mail;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showloginform()
    {

        if(Session::exists('user_id')){

            return redirect()->to('dashboard')->send();

        }else{
            return view('login');
        }

     
    }

    public function forgot()
    {
        return view('forgot');
      //    $data = array('name'=>"Virat Gandhi");
      // Mail::send('mail', $data, function($message) {
      //    $message->to('navdeep@getnada.com', 'Tutorials Point')->subject
      //       ('Laravel HTML Testing Mail');
      //    $message->from('inforevacare@gmail.com','Virat Gandhi');
      // });
      // return redirect()->back()->with('success', 'Password reset Email Sent Succesfully on your email id');
    }


    public function forgotpass(Request $request)
    {
        // dd('test');
        $request->validate([
            'email' => 'required|exists:users',
        ]);
        try {
                $token = Str::random(64);
                DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
                
                Mail::send('mail', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });
                return redirect()->route('login')->with('success', 'We have e-mailed your password reset link!');
      //            $data = array('name'=>"Virat Gandhi");
      // Mail::send('mail', $data, function($message) {
      //    $message->to('navdeep@getnada.com', 'Tutorials Point')->subject
      //       ('Laravel HTML Testing Mail');
      //    $message->from('inforevacare@gmail.com','Virat Gandhi');
      // });
      // return redirect()->back()->with('success', 'Password reset Email Sent Succesfully on your email id');

            
        } catch (Exception $e) {
            dd($e);
        }
    }

     public function showResetPasswordForm($token) { 
         return view('forgotpasswordlink', ['token' => $token]);
      }

       public function submitResetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);
  
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])
                              ->first();
  
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
  
          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_resets')->where(['email'=> $request->email])->delete();
  
          return redirect('/login')->with('message', 'Your password has been changed!');
      }

    public function savelogindata(Request $request)
    {

        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', '=', $email)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'Login Fail, please check email id');
        }
        if (!Hash::check($password, $user->password)) {
            return redirect()->back()->with('error', 'Login Fail, please check password');
        }
        if ($user->is_admin == 1) {
            Session()->put('admin_name', $user->name);
            Session()->put('admin_id', $user->id);
            Session()->put('is_admin', 1);
            return redirect()->route('dashboard');
        } else {
            Session()->put('user_name', $user->name);
            Session()->put('user_id', $user->id);
            Session()->put('is_admin', 0);
            return redirect()->route('dashboard');
        }
    }
    public function logout(Request $request)
    {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: text/html');
        $is_admin = Session::get('is_admin');
        if ($is_admin == 1) {
            $request->session()->forget('admin_name');
            $request->session()->forget('admin_id');
        } else {
            $request->session()->forget('user_name');
            $request->session()->forget('user_id');
        }
        $request->session()->forget('is_admin');
        $request->session()->invalidate();
        return redirect()->route('login');
    }

    public function showregisterform()  {
        return view('register');
    }


    public function saveuserdata(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'mobile' => 'required',
            'data' => 'required',
            'meet_type' => 'required',
        ], [

            'full_name.required' => 'Please enter your name',
            'mobile.required' => 'Please enter your mobile number',
            'data.required' => 'Please enter Event date',
            'meet_type.required' => 'Please enter meet Type ',
            'email.required' => 'Please enter your email address',
            'email.email' => 'Please enter a valid email address',
            'email.unique' => 'This email address is already registered',
            'password.required' => 'Please enter a password',
            'password.min' => 'The password must be at least 8 characters',
            'password.confirmed' => 'The password confirmation does not match',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $fullName = $data['full_name'];
        $nameParts = explode(' ', $fullName);
        $firstName = $nameParts[0];
        $lastName = $nameParts[1] ?? null;
        $user_create =  User::create([
            'full_name' => $data['full_name'],
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $data['email'],
            'mobile' => $data['mobile'] ?? null,
            'password' => Hash::make($data['password']),
            'category_id' => $data['category_id'] ?? 'birthdays',
            'data' => $data['data'] ?? '2023-04-03',
            'meet_type' => $data['meet_type'] ?? 'google',
        ]);
        if ($user_create) {
            Session()->put('user_name', $user_create->full_name);
            Session()->put('user_id', $user_create->id);
            Session()->put('is_admin', 0);
        }
        return redirect()->route('dashboard');
    }
}
