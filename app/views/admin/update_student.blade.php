@extends('layouts.panel_master')

<?php $path = Session::get('language'); ?>

@section('title') {{ $user->fullname }} @stop

@section('content')
  
   <br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li><a href="{{ URL::route('admin_students') }}">{{ Lang::get($path.'.students') }}</a></li>
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
      echo HTML::image('uploads/profiles/students/'.$user->image.'', '', ['width'=>'150px', 'height'=>'150px', 'class'=>'img-circle']);
    } else {
       echo HTML::image('uploads/profiles/student.png', '', ['width'=>'150px', 'height'=>'150px', 'class'=>'img-circle']);
    }

?>
      </div>

{{ Form::open(['route'=>['update_password_student', $user->id], 'files'=>'true', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}   
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



{{ Form::open(['route'=>['update_student', $user->id], 'files'=>'true', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}     



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
                <label class="control-label">{{ Lang::get($path.'.class') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-blackboard"></i></span>


                  <?php $check_class = TheClass::find($user->class_id);
                        $classes_array= TheClass::lists('name', 'id');  ?>

                      @if($check_class !== null)
                        {{ Form::select('class', array($check_class->id => $check_class->name) + $classes_array + [' ' => '-- null --'], '', ['class'=>'form-control input-lg']) }}
                      @else
                        {{ Form::select('class', array('' => 'all classes') + $classes_array, '', ['class'=>'form-control input-lg']) }}
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
                {{ Form::text('registration_num', $user->registration_num , ['placeholder'=>'', 'class'=>'form-control input-lg']) }} 
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

@if(!empty($user->mention))
<option value="{{$user->mention}}" selected="selected">{{$user->mention}}</option>
@else
<option value="" selected="selected">{{ Lang::get($path.'.select') }}</option>
@endif

                    <optgroup label="LICENCE">
                    <option value="SVTE">SVTE</option>
                    <option value="SMS">SMS</option>
                    </optgroup>
                    <optgroup label="MASTER">
                    <option value="SVE">SVE</option>
                    <option value="STE">STE</option>
                    <option value="BSE">BSE</option>
                    <option value="SMS">SMS</option>
                    </optgroup>
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

@if(!empty($user->parcour))
<option value="{{$user->parcour}}" selected="selected">{{$user->parcour}}</option>
@else
<option value="" selected="selected">{{ Lang::get($path.'.select') }}</option>
@endif

                    <optgroup label="LICENCE">
                    <option value="SVE">SVE</option>
                    <option value="STE">STE</option>
                    <option value="BSE">BSE</option>
                    <option value="Physique">Physique</option>
                    <option value="Chimie">Chimie</option>
                    </optgroup>
                    <optgroup label="MASTER">
                    <option value="PANA">PANA</option>
                    <option value="ECOPRIM">ECOPRIM</option>
                    <option value="ZOO">ZOO</option>
                    <option value="BC">BC</option>
                    <option value="VBS">VBS</option>
                    <option value="GM">GM</option>
                    <option value="PM">PM</option>
                    <option value="STEM">STEM</option>
                    <option value="STTD">STTD</option>
                    <option value="BMBA">BMBA</option>
                    <option value="EBHS">EBHS</option>
                    <option value="DyACO">DyACO</option>

                    </optgroup>
                  </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('parcour'))
                  <span class="help-block red-color">{{ $errors->first('parcour') }}</span>
                  @endif
              </div>  
            


      </div>

      <div class="col-md-6">

            <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.birthday') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                {{ Form::text('birthday', $user->birthday, ['placeholder'=>'', 'class'=>'form-control input-lg']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('birthday'))
                  <span class="help-block red-color">{{ $errors->first('birthday') }}</span>
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

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.birth_localite') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                {{ Form::text('birth_localite', $user->birth_localite, ['placeholder'=>'', 'class'=>'form-control input-lg']) }} 
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
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                {{ Form::text('region', $user->region, ['placeholder'=>'', 'class'=>'form-control input-lg']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('region'))
                  <span class="help-block red-color">{{ $errors->first('region') }}</span>
                  @endif
              </div>


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