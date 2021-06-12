@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.transport') }} @stop

@section('content')


<div class="panel panel-default panel-main">
  <br><br><br>
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('student_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.transport') }}</li>
  </ol>
  
  <div class="clear"></div><hr>

<?php  if (count($transport) >= 1) { ?>

    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>{{ Lang::get($path.'.day') }}</th>
            <th>{{ Lang::get($path.'.time_start') }}</th>         
            <th>{{ Lang::get($path.'.time_return') }}</th>
          </tr>
        </thead>
        <tbody>

@foreach($transport as $tr)

          <tr class="tr-body">

            <td>{{ $tr->Tday->name }}</td>

            <td>{{ $tr->time_start }}</td>

            <td>{{ $tr->time_start }}</td>
            

          </tr>

@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $transport->links() }}
    </div>

<?php } ?>


  </div>
</div>



@stop