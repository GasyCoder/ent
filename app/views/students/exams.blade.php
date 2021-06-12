@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.exams') }} @stop

@section('content')



<div class="panel panel-default panel-main">
  <br><br><br>
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('student_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.exams') }}</li>
  </ol>



@if (count($exams) >= 1)

<div class="clear"></div><hr>


    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>{{ Lang::get($path.'.teacher') }}</th>        
            <th>{{ Lang::get($path.'.subject') }}</th>
            <th>{{ Lang::get($path.'.date') }}</th>
            <th>{{ Lang::get($path.'.time') }}</th>
          </tr>
        </thead>
        <tbody>


@foreach($exams as $exam)

          <tr class="tr-body">

            <td>{{ $exam->exTeacher->fullname }}</td>
            <td>{{ $exam->exSubject->name }}</td>
            <td><span class="badge size-1">{{ $exam->exam_date }}</span></td>
            <td><span class="badge size-1 red-bg">{{ $exam->exam_time }}</span></td>


          </tr>
@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $exams->links() }}
    </div>

@endif

  </div>
</div>



@stop