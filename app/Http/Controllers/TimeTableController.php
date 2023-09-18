<?php

namespace App\Http\Controllers;

use App\Models\TimeTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimeTableController extends Controller
{
    function index(){
        return view('teachers.upload-timetable');
    }
    function store(Request $req){
           $req->validate([
            'image' => 'nullable',
        ]);

        if ($req->hasFile('imagetimetable')){
        $imagetimetable = time().'.'.$req->imagetimetable->getClientOriginalExtension();
        $req->imagetimetable->move(public_path('/teacher/images'),$imagetimetable);
    }
        $document = new TimeTable();
        $document->image = $imagetimetable;

        $document->save();
        return back()->withSuccess('Time Table is Uploaded');
    }
    function show(){
        $teachers = DB::table('time_tables')
        ->latest()
        ->get();
        return view('students.download',compact('teachers'));
    }
    function call(){
        $teachers = DB::table('time_tables')
        ->latest()
        ->get();
        return view('download',compact('teachers'));
    }

    function download(request $req,$image){
        return response()->download(public_path('/teacher/images/'.$image));
    }
    function showadmin(request $req,$image){
        return response()->download(public_path('/teacher/images/'.$image));
    }
}
