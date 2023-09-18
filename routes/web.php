<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForegetPasswordManager;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TimeTableController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/forget/password/page',[ForegetPasswordManager::class, 'index'])->name('forget.password.page');
Route::post('/forget/password/page/form',[ForegetPasswordManager::class, 'forgetpassword'])->name('forget.password');
Route::get('/forget/password/page/email/{token}',[ForegetPasswordManager::class, 'resetpassword'])->name('reset.password');
Route::post('/create/password/page/',[ForegetPasswordManager::class, 'createpassword'])->name('create.password');



Route::get('/',[AuthController::class, 'index'])->name('login');
Route::post('/',[AuthController::class, 'login'])->name('login.admin');
Route::get('/admin/logout',[AuthController::class, 'logout'])->name('admin.log.out');

Route::get('/index', function () {
    return view('index');
})->name('index')->middleware('admin');


Route::prefix('/admin/panel')->middleware('admin')->middleware('auth')->group(function () {

    Route::get('/create/students/form', function () {
        return view('create-users');
    })->name('create-users');

    Route::get('/create/teachers/form', function () {
        return view('create-teachers');
    })->name('create-teachers');
    // /student-delete/3/page/view/del/deleted/student
    Route::get('/teacher-delete/{id}',[AuthController::class, 'destroyteacher']);
    Route::get('/student-delete/{id}/page/view/del/deleted/student',[AuthController::class, 'destroystudent']);
    Route::post('/store/students/form',[AuthController::class, 'studentstore'])->name('create-db-student');
    Route::post('/store/teachers/form',[AuthController::class, 'teacherstore'])->name('create-db-teacher');
    Route::get('/view/students/request/applications',[ApplicationController::class, 'show'])->name('view.applications');
    Route::get('/time/table/students/download',[TimeTableController::class, 'call'])->name('download.admin.view');
    Route::get('/notice/for/students/get', [NoticeController::class, 'index'])->name('view-note');
    Route::get('/view/teachers/get', [AuthController::class, 'teacherindex'])->name('view-teachers');
    Route::get('/teacher/{id}/edit/teacher/page/view/edited',[AuthController::class,'editteacher']);
    Route::get('/teacher/{id}/edit',[AuthController::class,'editteacher']);
    Route::put('/teacher/{id}/store',[AuthController::class,'update']);
    Route::get('{id}/edit/student/page/view/edited',[AuthController::class,'studenteditstudent']);
    Route::put('{id}/store',[AuthController::class,'studentupdatestudent']);
    Route::get('/view/students/get', [AuthController::class, 'studentindex'])->name('view-users');
    Route::get('/application/status/{id}', [ApplicationController::class, 'savestatus'])->name('application.status.admin');
    // Route::get('/application/status/store/{id}', [ApplicationController::class, 'accept']);
    Route::get('/notice-delete/{id}',[NoticeController::class, 'admindelete'])->name('delete.notice.admin');
    Route::post('/{id}/store/application/status', [ApplicationController::class, 'accept']);
    Route::put('/{id}/store/application/status/reject', [ApplicationController::class, 'reject']);
    Route::get('/download/time/table/admin/{image}',[TimeTableController::class, 'showadmin'])->name('download.admins.view.download');

});


Route::prefix('/teacher/panel')->middleware('teacher')->group(function () {


    Route::get('/', function () {
        return view('teachers.index');
    })->name('dashboard.teachers');

    Route::get('/create/notice/form/panel', function () {
        return view('teachers.create-notice');
    })->name('notice.teachers');
    Route::post('/upload/time/table/teacher/upload',[TimeTableController::class, 'index'])->name('upload.timetable.teacher');
    Route::post('/notice/create/upload/panel',[NoticeController::class, 'create'])->name('create.notice');
    Route::get('/teacher/{id}/edit/teacher/page/view/edited',[AuthController::class,'editteacher']);
    Route::put('/edit/updated/{id}',[AuthController::class,'updateteacher']);
    Route::get('/notice-delete/{id}',[NoticeController::class, 'delete'])->name('delete.notice.teacher');
    Route::get('/view/own/profile/teachers',[AuthController::class, 'admincallteachers'])->name('teachers');
    Route::get('/view/student/profile/show',[AuthController::class, 'teachercallstudent'])->name('teachers.view');
    Route::post('/upload/time/table/store/form',[TimeTableController::class, 'store'])->name('upload.document.teachers');
    Route::get('/upload/time/table/create/form',[TimeTableController::class, 'index'])->name('time.table');
});

Route::prefix('/student/panel')->middleware('student')->group(function () {


    Route::get('/', function () {
        return view('students.index');
    })->name('students.view');
    Route::get('/view/student/profile/show',[AuthController::class, 'studentindexstudent'])->name('students.view');
    Route::get('/student/apply/for/application/admin',[ApplicationController::class, 'index'])->name('upload-application-student');
    Route::post('/student/applications/store/data',[ApplicationController::class, 'store'])->name('create.applications.student');
    Route::get('/notice/show/panel',[NoticeController::class, 'show'])->name('student.note');
    Route::get('/view/students/request/applications',[ApplicationController::class, 'student'])->name('view.applications.student');
    // /download/time/table
    Route::get('/time/table/student/show',[TimeTableController::class, 'show'])->name('download.students.view');
    Route::get('/download/time/table/{image}',[TimeTableController::class, 'download'])->name('download.students.view.download');
});
