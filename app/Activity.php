<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //
    
    public function getA1StudentsAttribute()
    {
        return Student::where('a1', '=', $this->id)->get();
    }
    
    public function getA2StudentsAttribute()
    {
        return Student::where('a2', '=', $this->id)->get();
    }
    
    public function getStudentsAttribute()
    {
        return Student::where('a1', '=', $this->id)->orWhere('a2', '=', $this->id)->get();
    }
    
    public function getA1StudentsCountAttribute(){
        return Student::where('a1', '=', $this->id)->count();
    }
    
    public function getA2StudentsCountAttribute(){
        return Student::where('a2', '=', $this->id)->count();
    }
    
    public function getStudentsCountAttribute(){
        return Student::where('a2', '=', $this->id)->orWhere('a2', '=', $this->id)->count();
    }
    
    public function getA1AvailableAttribute(){
        return $this->a1StudentsCount < $this->max_students;
    }
    
    public function getA2AvailableAttribute(){
        return $this->a2StudentsCount < $this->max_students;
    }
}
