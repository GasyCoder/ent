@extends('layouts.login_master')

<?php $path = Session::get('language'); ?>


@section('title') {{ Lang::get($path.'.login') }} @stop

@section('content')


<div class="container main">

<div class="clear"></div> <br>

<div class="col-md-8 col-md-offset-2">
  <div class="login">

  <div class="col-md-8 col-md-offset-2" style="padding: 20px 20px;">
    <a href="{{ URL::route('home') }}">{{ HTML::image('images/logo.png', '', ['class'=>'img-responsive']) }}</a>
  </div>
  <div class="clear"></div>


@if(Session::has('error'))
<div class="alert alert-danger center alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>{{ Session::get('error') }}</strong>
</div>
@endif

@if(Session::has('success'))
<div class="alert alert-success center alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>{{ Session::get('success') }}</strong>
</div>
@endif

<div class="clear"  style="margin-top: 20px;"></div>
      

    {{ Form::open(['route'=>'users.check', 'id'=>'login'])  }}
 <div class="form-group col-sm-6">
           <div class="form-group">
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                {{ Form::text('username', '', ['placeholder'=> Lang::get($path.'.username') , 'class'=>'form-control input-lg']) }}
                </div> 

                @if($errors->first('username'))
                  <span class="help-block red-color">{{ $errors->first('username') }}</span>
                @endif
            </div>
 </div>
 <div class="form-group col-sm-6">
            <div class="form-group">
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                {{ Form::password('password',  ['placeholder'=> Lang::get($path.'.password') , 'class'=>'form-control input-lg']) }}
                </div> 
                @if($errors->first('password'))
                  <span class="help-block red-color">{{ $errors->first('password') }}</span>
                  @endif
            </div>
 </div>
            <div class="form-group">
                {{ Form::checkbox('remember', 'remember', false) }}
                {{ Lang::get($path.'.remember_me') }}
            </div>

            <div class="form-group">
                {{ Form::submit( Lang::get($path.'.login') , []) }} 
            </div>

            <div class="clear"></div>

            
            <div class="pull-left">
              <a href="{{ URL::route('home') }}"><i class="fa fa-home"></i> {{ Lang::get($path.'.Home') }}</a>
            </div>

            <div class="pull-right">
              <a href="{{ URL::route('remind_users_reset') }}"><i class="fa fa-key"></i> {{ Lang::get($path.'.lost_password') }}</a>
            </div>

    {{ Form::close() }}

  </div>

</div>

<div class="clear"></div> <br><br>

      
</div>    
          



@stop