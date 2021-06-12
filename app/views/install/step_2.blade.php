@extends('layouts.install_master')

@section('title') EasySchool Installer @stop

@section('content')
<div class="col-md-8 col-md-offset-2">

<div class="steps">
            <div class="col-md-3 text-center item item">
               <i class="fa fa-plug"></i>
            </div>

            <div class="col-md-3 text-center item item">
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
    <h3 class="panel-title">database details</h3>
  </div>
  <div class="panel-body">

{{ Form::open(['route'=>'install_s2_db'])  }}

<div class="col-md-10 col-md-offset-1">
            <div class="form-group">
               <label>Host (server) :</label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-server"></i></span>
                {{ Form::text('server', '', ['placeholder'=> 'localhost' , 'class'=>'form-control input-lg']) }}
                </div> 

                @if($errors->first('username'))
                  <span class="help-block red-color">{{ $errors->first('username') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Database Name :</label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-database"></i></span>
                {{ Form::text('database', '', ['placeholder'=> '' , 'class'=>'form-control input-lg']) }}
                </div> 

                @if($errors->first('username'))
                  <span class="help-block red-color">{{ $errors->first('username') }}</span>
                @endif
            </div>

            <div class="form-group">
               <label>Database Username :</label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                {{ Form::text('username', '', ['placeholder'=> '' , 'class'=>'form-control input-lg']) }}
                </div> 

                @if($errors->first('username'))
                  <span class="help-block red-color">{{ $errors->first('username') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Database Password :</label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                {{ Form::password('password',  ['class'=>'form-control input-lg']) }}
                </div> 
                @if($errors->first('password'))
                  <span class="help-block red-color">{{ $errors->first('password') }}</span>
                @endif
            </div>
</div>

<div class="clear"></div><hr>
<div class="pull-right">
  {{ Form::submit( 'NEXT STEP' , ['class'=>'btn btn-info']) }} 
</div>

<div class="pull-left">
	<a class="btn btn-default" href="{{ URL::route('install') }}">PREVIOUS STEP</a>
</div>

{{ Form::close() }}


  </div>
</div>


<span class="help-block center">Copyright © 2017 EasySchool PRO. All Rights Reserved.</span>


</div>
@stop