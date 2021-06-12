@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.absences') }} @stop

@section('content')


{{ HTML::style('js/bootstrap_datepicker/css/bootstrap-datepicker.css') }}
{{ HTML::script('js/bootstrap_datepicker/js/bootstrap-datepicker.js') }}


<br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('student_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.absences') }}</li>
  </ol>


<?php 
$user_id = Auth::user()->id;
$read_abs = Absence::where('user_id', $user_id)->where('student_read_stut', 1)->get();
foreach ($read_abs as $read_ab) {
  $read_ab->student_read_stut = '0';
  $read_ab->save();  
}

 ?>

@if (count($absences) >= 1)

<div class="clear"></div><hr>

    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>{{ Lang::get($path.'.date') }}</th>        
            <th>{{ Lang::get($path.'.note') }}</th>
          </tr>
        </thead>
        <tbody>

@foreach($absences as $absence)

          @if($absence->student_read_stut == 1)
          <tr class="tr-body" style="background-color: #ffface;">
          @else
            <tr class="tr-body">
          @endif

            <td>{{ $absence->date }}</td>
            <td>{{ $absence->note }}</td>

          </tr>
@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $absences->links() }}
    </div>

@endif

  </div>
</div>



@stop