<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Input;
use App\Student;
use App\Activity;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('main');
    });

    Route::post('login', function(Request $request){
        $idnum = $request->input('idnum');
        $student = Student::findByIdnumOrFail($idnum);
        
        if($student != null){  
            Session::put('student_id', $student->id);
            return redirect('choose');
        }

        return redirect('/');

    });

    Route::get('/choose', function (Request $request) {
        $student = Student::loggedIn();
        if(empty($student)){
            return redirect('/');
        }
        
        $activities = Activity::where('sex', '=', $student->sex)
            ->orWhere('sex', '=', 2)->get();
        return View::make('choose')->with(compact('student', 'activities'));
    });
    
    Route::post('/choose', function (Request $request) {
        
        $a1 = Input::get('a1');
        $a2 = Input::get('a2');
        
        if($a1 == null || $a2 == null){
            Session::flash('error', 'לא סימנת שתי פעילויות');
        }else{
            
            $student = Student::loggedIn();
            
            $oldA1 = $student->a1;
            $oldA2 = $student->a2;
            
            $student->a1 = $a1;
            $student->a2 = $a2;
            
            if(($student->a1->a1Available || $oldA1 = $a1) && ($student->a2->a2Available || $oldA2 = $a2)){
                
                if($student->save()){
                    Session::flash('error', 'נרשמת בהצלחה!');
                    return redirect('/choose');
                }
            }
            
            Session::flash('error', 'אירעה שגיאה. אנא נסה שוב.');
                
        }
        
        return redirect('/choose');
        
    });

    Route::get('/activity/{id}', function($id){
        $activity = App\Activity::findOrFail($id);
        return View::make('activity')->with(compact('activity'));
    });
});


















