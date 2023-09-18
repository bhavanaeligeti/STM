<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    function index(){
        return view('view-users',['view' => Student::all()]);
    }

    function call(){
        return view('/teachers/view-students',['view' => Student::all()]);
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
}
