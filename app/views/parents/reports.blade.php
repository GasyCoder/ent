@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.reports') }} @stop

@section('content')



<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('parent_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.reports') }}</li>
  </ol>


<?php 

$user_id = Auth::user()->id;
$students = User::where('is_student', true)->where('guardian_id', $user_id)->get();

$students_array = array();

foreach ($students as $student) {
  $students_array[] = $student->id;
}

$read_stut = Report::whereIn('student_id', $students_array)->where('to_parent', true)->get();
foreach ($read_stut as $read_s) {
  $read_s->guardian_read_stut = '0';
  $read_s->save();  
}

?>


@if (count($reports) >= 1)

<div class="clear"></div><hr>


    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>{{ Lang::get($path.'.student') }}</th>
            <th>{{ Lang::get($path.'.report') }}</th>        
            <th>{{ Lang::get($path.'.from') }}</th>        
            <th>{{ Lang::get($path.'.date') }}</th>
          </tr>
        </thead>
        <tbody>


@foreach($reports as $report)

           @if($report->guardian_read_stut == 1)
            <tr class="tr-body" style="background-color: #ffface;">
          @else
            <tr class="tr-body">
          @endif

           <td><span class="badge size-1">{{ $report->stuReport->fullname }}</span></td>

            <td>{{ $report->report }}</td>

            <td>{{ $report->author->fullname }}</td>

            <td>{{ substr($report->created_at, 0, 16) }}</td>

          </tr>
@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $reports->links() }}
    </div>

@endif

  </div>
</div>



@stop