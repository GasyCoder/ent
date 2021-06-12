@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.marks') }} @stop

@section('content')


<div class="panel panel-default panel-main">
  <br><br><br>
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('student_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.marks') }}</li>
  </ol>


<?php 
$user_id = Auth::user()->id;
$read_stut = Marks::where('student_id', $user_id)->where('student_read_stut', 1)->get();
foreach ($read_stut as $read_s) {
  $read_s->student_read_stut = '0';
  $read_s->save();  
}

 ?>


@if (count($marks) >= 1)

<div class="clear"></div><hr>



    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>{{ Lang::get($path.'.subject') }}</th>
            <th>{{ Lang::get($path.'.teacher') }}</th>     
            <th>{{ Lang::get($path.'.mark') }}</th>
            <th>{{ Lang::get($path.'.note') }}</th>
            <th>{{ Lang::get($path.'.date') }}</th>
          </tr>
        </thead>
        <tbody>


@foreach($marks as $mark)

          <tr class="tr-body">

            <td>{{ $mark->maSubject->name }}</td>

            <td>{{ $mark->maTeacher->fullname }}</td>

            <td><span class="badge size-1">{{ $mark->mark }}</span></td>
            <td>{{ $mark->note }}</td>

            <td>{{ substr($mark->created_at, 0, 16) }}</td>

          </tr>
@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $marks->links() }}
    </div>

@endif






  

  </div>
</div>



@stop