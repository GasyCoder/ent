@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.lessons') }} @stop

@section('content')

  <br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('student_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.lessons') }}</li>
  </ol>


<div class="clear"></div><hr>


<br>

{{ Form::open(['route'=>'student_search_lessons', 'method'=>'GET', 'class'=>'col-md-8 col-md-offset-2', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}


              <div class="col-md-10">
                <div class="form-group">
                  <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-search"></i></span>
                  @if(Input::has('q'))
                    {{ Form::text('q', Input::get('q'), ['class'=>'form-control input-lg']) }}
                  @else
                    {{ Form::text('q', '', [ 'placeholder'=>Lang::get($path.'.text'), 'class'=>'form-control input-lg']) }}
                  @endif
                  </div>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                {{ Form::submit(Lang::get($path.'.find'), ['class'=>'btn btn-info btn-block input-lg']) }} 
                </div>
              </div>


{{ Form::close() }}


<div class="clear"></div><br>

@if (count($lessons) >= 1)

<?php if (isset($_GET['q'])) {   ?>
<a href="{{ URL::route('student_search_lessons') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> {{ Lang::get($path.'.return') }}</a><div class="clear"></div><br>

<?php } ?>

@foreach($lessons as $lesson)
  <div class="panel panel-info lessons">
      <div class="panel-body">

        <h4><a class="" href="{{ URL::route('student_lesson_show', $lesson->id) }}"><b class="">{{ $lesson->title }}</b></a></h4>
        <hr>
        <p class="text-muted"><i class="glyphicon glyphicon-calendar" style="color:gray;"></i> <?php echo substr($lesson->created_at, 0, 16) ?> | <i class="glyphicon glyphicon-user" style="color: green;"></i> {{ $lesson->lessTeacher->fullname }} | <i class="fa fa-book" style="color:blue;"></i> {{ $lesson->maSubject->name }}</p>

        <div class="clear"></div><hr>

        <p class="desc">&nbsp;&nbsp;{{ mb_substr(strip_tags(htmlspecialchars_decode($lesson->content)), 0, 300, 'utf-8') }} ..</p>

      
       
      </div>
  </div>
@endforeach 

    <div class="clear"></div>
    <div class="center">
        {{ $lessons->links() }}
    </div>

@endif

  </div>
</div>



@stop