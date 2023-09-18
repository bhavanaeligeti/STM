<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    function index(){
        return view('view-teachers',['teachers' => Teacher::all()]);
    }

    function call(){
        return view('/teachers/view-teachers',['teachers' => Teacher::all()]);
    }
    public function store(Request $req){
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

        $teacher = new Teacher();
        $teacher->name = $req->name;
        $teacher->email = $req->email;
        $teacher->phonenumber = $req->phonenumber;
        $teacher->password = $req->password;
        $teacher->image = $image;
        $teacher->save();
        return back()->withSuccess('Teacher is Created');
    }

    function edit($id){
        $data = Teacher::where('id',$id)->first();
        return view('edit-teacher',compact('data'));
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

    $teachers = Teacher::where('id',$id)->first();
        if (isset($req->image)) {
            # code...
            $image = time().'.'.$req->image->extension();
            $req->image->move(public_path('/teacher/images'),$image);
            $teachers->image = $image;
        }

        $teachers->name = $req->name;
        $teachers->email = $req->email;
        $teachers->phonenumber = $req->phonenumber;
        $teachers->password = $req->password;
        $teachers->save();
        return back()->withSuccess('Teacher is Update');
    }

    function destroy($id){
        $student = teacher::where('id',$id)->first();
        $student->delete();
        return back()->withSuccess('Student is Deleted');
    }
}
