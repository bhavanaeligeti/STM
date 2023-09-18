<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    function index(){
        $view = DB::table('users')->where('role', 2)->get();
        return view('view-users',compact('view'));
    }

    function call(){
        $view = DB::table('users')->where('role', 2)->get();
        return view('view-users',compact('view'));
    }
    public function store(Request $req){

        $req->validate([
                'name' => 'required|max:100',
                'email' => 'required|max:60',
                'phonenumber' => 'required|min:10|max:10',
                'password' => 'required|min:8|max:36',
                'image' => 'required',
        ]);

        $image = time().'.'.$req->image->extension();
        $req->image->move(public_path('/student/images'),$image);

        $students = new Student;
        $students->name = $req->name;
        $students->email = $req->email;
        $students->phonenumber = $req->phonenumber;
        $students->password = $req->password;
        $students->image = $image;
        $students->save();
        return back()->withSuccess('Student is Created');
    }

    function edit($id){
        $data = Student::where('id',$id)->first();
        return view('edit-student',compact('data'));

    }




    function update(Request $req,$id){
        // dd($req->all());
        $req->validate([
            'name' => 'nullable|max:100',
            'email' => 'nullable|max:60',
            'phonenumber' => 'nullable|min:10|max:10',
            'password' => 'nullable|min:8|max:36',
            'image' => 'nullable',
    ]);

    $students = Student::where('id',$id)->first();
        if (isset($req->image)) {
            # code...
            $image = time().'.'.$req->image->extension();
            $req->image->move(public_path('/student/images'),$image);
            $students->image = $image;
        }

        $students->name = $req->name;
        $students->email = $req->email;
        $students->phonenumber = $req->phonenumber;
        $students->password = $req->password;
        $students->update();
        return back()->withSuccess('Student is Update');
    }

    function destroy($id){
        $student = Student::where('id',$id)->first();
        $student->delete();
        return back()->withSuccess('Student is Deleted');
    }



    function reindex(){
        $teachers = DB::table('users')->where('role', 1)->get();
        return view('view-teachers',compact('teachers'));
    }

    function recall(){
        $teachers = DB::table('users')->where('role', 1)->get();
        return view('/teachers/view-teachers',compact('teachers'));
    }

    function all(){
        $teachers = DB::table('users')->get();
        return view('/teachers/view-teachers',compact('teachers'));
    }
    function view(){
        $teachers = DB::table('users')->get();
        return view('view-teachers',compact('teachers'));
    }
    public function restore(Request $req){
// dd($req->all());
        $req->validate([
                'name' => 'required|max:100',
                'email' => 'required|max:60',
                'phonenumber' => 'required|min:10|max:10',
                'password' => 'required|min:8|max:36',
                'image' => 'required',
        ]);

        $image = time().'.'.$req->image->extension();
        $req->image->move(public_path('/teacher/images'),$image);

        $teacher = new User();
        $teacher->name = $req->name;
        $teacher->email = $req->email;
        $teacher->phonenumber = $req->phonenumber;
        $teacher->password = $req->password;
        $teacher->image = $image;
        $teacher->save();
        return back()->withSuccess('Teacher is Created');
    }

    function reedit($id){
        $data = User::where('id',$id)->first();
        return view('edit-teacher',compact('data'));

    }


    function reupdate(Request $req,$id){
        // dd($req->all());
        $req->validate([
            'name' => 'nullable|max:100',
            'email' => 'nullable|max:60',
            'phonenumber' => 'nullable|min:10|max:10',
            'password' => 'nullable|min:8|max:36',
            'image' => 'nullable',
    ]);

    $students = User::where('id',$id)->first();
        if (isset($req->image)) {
            # code...
            $image = time().'.'.$req->image->extension();
            $req->image->move(public_path('/student/images'),$image);
            $students->image = $image;
        }

        $students->name = $req->name;
        $students->email = $req->email;
        $students->phonenumber = $req->phonenumber;
        $students->password = $req->password;
        $students->image = $image;
        $students->role = $req->role;
        $students->update();
        return back()->withSuccess('Student is Update');
    }



    function delete($id){
        $student = User::where('id',$id)->first();
        $student->delete();
        return back()->withSuccess('Student is Deleted');
    }
}
