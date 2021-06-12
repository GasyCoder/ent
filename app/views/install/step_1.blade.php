@extends('layouts.install_master')

@section('title') EasySchool Installer @stop

@section('content')
<div class="col-md-8 col-md-offset-2">

<div class="steps">
            <div class="col-md-3 text-center item item">
               <i class="fa fa-plug"></i>
            </div>

            <div class="col-md-3 text-center item item_noset">
               <i class="fa fa-database"></i>
            </div>

            <div class="col-md-3 text-center item item_noset">
               <i class="fa fa-cogs"></i>
            </div>

            <div class="col-md-3 text-center item item_noset">
               <i class="fa fa-check-circle"></i>
            </div>
</div>

<div class="clear"></div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">EasySchool requirements check</h3>
  </div>
  <div class="panel-body">

@if (count($errors) == 0) 
    @foreach ($success as $succ)
	<div class="alert alert-success" role="alert">
      <strong><i class="fa fa-check-circle"></i> </strong> {{ $succ }}
    </div>
    @endforeach


<div class="pull-right">
	<a  class="btn btn-info" href="{{ URL::route('install_s2') }}">NEXT STEP</a>
</div>

@else

    @foreach ($errors as $err)
	<div class="alert alert-danger" role="alert">
      <strong><i class="fa fa-warning"></i> </strong> {{ $err }}
    </div>
    @endforeach

<div class="pull-right">
	<a class="btn btn-default disabled" href="">NEXT STEP</a>
</div>

@endif

  </div>
</div>


<span class="help-block center">Copyright © 2017 EasySchool PRO. All Rights Reserved.</span>


</div>
@stop