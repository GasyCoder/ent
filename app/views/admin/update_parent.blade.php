@extends('layouts.panel_master')

<?php $path = Session::get('language'); ?>

@section('title') {{ $user->fullname }} @stop

@section('content')


<div class="panel panel-default panel-main">
   <br><br><br><br>
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li><a href="{{ URL::route('admin_parents') }}">{{ Lang::get($path.'.parents') }}</a></li>
    <li class="active">{{ $user->fullname }}</li>
  </ol>
  <div class="clear"></div><hr>

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

      <div class="col-md-12">

      <div class="col-md-12">

      <div class="col-md-2 center">
<?php 
    if (!empty($user->image)) {
      echo HTML::image('uploads/profiles/parents/'.$user->image.'', '', ['width'=>'150px', 'height'=>'150px', 'class'=>'img-circle']);
    } else {
       echo HTML::image('uploads/profiles/parent.png', '', ['width'=>'150px', 'height'=>'150px', 'class'=>'img-circle']);
    }

?>
      </div>

{{ Form::open(['route'=>['update_password_parent', $user->id], 'files'=>'true', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}   
            <div class="col-md-10 yellow-box">

            <div class="col-md-4">
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.username') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                {{ Form::text('username', $user->username, ['placeholder'=>'', 'class'=>'form-control input-lg', 'readonly' => 'readonly']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('username'))
                  <span class="help-block red-color">{{ $errors->first('username') }}</span>
                  @endif
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.password') }}  : </label>
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
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.password_confirmation') }}  : </label>
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
            </div>

            <div class="col-md-12">
              <div class="form-group">
                {{ Form::submit(Lang::get($path.'.update_password'), ['class'=>'btn btn-danger']) }}
              </div>
            </div>

            </div>

{{ Form::close() }}



{{ Form::open(['route'=>['update_parent', $user->id], 'files'=>'true', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}     



      </div>

      <div class="col-md-6">  
      
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.fullname') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-star"></i></span>
                {{ Form::text('fullname', $user->fullname, ['placeholder'=>'', 'class'=>'form-control input-lg', 'required' => 'required']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('fullname'))
                  <span class="help-block red-color">{{ $errors->first('fullname') }}</span>
                  @endif
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.gender') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                  <select name="gender" class="form-control input-lg">
                    @if($user->gender == 1)
                    <option value="1" selected="selected">{{ Lang::get($path.'.male') }}</option>
                    <option value="2">{{ Lang::get($path.'.female') }}</option>
                    @elseif($user->gender == 2)
                    <option value="2" selected="selected">{{ Lang::get($path.'.female') }}</option>
                    <option value="1">{{ Lang::get($path.'.male') }}</option>
                    @else
                    <option value="" selected="selected">{{ Lang::get($path.'.select') }}</option>
                    <option value="1">{{ Lang::get($path.'.male') }}</option>
                    <option value="2">{{ Lang::get($path.'.female') }}</option>
                    @endif
                  </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('gender'))
                  <span class="help-block red-color">{{ $errors->first('gender') }}</span>
                  @endif
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.address') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                {{ Form::text('address', $user->address, ['placeholder'=>'', 'class'=>'form-control input-lg']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('address'))
                  <span class="help-block red-color">{{ $errors->first('address') }}</span>
                  @endif
              </div>
            


      </div>

      <div class="col-md-6">



              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.email') }}  : </label>
                 <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                {{ Form::email('email', $user->email, ['placeholder'=>'', 'class'=>'form-control input-lg', 'data-error'=>'Adresse email invalide']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('email'))
                  <span class="help-block red-color">{{ $errors->first('email') }}</span>
                  @endif
              </div>


                  <div class="form-group">
                    <label class="control-label">{{ Lang::get($path.'.phone') }} : </label>

                    <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                      {{ Form::text('phone', $user->phone, ['pattern'=>'^[_0-9-+]{1,}$', 'maxlength'=>'20', 'data-error'=>Lang::get($path.'.phone_invalide'), 'class'=>'form-control input-lg']) }} 
                    </div>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>

                    @if($errors->first('phone'))
                      <span class="help-block red-color">{{ $errors->first('phone') }}</span>
                      @endif
                  </div>

                  <div class="form-group">
                  <label class="control-label">{{ Lang::get($path.'.image') }}  : </label>
                  {{ Form::file('image', ['class'=>'btn btn-default', 'id'=>'file']) }}

                    @if($errors->first('image'))
                      <span class="help-block red-color">{{ $errors->first('image') }}</span>
                    @endif
                  </div> 
                
        </div>

            <div class="clear"></div><br>
            <div class="col-md-12">
              {{ Form::submit(Lang::get($path.'.save_change'), ['class'=>'btn btn-info btn-block input-lg']) }} 
            </div>


              {{ Form::close() }}

      </div>
  
  </div>
</div>

<script type="text/javascript">
  $('#myForm').validator();
</script>

@stop