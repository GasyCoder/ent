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

            <div class="col-md-3 text-center item item">
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

{{ Form::open(['route'=>'install_s3_db', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}

<div class="col-md-10 col-md-offset-1">


<h2 class="bg-title">General settings :</h2>
            
            
              <div class="form-group">
               <label>School name :</label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-flag"></i></span>
                {{ Form::text('school_name', '', ['placeholder'=> '' , 'class'=>'form-control input-lg']) }}
                </div> 

                @if($errors->first('school_name'))
                  <span class="help-block red-color">{{ $errors->first('school_name') }}</span>
                @endif
            </div>


<h2 class="bg-title">Admin :</h2>

            <div class="form-group">
               <label>Username :</label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                {{ Form::text('username', '', ['placeholder'=> '' , 'class'=>'form-control input-lg']) }}
                </div> 

                @if($errors->first('username'))
                  <span class="help-block red-color">{{ $errors->first('username') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label class="control-label">Password  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input name="password" type="password" data-minlength="6" class="form-control input-lg" id="inputPassword" placeholder="" required>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('password'))
                  <span class="help-block red-color">{{ $errors->first('password') }}</span>
                  @endif
              </div>

              <div class="form-group">
                <label class="control-label">Password confirmation  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input name="password_confirm" type="password" class="form-control input-lg" data-match="#inputPassword" data-match-error="Votre champ n'est pas identique" placeholder="" required>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('password_confirm'))
                  <span class="help-block red-color">{{ $errors->first('password_confirm') }}</span>
                  @endif
              </div>

            <div class="form-group">
               <label>Email :</label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                {{ Form::email('email', '', ['placeholder'=> '' , 'class'=>'form-control input-lg']) }}
                </div> 

                @if($errors->first('email'))
                  <span class="help-block red-color">{{ $errors->first('email') }}</span>
                @endif
            </div>
</div>

<div class="clear"></div><hr>
<div class="pull-right">
  {{ Form::submit( 'NEXT STEP' , ['class'=>'btn btn-info']) }} 
</div>

<div class="pull-left">
	<a class="btn btn-default disabled" href="">PREVIOUS STEP</a>
</div>

{{ Form::close() }}


  </div>
</div>


<span class="help-block center">Copyright © 2017 EasySchool PRO. All Rights Reserved.</span>


<script type="text/javascript">
  $('#myForm').validator();
</script>

</div>
@stop