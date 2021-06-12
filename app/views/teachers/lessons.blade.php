@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.lessons') }} @stop

@section('content')

  <br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('teacher_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.lessons') }}</li>
  </ol>
  
<a href="{{ URL::route('teacher_lesson_create') }}" class="btn btn-warning btn-lg"><i class="fa fa-edit"></i> {{ Lang::get($path.'.new_lesson') }}</a>



<div class="clear"></div><hr>

<br>

{{ Form::open(['route'=>'teacher_search_lessons', 'method'=>'GET', 'class'=>'col-md-8 col-md-offset-2', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}


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

@if (count($lessons) >= 1)


<div class="clear"></div><br>

@if(Session::has('error'))
<div class="alert alert-danger center alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>{{ Session::get('error') }}</strong>
</div>
@endif

@if(Session::has('success'))
<div class="alert alert-success center alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>{{ Session::get('success') }}</strong>
</div>
@endif

<div class="clear"></div>

<?php if (isset($_GET['q'])) {   ?>
<a href="{{ URL::route('teacher_search_lessons') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> {{ Lang::get($path.'.return') }}</a><div class="clear"></div><br>

<?php } ?>

    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>{{ Lang::get($path.'.title') }}</th>
            <th>{{ Lang::get($path.'.edit') }}</th>
            <th>{{ Lang::get($path.'.delete') }}</th>
            <th>{{ Lang::get($path.'.date') }}</th>
          </tr>
        </thead>
        <tbody>



@foreach($lessons as $lesson)

          <tr class="tr-body">

            <td><a class="table-link" href="{{ URL::route('teacher_lesson_show', $lesson->id) }}">{{ $lesson->title }}</a></td>

            <td><a href="{{ URL::route('edit_lesson', $lesson->id) }}"><i class="fa fa-edit large"></i></a></td>

            <td><a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('delete_lesson', $lesson->id) }}"><i class="glyphicon glyphicon-trash large"></i></a></td>

            <td>{{ $lesson->created_at }}</td>

          </tr>
@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $lessons->links() }}
    </div>

@endif

  </div>
</div>



@stop