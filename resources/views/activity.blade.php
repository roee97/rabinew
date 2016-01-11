@extends('page')

@section('content')

<style>
    
    .header span {
        color:white;
        font-size: 20px;
    }
    
    .panel {
        color: black;
    }
    
    .panel h3 {
        font-size: 20px;
        font-weight: 800;
    }
    

</style>

<div class="header clearfix">
<h1><a href="javascript:history.back()"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></a> דף פעילות</h1>
</div>


<div class="panel panel-default">
      <div class="panel-heading text-center">
        <a href="/activity/{{$activity->id}}">
            <h3 class="panel-title">{{$activity->title}}</h3>
        </a>
      </div>
  <div class="panel-body">
    {{$activity->tutor}}

      <hr>
      
      <h3>רשומים</h3>
      
      <h4>סבב ראשון ({{$activity->a1StudentsCount}}/{{$activity->max_students}})</h4>
      @if($activity->A1students->count() > 0)
      <table class="table table-striped">
        <thead>
          <tr>
            <th>שם</th>
            <th>כיתה</th>
          </tr>
        </thead>
        <tbody>
            @foreach($activity->A1students as $student)
            <tr>
                <td>{{$student->name}}</td>
                <td>{{$student->class}}</td>
            </tr>
            @endforeach
        </tbody>
      </table>
      
      @else
        אין רשומים
      @endif
      
      <hr>
      
      <h4>סבב שני ({{$activity->a2StudentsCount}}/{{$activity->max_students}})</h4>
      
     @if($activity->A2students->count() > 0)
      
      <table class="table table-striped">
        <thead>
          <tr>
            <th>שם</th>
            <th>כיתה</th>
          </tr>
        </thead>
        <tbody>
            @foreach($activity->A2students as $student)
            <tr>
                <td>{{$student->name}}</td>
                <td>{{$student->class}}</td>
            </tr>
            @endforeach
        </tbody>
      </table>
      @else
        אין רשומים
      @endif
      
  </div>
</div>


@endsection
