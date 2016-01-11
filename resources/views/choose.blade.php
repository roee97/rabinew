@extends('page')

@section('content')

<style>
    
    .panel {
        color: black;
    }
    
    .panel h3 {
        font-size: 20px;
        font-weight: 800;
    }
    
    .panel h3:hover {
        color: #2980B9;
    }
    
    .donate-now {
         list-style-type:none;
         margin:25px 0 0 0;
         padding:0;
    }

    .donate-now li {
         float:left;
         margin:0 1% 0 0;
        width:49%;
        height:40px;
        position:relative;
        text-align: center;
    }

    .donate-now label, .donate-now input {
        display:block;
        position:absolute;
        top:0;
        left:0;
        right:0;
        bottom:0;
    }

    .donate-now input[type="radio"] {
        opacity:0.01;
        z-index:100;
    }

    .donate-now input[type="radio"]:disabled + label {
        background-color: #ccc;
        color: #ECF0F1;
    }
    
    
    .donate-now input[type="radio"]:checked + label,
    .Checked + label {
        background-color: #2980B9;
        color: #ECF0F1;
        transition: background 0.5s;
    }

    .donate-now label {
         padding:5px;
         border:1px solid #CCC; 
         cursor:pointer;
        z-index:90;
    }

    .donate-now label:hover {
         background:#DDD;
    }
    
    #submit {
        margin: 0 auto;
        display:block;
        
        width: 150px;
        color:white;
        background: none;
        border: 2px solid white;
        font-weight: 900;
    }
    
     #submit:hover {
        color: #2980B9;
        background: white;
        border: 2px solid white;
        font-weight: 900;
    }
    

</style>

<h4>שלום, {{$student->name}}</h4>

<div class="header clearfix">
<h1>
ברוך הבא למערכת ההרשמה לפעילויות
</h1>
</div>

<h3>
@if($student->a1 == null || $student->a2 == null)
סמן 2 פעילויות ולחץ הרשם.
@else
הנך רשום לפעלויות המסומנות. אם ברצונך לבצע שינוי, סמן פעילויות חדשות והרשם מחדש.
@endif
</h3>

@if(Session::has('error'))
{{Session::get('error')}}
@endif

<form method="post">

    @foreach($activities as $activity)

    <div class="panel panel-default">
          <div class="panel-heading text-center">
            <a href="/activity/{{$activity->id}}">
                <h3 class="panel-title">{{$activity->title}}</h3>
            </a>
          </div>
      <div class="panel-body text-center">
        {{$activity->tutor}}

          <hr>

        <ul class="donate-now">
            <li>
                <input type="radio" id="a2{{$activity->id}}" name="a2" value="{{$activity->id}}" {{ ($student->a2 == $activity) ? 'checked' : '' }} {{ (!$activity->a2Available && $student->a2 != $activity) ? 'disabled' : '' }}/>
                <label for="a2{{$activity->id}}">פעילות שניה ({{$activity->a2StudentsCount}}/{{$activity->max_students}})</label>
            </li>
            <li>
                <input type="radio" id="a1{{$activity->id}}" name="a1" value="{{$activity->id}}" {{ ($student->a1 == $activity) ? 'checked' : '' }} {{ (!$activity->a1Available && $student->a1 != $activity) ? 'disabled' : '' }}/>
                <label for="a1{{$activity->id}}">פעילות ראשונה ({{$activity->a1StudentsCount}}/{{$activity->max_students}})</label>
            </li>
        </ul>
    

      </div>
    </div>


    @endforeach
    
    <button type="submit" class="btn btn-default" id="submit">הרשם</button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

    
</form>



@endsection
