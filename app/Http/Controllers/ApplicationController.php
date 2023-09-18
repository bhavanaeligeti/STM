<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{

    function index(){
        return view('students.application');
    }

    function student(){
        $datas = Application::get();
        return view('students.request-applications',compact('datas'));
    }
    function show(){
        $datas = Application::get();
        return view('request-applications',compact('datas'));
    }
    function store(Request $req){
        // dd($req->all());
        $req->validate([
            'name' => 'required',
            'email' => 'required',
            'phonenumber' => 'required',
            'subject' => 'required',
            'description' => 'required',
        ]);

        $application = new Application;
        $application->name = $req->name;
        $application->email = $req->email;
        $application->phonenumber = $req->phonenumber;
        $application->subject = $req->subject;
        $application->description = $req->description;
        $application->save();
        return back()->withSuccess('Application Uploaded');
    }
    public function savestatus($id){
        $data = Application::where('id',$id)->first();
        return view('savestatusapplication',compact('data'));
    }

    function accept(Request $req,$id){
        // dd($req->id);
        $req->validate([
            'status' => 'required',
        ]);

        $application = Application::where('id',$id)->first();
        $application->status = $req->status;
        $application->save();
        return back()->withSuccess('Status Saved');
    }
    function reject(Request $req,$id){
        // dd($req->id);
        $req->validate([
            'status' => 'required',
        ]);

        $application = Application::where('id',$id)->first();
        $application->status = $req->status;
        $application->save();
        return back()->withSuccess('Status Saved');
    }
}
