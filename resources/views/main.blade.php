@extends('page')

@section('content')
      
<style>
    h1 {
        color: #bbb;
    }
    .jumbotron{
        background: rgba(80,80,80,0.9);
        color: white;
    }
    footer{
        background: rgba(80,80,80,0.9);
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js"></script>
<script>
  $.backstretch("images/landing.jpg");
</script>

<div class="text-center">

<div class="header clearfix">
<h1 class="">תיכון רבין מציג:</h1>
</div>

<div class="jumbotron">
<h1>יום איכות חיים וסביבה 2016</h1>
<p class="lead">הרשמה לפעילויות</p>
<form action="/login" method="post">
    <div class="form-group">
        <label for="idnum">מספר ת.ז.</label>
        <input type="number" class="form-control" id="idnum" name="idnum" placeholder="ת.ז.">
      </div>
        <button type="submit" class="btn btn-default">הכנס</button>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
</div>

</div>    

@endsection