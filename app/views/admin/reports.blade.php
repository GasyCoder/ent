@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.reports') }} @stop

@section('content')



<div class="panel panel-default panel-main">
   <br><br><br><br>
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.reports') }}</li>
  </ol>


<?php 

$read_stut = Report::where('admin_read_stut', 1)->get();
foreach ($read_stut as $read_s) {
  $read_s->admin_read_stut = '0';
  $read_s->save();  
}

?>
  

@if (count($reports) >= 1)

<div class="clear"></div><hr>


    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>{{ Lang::get($path.'.by') }}</th>
            <th>{{ Lang::get($path.'.student') }}</th>
            <th>{{ Lang::get($path.'.report') }}</th>        
            <th>{{ Lang::get($path.'.date') }}</th>
          </tr>
        </thead>
        <tbody>



@foreach($reports as $report)

        @if($report->admin_read_stut == 1)
          <tr class="tr-body" style="background-color: #ffface;">
        @else
          <tr class="tr-body">
        @endif

            <td><a href="{{ URL::route('profile_teacher', $report->author->id) }}"><span class="badge green-bg size-1">{{ $report->author->fullname }}</span></a></td>

            <td><a href="{{ URL::route('profile_student', $report->stuReport->id) }}"><span class="badge red-bg size-1">{{ $report->stuReport->fullname }}</span></a></td>

            <td>{{ $report->report }}</td>
            <td>{{ $report->created_at }}</td>

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