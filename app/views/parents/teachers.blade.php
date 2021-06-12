@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.Home') }} @stop

@section('content')



<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('parent_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.Home') }}</li>
  </ol>
  

@if (count($teachers) >= 1)

<div class="clear"></div><hr>


    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>{{ Lang::get($path.'.name') }}</th>      
            <th>{{ Lang::get($path.'.contact') }}</th>
          </tr>
        </thead>
        <tbody>



@foreach($teachers as $teacher)

          <tr class="tr-body">

            <td>{{ $teacher->fullname }}</td>

            <td><a href="{{ URL::route('p_contact', $teacher->id) }}"><i class="glyphicon glyphicon-envelope large"></i></a></td>
            

          </tr>
@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $teachers->links() }}
    </div>

@endif

  </div>
</div>



@stop