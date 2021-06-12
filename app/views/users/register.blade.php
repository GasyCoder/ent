@extends('layouts.login_master')

<?php $path = Session::get('language'); ?>


@section('title') {{ Lang::get($path.'.register') }} @stop

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


{{ Form::open(['route'=>'users_register', 'method'=>'GET', 'class'=>'col-md-12', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}


              <div class="col-md-10">
                <div class="form-group">

                  @if(Input::has('inscription'))
                    {{ Form::text('inscription', Input::get('inscription'), ['class'=>'form-control input-lg']) }}
                  @else
                    {{ Form::text('inscription', '', [ 'placeholder'=>Lang::get($path.'.tapez_ici_voter_n_inscription'), 'class'=>'form-control input-lg']) }}
                  @endif

                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                {{ Form::submit(Lang::get($path.'.valider'), ['class'=>'btn btn-info btn-block input-lg']) }}
                </div>
              </div>


{{ Form::close() }}

<?php
if (isset($_GET['inscription'])) {

  $code_inscription = htmlspecialchars($_GET['inscription']);

  $get_user = DataUsers::where('registration_num', $code_inscription)->first();

  if ($get_user !== null) {

    $check_table_users = User::where('registration_num', $code_inscription)->first();

    if ($check_table_users == null) {


?>

<hr>
  <div class="col-md-12"><div class="alert alert-info center alert-dismissible" role="alert">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>{{ HTML::image('images/icons/happy.png', '', ['width'=>'20px']) }} Bonjour! <u>{{$get_user->fullname}}</u></strong>

  </div>


    {{ Form::open(['route'=>'users_register_store', 'files'=>'true', 'id'=>'register', 'data-toggle'=>'validator'])  }}


    	     <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.class') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-blackboard"></i></span>

<?php
$check_class = TheClass::where('name', $get_user->class)->first();
$classes_array= TheClass::lists('name', 'id');
 ?>

@if($check_class !== null)

  {{ Form::select('class', array($check_class->id => $check_class->name), '', ['class'=>'form-control input-lg']) }}
 @else

 <select name="class" class="form-control input-lg">
    <option value="" selected="">{{ Lang::get($path.'.select') }}</option>
  </select>

 @endif

                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('class'))
                  <span class="help-block red-color">{{ $errors->first('class') }}</span>
                  @endif
            </div>


            <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.registration_num') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                {{ Form::text('registration_num', Input::get('inscription'), ['placeholder'=>'', 'class'=>'form-control input-lg', 'readonly'=>'readonly']) }}
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('registration_num'))
                  <span class="help-block red-color">{{ $errors->first('registration_num') }}</span>
                  @endif
            </div>

            <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.mentions') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-book"></i></span>
                  <select name="mention" class="form-control input-lg">

@if(!empty($get_user->mention))
<option value="{{$get_user->mention}}" selected="selected" style="color: red;">{{$get_user->mention}}</option>
@else
<option value="" selected="selected">{{$get_user->mention}}</option>
@endif
                  </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('mention'))
                  <span class="help-block red-color">{{ $errors->first('mention') }}</span>
                  @endif
              </div>


              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.parcour') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-book"></i></span>
                  <select name="parcour" class="form-control input-lg">

@if(!empty($get_user->parcour))
<option value="{{$get_user->parcour}}" selected="selected" style="color: red;">{{$get_user->parcour}}</option>
@else
<option value="" selected="selected">{{$get_user->parcour}}</option>
@endif
                  </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('parcour'))
                  <span class="help-block red-color">{{ $errors->first('parcour') }}</span>
                  @endif
              </div>


              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.admission') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-book"></i></span>
                  <select name="admission" class="form-control input-lg">

@if(!empty($get_user->admission))
<option value="{{$get_user->admission}}" selected="selected" style="color: red;">{{$get_user->admission}}</option>
@else
<option value="" selected="selected">{{$get_user->admission}}</option>
@endif

                  </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('admission'))
                  <span class="help-block red-color">{{ $errors->first('admission') }}</span>
                  @endif
              </div>



            <div class="form-group">
           <label class="control-label">{{ Lang::get($path.'.fullname') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-star"></i></span>
                {{ Form::text('fullname', $get_user->fullname, ['placeholder'=> Lang::get($path.'.fullname') , 'class'=>'form-control input-lg']) }}
                </div>

                @if($errors->first('fullname'))
                  <span class="help-block red-color">{{ $errors->first('fullname') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.gender') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                  <select name="gender" class="form-control input-lg">
                  @if(!empty($get_user->gender))
                  <option value="{{$get_user->gender}}" selected="selected" style="color: red;">{{$get_user->gender}}</option>
                  @else
                  <option value="" selected="selected">{{$get_user->gender}}</option>
                  @endif
                  </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('gender'))
                  <span class="help-block red-color">{{ $errors->first('gender') }}</span>
                  @endif
              </div>

<div style="background-color:#b0edbc; border: 1px #e5a2a2 dashed; padding: 5px; margin-bottom: 8px;">

            <div class="form-group">
              <label class="control-label"><b>{{ Lang::get($path.'.username') }}</b> <b style="color: red">*</b> : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                {{ Form::text('username', '', ['placeholder'=> Lang::get($path.'.username') , 'class'=>'form-control input-lg']) }} 
                </div>

                @if($errors->first('username'))
                  <span class="help-block red-color">{{ $errors->first('username') }}</span>
                @endif
            </div>


            <div class="form-group">
                <label class="control-label"><b>{{ Lang::get($path.'.password') }}</b> <b style="color: red">*</b> : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input name="password" type="password" data-minlength="6" class="form-control input-lg" id="inputPassword" placeholder="{{ Lang::get($path.'.password') }} " required>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('password'))
                  <span class="help-block red-color">{{ $errors->first('password') }}</span>
                  @endif
              </div>

              <div class="form-group">
                <label class="control-label"><b>{{ Lang::get($path.'.password_confirmation') }}</b> <b style="color: red">*</b> : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input name="password_confirm" type="password" class="form-control input-lg" data-match="#inputPassword" data-match-error="Votre champ n'est pas identique" placeholder="{{ Lang::get($path.'.password_confirmation') }}" required>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('password_confirm'))
                  <span class="help-block red-color">{{ $errors->first('password_confirm') }}</span>
                  @endif
              </div>

</div>

<div class="clear"></div><hr>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.birthday') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                {{ Form::text('birthday', $get_user->birthday, ['placeholder'=>'', 'class'=>'form-control input-lg', 'readonly'=>'readonly']) }}
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('birthday'))
                  <span class="help-block red-color">{{ $errors->first('birthday') }}</span>
                  @endif
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.birth_localite') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                {{ Form::text('birth_localite', $get_user->birth_localite, ['placeholder'=>'', 'class'=>'form-control input-lg', 'readonly'=>'readonly']) }}
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('birth_localite'))
                  <span class="help-block red-color">{{ $errors->first('birth_localite') }}</span>
                  @endif
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.region') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-flag"></i></span>
                {{ Form::text('region', $get_user->region, ['placeholder'=>'', 'class'=>'form-control input-lg', 'readonly'=>'readonly']) }}
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('region'))
                  <span class="help-block red-color">{{ $errors->first('region') }}</span>
                  @endif
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.address') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                {{ Form::text('address', $get_user->address, ['placeholder'=>'', 'class'=>'form-control input-lg']) }}
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('address'))
                  <span class="help-block red-color">{{ $errors->first('address') }}</span>
                  @endif
              </div>


              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.email') }}  : </label>
                 <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                {{ Form::email('email', $get_user->email, ['placeholder'=>'', 'class'=>'form-control input-lg', 'data-error'=>'Adresse email invalide']) }}
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
                      {{ Form::text('phone', $get_user->phone, ['pattern'=>'^[_0-9-+]{1,}$', 'maxlength'=>'20', 'data-error'=>Lang::get($path.'.phone_invalide'), 'class'=>'form-control input-lg']) }}
                    </div>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>

                    @if($errors->first('phone'))
                      <span class="help-block red-color">{{ $errors->first('phone') }}</span>
                      @endif
                  </div>

                  <div class="form-group" style="background-color: #f9f9f9; border: 1px #ccc dashed; padding: 10px;">
                  <label class="control-label">{{ Lang::get($path.'.image') }}  : </label>
                  {{ Form::file('image', ['class'=>'btn btn-default', 'id'=>'file']) }}

                    @if($errors->first('image'))
                      <span class="help-block red-color">{{ $errors->first('image') }}</span>
                    @endif
                </div>


            <div class="form-group">
                {{ Form::submit( Lang::get($path.'.register') , []) }}
            </div>

    {{ Form::close() }}


<?php
 }
  // esle if  exist in table users
  else {

    echo '<div class="clear"></div><br>
    <div class="col-md-12"><div class="alert alert-warning center alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>' . Lang::get($path.'.inscription_code_error2') .' </strong>
  </div> </div><div class="clear"></div>';

  }

} else {

    echo '<div class="clear"></div><br>
    <div class="col-md-12"><div class="alert alert-danger center alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>' . Lang::get($path.'.inscription_code_error') .' </strong>
  </div> </div><div class="clear"></div>';

      }
}
?>


    <div class="pull-left">
      <a href="{{ URL::route('home') }}"><i class="fa fa-home"></i> {{ Lang::get($path.'.Home') }}</a>
    </div>

    <div class="pull-right">
      <a href="{{ URL::route('users.login') }}"><i class="fa fa-lock"></i> {{ Lang::get($path.'.login') }}</a>
    </div>

  </div>

</div>

<div class="clear"></div> <br><br>


</div>

<script type="text/javascript">
  $('#register').validator();
</script>


@stop
