<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoticeController extends Controller
{
    function index(){
        $users = DB::table('notices')
        ->latest()
        ->get();
        return view('note',compact('users'));
    }
    function create(Request $req){
        $req->validate([
        'paragraph' => 'required',
        'lastnote' => 'required',
        ]);

        $notice = new Notice();
        $notice->paragraph = $req->paragraph;
        $notice->lastnote = $req->lastnote;
        $notice->save();
        return back()->withSuccess('Notice Created');
    }
    function delete($id){
        // dd($id);
        $notice = Notice::where('id',$id)->first();
        $notice->delete();
        return back()->withSuccess('Notice is Deleted');
    }
    function show(){
        $users = DB::table('notices')
        ->latest()
        ->get();
        return view('/students/note',compact('users'));
    }

    function admindelete($id){
        // dd($id);
        $notice = Notice::where('id',$id)->first();
        $notice->delete();
        return back()->withSuccess('Notice is Deleted');
    }
}
