@extends('layouts.login_master')

<?php $path = Session::get('language'); ?>


@section('title') {{ Lang::get($path.'.lost_password') }} @stop

@section('content')



<div class="articles" style="margin-top: 50px;">

  <div class="single">

     <div class="panel panel-default">
        <div class="panel-body">
            <h3>{{ Lang::get($path.'.lost_password') }}</h3>
            <div class="clear"></div>
        </div>
      </div>

      <div class="panel panel-default bord">
        <div class="panel-body">

          <div class="col-md-10 col-md-offset-1">


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

<div class="clear"></div>

            {{ Form::open(['route'=>'remind_password_request'])  }}

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.email') }}  : </label>
                 <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                {{ Form::email('email', '', ['placeholder'=>'', 'class'=>'form-control input-lg', 'required' => 'required', 'data-error'=>'Adresse email invalide']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('email'))
                  <p class="p-alert">{{ $errors->first('email') }}</p>
                  @endif
              </div>
          

              {{ Form::submit(Lang::get($path.'.reset') , ['class'=>'btn btn-info btn-block input-lg']) }} 


              {{ Form::close() }}
          </div><br>    

          
        </div>
      </div>

  </div>  

</div>

@stop