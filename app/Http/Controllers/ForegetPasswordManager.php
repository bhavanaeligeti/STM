<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForegetPasswordManager extends Controller
{
    public function index(){
        return view('forget-password-form');
    }
    public function forgetpassword(Request $req){
        $req->validate([
            'email' => 'required|exists:users|email'
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $req->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        Mail::send('email',['token' => $token], function ($message) use ($req){
            $message->to($req->email);
            $message->subject('Reset Password');
        });

        return redirect(route('login'))->with('success','Email is Sent');
    }


    public function resetpassword($token){
        return view('new-password',compact('token'));
    }
    public function createpassword(Request $req){
        $req->validate([
            'email' => 'required',
            'password' => 'required|min:8|max:36'
        ]);

        $updatepassword = DB::table('password_reset_tokens')->where([
            'email' => $req->email,
            'token' => $req->token,
        ])->first();

        if(!$updatepassword){
            return redirect()->to('forget.password.page')->with('error','Invalid');
        }
    User::where('email', $req->email)->update(['password' => Hash::make($req->password)]);

    DB::table('password_reset_tokens')->where(['email' => $req->email])->delete();
    return redirect()->to('/')->with('success','Password is changed');
    }
}
