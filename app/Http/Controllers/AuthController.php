<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\login;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth as Auth;
class AuthController extends Controller
{
    public function index(){
        if(!empty(Auth::check())){
            if(Auth::user()->role == 1){
                return redirect('/index');
            }
            else if(Auth::user()->role == 2){
                return redirect('/student/panel');
            }
            else if(Auth::user()->role == 3){
                return redirect('/teacher/panel');
            }
        }
        else{
            return view('login');
        }
    }

    public function login(Request $req){
        // dd($req->all());
        if(Auth::attempt(['email' => $req->email, 'password' => $req->password])){
            if(Auth::user()->role == 1){
                return redirect('/index');
            }
            else if(Auth::user()->role == 2){
                return redirect('/student/panel');
            }
            else if(Auth::user()->role == 3){
                return redirect('/teacher/panel');
            }
        }
        else{
            return redirect()->back()->with('fail','Email and Password Does Not macthed');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/')->with('success','Admin is logout');
    }


    // Admin Student

    public function studentstore(Request $req){

        $req->validate([
                'name' => 'required|max:100',
                'email' => 'required',
                'phonenumber' => 'required|min:10|max:10',
                'password' => 'required|min:8|max:36',
                'image' => 'required',
        ]);

        $image = time().'.'.$req->image->extension();
        $req->image->move(public_path('/student/images'),$image);
        $passwords = \Illuminate\Support\Facades\Hash::make($req->password);
        $students = new User();
        $students->name = $req->name;
        $students->email = $req->email;
        $students->phonenumber = $req->phonenumber;
        $students->password = $passwords;
        $students->image = $image;
        $students->role = $req->role;
        $students->save();
        return back()->withSuccess('Student is Created');
    }
    function studentindex(){
        $users = \Illuminate\Support\Facades\DB::table('users')
                ->where('role', '=', 2)
                ->get();
        return view('view-users',compact('users'));
    }


    function studentindexstudent(){
        $users = \Illuminate\Support\Facades\DB::table('users')
                ->where('role', '=', 2)
                ->get();
        return view('students.view-students',compact('users'));
    }

    function teachercallstudent(){
        $users = \Illuminate\Support\Facades\DB::table('users')
        ->where('role', '=', 2)
        ->get();
        return view('/teachers/view-students',compact('users'));
    }

    function editstudent($id){
        $data = User::where('id',$id)->first();
        return view('edit-teacher',compact('data'));
    }

    function studenteditstudent($id){
        $data = User::where('id',$id)->first();
        return view('edit-student',compact('data'));
    }

    function studentupdatestudent(Request $req,$id){
        // dd($req->all());
        $req->validate([
            'name' => 'nullable|max:100',
            'email' => 'nullable|max:60',
            'phonenumber' => 'nullable|min:10|max:10',
            'password' => 'nullable|min:8|max:500',
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
        $students->update();
        return back()->withSuccess('Student is Update');
    }

    // studentupdatestudent
    function updatestudent(Request $req,$id){
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
        $students->update();
        return back()->withSuccess('Student is Update');
    }

    function destroystudent($id){
        $student = User::where('id',$id)->first();
        $student->delete();
        return back()->withSuccess('Student is Deleted');
    }


    // admin Teacher

    public function teacherstore(Request $req){
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
                $passwords = \Illuminate\Support\Facades\Hash::make($req->password);

                $teacher = new User();
                $teacher->name = $req->name;
                $teacher->email = $req->email;
                $teacher->phonenumber = $req->phonenumber;
                $teacher->role = $req->role;
                $teacher->password = $passwords;
                $teacher->image = $image;
                $teacher->save();
                return back()->withSuccess('Teacher is Created');
            }

            function teacherindex(){
                $users = \Illuminate\Support\Facades\DB::table('users')
                ->where('role', '=', 3)
                ->get();
        return view('view-teachers',compact('users'));
            }

            function admincallteachers(){
                // $users = auth()->user();
                $users = \Illuminate\Support\Facades\DB::table('users')
                ->where('role', '=', 3)
                ->get();
        return view('/teachers/view-teachers',compact('users'));
            }

            function editteacher($id){
                $data = User::where('id',$id)->first();
                return view('teachers.edit-teacher',compact('data'));
            }

            function updateteacher(Request $req,$id){
                // dd($req->all());
                $req->validate([
                    'name' => 'nullable|max:100',
                    'email' => 'nullable|max:60',
                    'phonenumber' => 'nullable|min:10|max:10',
                    'password' => 'nullable|min:8|max:500',
                    'image' => 'nullable',
            ]);

            $teachers = User::where('id',$id)->first();
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
            function destroyteacher($id){
                $student = User::where('id',$id)->first();
                $student->delete();
                return back()->withSuccess('Student is Deleted');
            }



        }
