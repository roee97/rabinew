<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Session;
    
class Student extends Model
{
    //

    public static function findByIdnumOrFail(
        $idnum,
        $columns = array('*')
    ) {
        if ( ! is_null($student = static::whereIdnum($idnum)->first($columns))) {
            return $student;
        }

        throw new ModelNotFoundException;
    }
    
    public static function loggedIn(){
        $id = Session::get('student_id');

        $student = Student::findOrFail($id);
        
        return $student;
    }
    
    public static function isLoggedIn(){
        return Session::has('student_id');
    }
    
    public function getClassAttribute($value)
    {
        $g = floor($value / 10);
        $n = $value % 10;
        $grade = ['י\'', 'י"א', 'י"ב'];
        return $grade[$g-1] . ' ' . $n;
    }
    
    public function getA1Attribute($value)
    {
        return Activity::find($value);
    }
    
    public function getA2Attribute($value)
    {
        return Activity::find($value);
    }

}
