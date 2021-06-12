@extends('layouts.master')

<?php $control = Control::find(1); ?>
<?php $path = Session::get('language'); ?>


@section('metaTages') 
<meta name="keywords" content="{{ $control->keywords }}">
<meta name="description" content="{{ $control->description }}">
@stop

@section('title') {{ Lang::get($path.'.contact') }} @stop

@section('content')

<ol class="breadcrumb link-map">
  <li><a href="{{ URL::route('home') }}">{{ Lang::get($path.'.Home') }}</a></li>
  <li class="active">{{ Lang::get($path.'.contact') }}</li>
</ol>

<div class="articles">

  <div class="single">

  	 <div class="panel panel-default">
        <div class="panel-body">
  	        <h3>{{ Lang::get($path.'.contact_us') }}</h3>
  	        <div class="clear"></div>
      	</div>
      </div>

      <div class="panel panel-default bord">
        <div class="panel-body">


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


              {{ Form::open(['route'=>'contact_store', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.name') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                {{ Form::text('name', '', ['placeholder'=>'', 'class'=>'form-control input-lg', 'required' => 'required']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('name'))
                  <span class="help-block red-color">{{ $errors->first('name') }}</span>
                  @endif
              </div>


              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.email') }}  : </label>
                 <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                {{ Form::email('email', '', ['placeholder'=>'', 'class'=>'form-control input-lg', 'required' => 'required', 'data-error'=>'Adresse email invalide']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('email'))
                  <span class="help-block red-color">{{ $errors->first('email') }}</span>
                  @endif
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.message') }} : </label>

                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                  {{ Form::textarea('message', '', ['placeholder'=>'', 'class'=>'form-control', 'rows'=>'6', 'required' => 'required']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>

                @if($errors->first('message'))
                  <span class="help-block red-color">{{ $errors->first('message') }}</span>
                @endif
              </div>

              <div class="form-group">
              {{ Form::submit( Lang::get($path.'.send') , ['class'=>'btn btn-info btn-block input-lg']) }} 
              </div>

              {{ Form::close() }}



<script type="text/javascript">
  $('#myForm').validator();
</script>



          
        </div>
      </div>

  </div>  

</div>

@stop