@extends('layouts.install_master')

@section('title') EasySchool Setup is Complete @stop

@section('content')
<div class="col-md-8 col-md-offset-2">

<div class="steps">
            <div class="col-md-3 text-center item item">
               <i class="fa fa-plug"></i>
            </div>

            <div class="col-md-3 text-center item item">
               <i class="fa fa-database"></i>
            </div>

            <div class="col-md-3 text-center item item">
               <i class="fa fa-cogs"></i>
            </div>

            <div class="col-md-3 text-center item item">
               <i class="fa fa-check-circle"></i>
            </div>
</div>

<div class="clear"></div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Setup is Complete</h3>
  </div>
  <div class="panel-body ">

  <div class="alert alert-success center" role="alert">
  <h2>Congratulations, EasySchool Setup is Complete !</h2><br>
  <p>EasySchool Pro - School Management System is up and running. If you need assistance please feel free contact us.</p><br><br>

  <a href="{{ URL::route('panel.admin') }}" class="btn btn-default btn-lg"><i class="fa fa-home"></i> Control Panel</a>
  </div>


  </div>
</div>


<span class="help-block center">Copyright © 2017 EasySchool PRO. All Rights Reserved.</span>



</div>
@stop